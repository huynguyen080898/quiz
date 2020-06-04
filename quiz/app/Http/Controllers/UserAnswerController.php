<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\ExamDetail;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserAnswerController extends Controller
{
    public function putUserAnswer(Request $request)
    {
        $exam_id = $request->exam_id;
        $user_answer_id = $request->user_answer_id;
        $question_id = $request->question_id;
        $result_id = $request->result_id;

        $checkAnswer = ExamDetail::where([['question_id',$question_id],['exam_id',$exam_id],['answer_id',$user_answer_id]])->exists();
        $correct = false;
        $user_id = Auth::user()->id; // change

        if($correct){
            $correct = true;
            $result = Result::find($result_id);
            $result->total_true_answer += 1;
            $result->save();
        }
       
        UserAnswer::updateOrCreate(['question_id' => $question_id, 'result_id' => $result_id], ['user_answer_id' => $user_answer_id, 'correct'=>$correct]);
    }
}
