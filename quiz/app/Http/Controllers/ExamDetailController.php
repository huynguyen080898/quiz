<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $exam_detail = ExamDetail::where('exam_id',$id)
                                    ->join('questions', 'exam_details.question_id', '=', 'questions.id')
                                    ->join('answers','exam_details.answer_id','=', 'answers.id')
                                    ->select('exam_details.*', 'questions.title as question_title','answers.title as answer_title')
                                    ->get();
        // dd($exam_detail);
        return view('admin.exam.detail', compact('exam_detail'));
      
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
    public function update(Request $request)
    {
        // dd($request->all());
        ExamDetail::where([['exam_id',$request->exam_id],['question_id',$request->question_id],['answer_id',$request->answer_id]])
        ->update(['score' => $request->score]);

        $exam_detail_score = ExamDetail::where('exam_id',$request->exam_id)->select('score')->get();

        $total_score = $exam_detail_score->sum('score');
        
        Exam::where('id',$request->exam_id) ->update(['score'=>$total_score]);
        
        return redirect()->back()->with('messages', 'Sửa điểm thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
