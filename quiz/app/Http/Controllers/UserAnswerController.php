<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Result;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserAnswerController extends Controller
{
    public function putUserAnswerRadio(Request $request)
    {
        $user_answer = $request->user_answer;
        $question_id = $request->question_id;
        $result_id = $request->result_id;

        $checkAnswer = Answer::where([['question_id', $question_id],['id',$user_answer]])->select('correct')->first();
       
        $correct = $checkAnswer->correct;

        UserAnswer::updateOrCreate(['question_id' => $question_id, 'result_id' => $result_id], ['user_answer' => $user_answer, 'correct'=>$correct]);
       
    }

    public function putUserAnswerCheckBox(Request $request)
    {
        $arr_answers = array_filter($request->user_answers);
        Log::debug($arr_answers); 
        $question_id = $request->question_id;
        $result_id = $request->result_id;

        $arr_answer_selects = array_keys($arr_answers,'true');
        $arr_answer_delete = array_keys($arr_answers,'false');

        UserAnswer::where([['question_id',$question_id],['result_id',$result_id]])->whereIn('user_answer',$arr_answer_delete)->delete();
        
        foreach ($arr_answer_selects as $answer){
            $checkAnswer = Answer::where([['question_id', $question_id],['id',$answer]])->select('correct')->first();
            $correct = $checkAnswer->correct;

            $arr_check =[
                'question_id' => $question_id,
                'result_id' => $result_id,
                'user_answer' => $answer
            ];
            
            UserAnswer::firstOrCreate($arr_check,['correct' => $correct]);
               
        }

    }

    public function putUserAnswerFillText(Request $request)
    {
        $user_answer = $request->user_answer;
        $question_id = $request->question_id;
        $result_id = $request->result_id;

        $answers = Answer::where('question_id', $question_id)->pluck('title')->toArray();

        $correct = false;

        if(in_array($user_answer, $answers)){
            $correct = true;
        }

        UserAnswer::updateOrCreate(['question_id' => $question_id, 'result_id' => $result_id], ['user_answer' => $user_answer, 'correct'=>$correct]);
                
    }
}
