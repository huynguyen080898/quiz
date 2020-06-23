<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Quiz;
use App\Models\Result;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportDataByWordService;
use App\Services\ImportDataByExcelService;
use App\Services\ImportDataByDatabaseService;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::join('quizzes', 'exams.quiz_id','=','quizzes.id')->select('exams.*','quizzes.title as quiz_title')->get();
        // dd($exams);
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
       
        DB::beginTransaction();
        try {
            
            $request->validate([
                'quiz_id'=>'required',
                'title' => 'required|max:255',
                'time' => 'required|numeric'
            ],[
                'quiz_id.required' => 'Bạn chưa chọn danh mục',
                'title.required' => 'Bạn chưa nhập tên bài thi',
                'time.required' => 'Bạn chưa nhập thời gian thi',
                'time.numeric' => 'Thời gian thi phải là số'
            ]);

            $start_date = DateTime::createFromFormat('Y-m-d', $request->start_date);

            if( $start_date == null){
                $start_date = Carbon::now();
            }

            $image_url_quiz = Quiz::where('id',$request->quiz_id)->select('image_url')->first();
            $image_url =  $image_url_quiz->image_url;
            // dd($start_date);
            $exam = new Exam();
            $exam->quiz_id = $request->quiz_id;
            $exam->title = $request->title;
            $exam->time = $request->time;
            $exam->start_date = $start_date;
            // $exam->end_date = !empty($request->end_date) ? DateTime::createFromFormat('Y-m-d',$request->end_date) : null;
            // $exam->score = $request->score;
            $exam->image_url = $image_url;
            $exam->save();

            $exam_id = $exam->id;
            $quiz_id = $request->quiz_id;
            
            if($request->hasFile('fileImport')){

                $request->validate([
                    'fileImport'=>'required|mimes:docx,xlsx,csv,tsv,ods,xls,slk,xml,html,gnumeric',
                ],[
                    'fileImport.required' => 'Bạn chưa chọn file',
                    'fileImport.mimes' => 'File không đúng định dạng',
                ]);

                $file = $request->file('fileImport');

                $extension = $file->getClientOriginalExtension();
    
				if($extension == 'docx'){
                    ImportDataByWordService::importData($file,$quiz_id,$exam_id);
                }
                else{
                    Excel::import(new ImportDataByExcelService($quiz_id,$exam_id), $file);
                }

                DB::commit();
                return redirect()->route('exam.create')->with('messages', 'Thêm thành công');
            }
            
            ImportDataByDatabaseService::importData($exam_id, $request);
            DB::commit();
            return redirect()->route('exam.create')->with('messages', 'Thêm thành công');
            
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

       
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
        $exam = Exam::find($id);
        return view('admin.exam.edit',compact('exam'));
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
        $data = Exam::find($id);
        $data->title = $request->title;
        $data->time = $request->time;
        // $data->score = $request->score;
        // $data->status = $request->status;
        // $data->start_date = Carbon::parse($request->start_date);
        $data->save();
        return redirect()->back()->with('messages', 'Lưu thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $exam = Exam::find($id);
        $exam->delete();
        return back()->with('messages', 'Xóa thành công');
    }

    public function getExampleByQuizId($id)
    {
        $exams = Exam::where('quiz_id',$id)->get();
        return view('home.exam',compact('exams'));
    }

    public function getStatistics($exam_id)
    {
        $results = Result::where([['exam_id', $exam_id],['status','close']])
        ->join('users', 'users.id', '=', 'results.user_id')
        ->select('users.name as user_name','results.*')
        ->orderBy('score', 'desc')->get();

        return view('admin.statistical.index',compact('results'));
    }
}
