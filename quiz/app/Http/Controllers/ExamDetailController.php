<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamDetailController extends Controller
{

    public function index($id)
    {
        //
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $exam_detail = ExamDetail::where('exam_id', $id)
            ->join('questions', 'exam_details.question_id', '=', 'questions.id')
            ->select('exam_details.*', 'questions.title as question_title')
            ->get();
        // dd($exam_detail);
        return view('admin.exam.detail', compact('exam_detail'));
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        // dd($request->all());
        ExamDetail::where([['exam_id', $request->exam_id], ['question_id', $request->question_id]])
            ->update(['score' => $request->score]);

        $exam_detail_score = ExamDetail::where('exam_id', $request->exam_id)->select('score')->get();

        $total_score = $exam_detail_score->sum('score');

        Exam::where('id', $request->exam_id)->update(['score' => $total_score]);

        return redirect()->back()->with('messages', 'Sửa điểm thành công');
    }

    public function destroy($id)
    { }
}
