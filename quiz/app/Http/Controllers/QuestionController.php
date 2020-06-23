<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Quiz;
use App\Models\Answer;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\ImportDataByWordService;
use App\Services\ImportDataByExcelService;

class QuestionController extends Controller
{
    
    public function index()
    {
        $questions = Question::join('quizzes', 'quizzes.id','=','questions.quiz_id')
        ->select('questions.*','quizzes.title as quiz_title')
        ->get();
        // $questions = Question::all();
        // dd($questions->toArray());
        return view('admin.question.index',compact('questions'));
    }

   
    public function create()
    {
        $quizzes = Quiz::all();
        return view('admin.question.create',compact('quizzes'));
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'quiz_id'=>'required|not_in:0'
        ],[
            'quiz_id.required' => 'Bạn chưa chọn danh mục',
            'quiz_id.not_in' => 'Bạn chưa chọn danh mục'
        ]);

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
            // dd($extension);
            DB::beginTransaction();
            try {
                if($extension == 'docx'){
                    ImportDataByWordService::importData($file,$quiz_id);
                }
                else{
                    Excel::import(new ImportDataByExcelService($quiz_id), $file);
                }
           
                DB::commit();
                return redirect()->back()->with('messages', 'Thêm thành công');
            }catch (Exception $e) {
                DB::rollBack();
                throw new Exception($e->getMessage());
            }
            
        }
        return redirect()->back()->with('messages', 'truowngf hop khac');
    }

    public function getAnswerByQuestionId($id){
        $answers = Answer::where('question_id', $id)->get();
        return view('admin.answer.index', compact('answers'));
    }
   
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }

    public function count(Request $request)
    {
        // $result =[
        //     'data' =>[
        //         'quiz_id'=>$request->quiz_id,
        //         'total_question' => 10
        //     ]
        // ];
        
        // return Response($result);
    }
}
