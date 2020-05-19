<?php

namespace App\Http\Controllers\Admin;

use App\Models\Exam;
use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportDataByWordService;
use App\Services\ImportDataByExcelService;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::all();
        return view('admin.exam.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $quizzes = Quiz::all();

        $total_question = Question::select('quiz_id',DB::raw('count(*) as total_question'))->groupBy('quiz_id')->get();
        
        // $groupByQuizID = collect($total_question)->groupBy('quiz_id')->toArray();
        
        return view('admin.exam.create',compact('quizzes','total_question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $request->validate([
                'quiz_id'=>'required',
                'title' => 'required|max:255',
                'time' => 'required|numeric'
            ],[
                'quiz_id.required' => 'Ban chua chon danh muc',
                'title.required' => 'Ban chua nhap ten bai thi',
                'time.required' => 'Ban chua nhap thoi gian thi',
                'time.numeric' => 'thoi gian thi phai la so'
            ]);
            $exam = Exam::create($request->all());
            $exam_id = $exam->max('id');
            $quiz_id = $request->quiz_id;
            // $quiz_id = 1;
            if($request->hasFile('fileImport')){
                $file = $request->file('fileImport');
                $extension = $file->getClientOriginalExtension();
    
				if($extension == 'docx'){
                    ImportDataByWordService::importData($file,$quiz_id,$exam_id);
                }
                else{
                    Excel::import(new ImportDataByExcelService($quiz_id,$exam_id), $file);
                }
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return redirect()->route('exam.create')->with('messages', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
