<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Answer;
use App\Models\Result;
use App\Models\Question;
use App\Models\ExamDetail;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResult($id)
    {
        $result_details = UserAnswer::where('result_id', $id)->get();
        $result_details = $result_details->groupBy('question_id')->toArray();
        // dd($result_details);
        $total_true_answer = 0;

        foreach ($result_details as $key => $values) {
            foreach ($values as $value) {
                $user_answer = $value['user_answer'];

                if (is_numeric($user_answer)) {
                    $checkAnswer = Answer::where([['question_id', $key], ['id', $user_answer]])->select('correct')->first();

                    if (!$checkAnswer->correct) {
                        continue;
                    }

                    $total_true_answer += 1;
                    continue;
                }

                $answers = Answer::where('question_id', $key)->pluck('title')->toArray();

                if (in_array($user_answer, $answers)) {
                    $total_true_answer += 1;
                }
            }
        }

        $result = Result::find($id);
        $exam = Exam::find($result->exam_id);
        $score = ($exam->score / $result->total_question) * $total_true_answer;
        $score = round($score, 0, PHP_ROUND_HALF_UP);

        $result->total_true_answer = $total_true_answer;
        $result->score = $score;
        $result->status = 'close';
        $result->save();
        // dd($result->toArray());
        return view('home.result', compact('result'));
    }

    public function getResults()
    {
        $results = Result::where('user_id', Auth::user()->id)
            ->join('exams', 'exams.id', '=', 'results.exam_id')
            ->select('results.*', 'exams.title as exam_title')
            ->get();
        return view('home.history', compact('results'));
    }

    public function getResultDetail($result_id)
    {
        $result = Result::find($result_id);

        $exam_detail = ExamDetail::where('exam_id', $result->exam_id)
            ->join('questions', 'exam_details.question_id', '=', 'questions.id')
            ->select('exam_details.*', 'questions.title as question_title', 'questions.question_type', 'questions.answer_type')
            ->get();

        $arr_question_id = array_keys($exam_detail->groupBy('question_id')->toArray());

        $answers = Answer::whereIn('question_id', $arr_question_id)->get();
        $answers = $answers->groupBy('question_id')->toArray();

        $user_answers = UserAnswer::where('result_id', $result->id)->whereIn('question_id', $arr_question_id)->get();
        $user_answers = $user_answers->groupBy('question_id')->toArray();
        // dd($user_answers);
        $exam_detail = $exam_detail->toArray();

        $data = [];

        foreach ($exam_detail as $value) {
            foreach ($answers as $key => $answer) {
                if ($value['question_id'] == $key) {
                    if ($value['answer_type'] == 'fill_text') {
                        $value['answers'] = array_column($answer, 'title');
                    } else {
                        $value['answers'] = $answer;
                    }
                }
            }
            // if(!empty($user_answers)){
            foreach ($user_answers as $key => $user_answer) {
                // $value['user_answers'] = [];
                if ($value['question_id'] == $key) {
                    $value['user_answers'] = array_column($user_answer, 'user_answer');
                }
            }

            if (empty($value['user_answers'])) {
                $value['user_answers'] = [];
            }

            array_push($data, $value);
        }
        // dd($data);
        return view('home.history-detail', compact('data'));
    }
}
