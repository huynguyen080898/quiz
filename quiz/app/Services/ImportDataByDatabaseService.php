<?php

namespace App\Services;

use App\Models\Question;
use App\Models\ExamDetail;

class ImportDataByDatabaseService{
    public static function importData($exam_id, $request)
    {
        $params = [
            'text_fill_text' => !empty($request->text_fill_text) ? $request->text_fill_text : null,
            'text_multi_select' => !empty($request->text_multi_select) ? $request->text_multi_select : null,
            'text_single_select' => !empty($request->text_single_select) ? $request->text_single_select : null,
            'image_multi_select' => !empty($request->image_multi_select) ? $request->image_multi_select : null,
            'image_single_select' => !empty($request->image_single_select) ? $request->image_single_select : null,
        ];
        
        $params = array_filter($params);

        $arr_exam_detail = [];

        foreach ($params as $key => $value) {
            if($key == 'text_fill_text'){
                $where = [['question_type', 'text'],['answer_type','fill_text']];
               
            }
            if($key == 'text_multi_select'){
                $where = [['question_type', 'text'],['answer_type','multi_select']];                          
            }
            if($key == 'text_single_select'){
                $where = [['question_type', 'text'],['answer_type','single_select']];               
            }
            if($key == 'image_single_select'){
                $where = [['question_type', 'text'],['answer_type','single_select']];
            }
            if($key == 'image_multi_select'){
                $where = [['question_type', 'text'],['answer_type','multi_select']];
            }

            $total_question = $value;
            
            $data = Question::where($where)->inRandomOrder()->limit($total_question)
                                    ->join('answers','questions.id','=', 'answers.question_id')
                                    ->select('questions.id as question_id', 'answers.id as answer_id')
                                    ->get()->toArray();
            
            foreach ($data as $value){
                array_push($arr_exam_detail,[
                    'exam_id' => $exam_id,
                    'question_id' => $value['question_id']
                ]);
                // dd($value);
            }
            
        }

        ExamDetail::insert($arr_exam_detail);
    }
}