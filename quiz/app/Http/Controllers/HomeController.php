<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Exam;
use App\Models\Answer;
use App\Models\Result;
use App\Models\ExamDetail;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exams = Exam::orderBy('id', 'desc')->take(6)->get();
        return view('home.index', compact('exams'));
    }

    public function getExamDetail(Request $request, $exam_id)
    {
        $exam_detail = ExamDetail::where('exam_id', $exam_id)
            ->join('questions', 'exam_details.question_id', '=', 'questions.id')
            ->select('exam_details.*', 'questions.title as question_title', 'questions.question_type', 'questions.answer_type')
            ->paginate(1);

        $question_id = $exam_detail[0]->question_id;

        $answers = Answer::where('question_id', $question_id)->get();

        $user_id = Auth::user()->id; //Change

        Result::firstOrCreate(
            ['user_id' => $user_id, 'exam_id' => $exam_id],
            ['total_question' => $exam_detail->total()]
        );

        $result = Result::where([['user_id', $user_id], ['exam_id', $exam_id]])->first();

        if ($result->status == 'close') {
            return redirect()->back()->with('alert', 'Bạn đã hoàn thành bài thi');
        }

        $arr_user_answers = [];

        $user_answer = UserAnswer::where([['result_id', $result->id], ['question_id', $question_id]])->select('user_answer')->get()->toArray();

        if (!empty($user_answer)) {
            $i = 0;
            foreach ($user_answer as $value) {
                $arr_user_answers[$i] = $value['user_answer'];
                $i++;
            }
        }
        // dd($arr_user_answers);
        if ($request->ajax()) {
            return view('home.partial.quiz-detail', compact(['exam_detail', 'answers', 'arr_user_answers']));
        }

        $create_result_time = $result->created_at;

        $exam = Exam::find($exam_id);
        $exam_time = Carbon::parse($exam->time);
        $exam_time = $create_result_time->addMinutes($exam->time);

        return view('home.start-quiz', compact(['exam_detail', 'answers', 'exam', 'exam_time', 'result', 'arr_user_answers']));
    }


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home.index');
    }
}
