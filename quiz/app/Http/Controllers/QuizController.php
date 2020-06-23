<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class QuizController extends Controller
{
   
    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create()
    {
        return view('admin.quiz.create');
    }
  
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'fileImport' => 'required|mimes:png,jpg,jpeg'
        ],[
            'title.required' => 'Tên danh mục không được trống',
            'fileImport.required' => 'Bạn chưa chọn hình ảnh',
            'fileImport.mimes' => 'Ảnh không đúng định dạng '
        ]);

        $image_quiz = Storage::disk('s3')->put('quiz-images', $request->fileImport, 'r');

        $image_url = Storage::disk('s3')->url($image_quiz);

        $data =[
            'title' => $request->title,
            'image_url' => $image_url
        ];

        Quiz::create($data);

        return redirect()->route('quiz.create')->with('messages', 'Thêm thành công');
    }

    public function countQuestionByQuizID($quiz_id){
        $data = Question::where('quiz_id',$quiz_id)->select('question_type','answer_type',DB::raw('count(*) as question_count_by_type'))
        ->groupBy('question_type','answer_type')->get();

        $result = [];
        foreach($data as $value){
            $question_type = $value->question_type;
            $answer_type = $value->answer_type;
            
            $type = '';
            $key = '';
            if($question_type == 'text'){
                if($answer_type == 'single_select'){
                    $key= [$question_type.'_'.$answer_type];
                    $type = 'Single select multilple choice questions';
                }
                if($answer_type == 'multi_select'){
                    $key= $question_type.'_'.$answer_type;
                    $type = 'Multi select multilple choice questions';
                }
                if($answer_type == 'fill_text'){
                    $key= $question_type.'_'.$answer_type;
                    $type = 'Fill text';
                }
            }

            if($question_type == 'image'){

                if($answer_type == 'single_select'){
                    $key= $question_type.'_'.$answer_type;
                    $type = 'Single select image multilple choice questions';
                }

                if($answer_type == 'multi_select'){
                    $key= $question_type.'_'.$answer_type;
                    $type = 'Multi select image multilple choice questions';
                }
            }

            array_push($result,[
                'type' => $type,
                'key' => $key,
                'total_question' => $value->question_count_by_type
            ]);
        }

    
        Log::debug($result);
        Log::debug(getType($result));

        return response()->json($result);  
        
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $quiz = Quiz::find($id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
        ],[
            'title.required' => 'Tên danh mục không được trống',
        ]);
        $data = [];
        $data['title'] = $request->title;
         
        if($request->hasFile('fileImport')){

            $request->validate([
                'fileImport' => 'required|mimes:png,jpg,jpeg'
            ],[
                'fileImport.required' => 'Bạn chưa chọn hình ảnh',
                'fileImport.mimes' => 'Ảnh không đúng định dạng '
            ]);
    
            $image_quiz = Storage::disk('s3')->put('quiz-images', $request->fileImport, 'r');
    
            $image_url = Storage::disk('s3')->url($image_quiz);
    
            $data['image_url'] =  $image_url;
        }
       
        Quiz::where('id', $id)->update($data);
        
        return redirect()->back()->with('messages', 'Lưu thành công');
    }

    public function destroy($id)
    {
        $quiz = Quiz::find($id);
        $quiz->delete();
        return back()->with('messages', 'Xóa thành công');
    }
}
