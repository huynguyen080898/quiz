<?php

namespace App\Services;

use App\Models\Answer;
use App\Models\Question;
use App\Models\ExamDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class ImportDataByExcelService implements ToCollection, WithHeadingRow{

    protected $quiz_id;
    protected $exam_id;

    public function  __construct($quiz_id, $exam_id)
    {
        $this->quiz_id = $quiz_id;
        $this->exam_id = $exam_id;
    }

    public function collection(Collection $rows)
    {
        $arr_exam_detail = [];

        foreach ($rows as $row) 
        {
            $question_type = $row['question_type'];
            $answer_type = $row['answer_type'];

            $question = Question::create([
                'quiz_id' => $this->quiz_id,
                'title'  => $row['question'],
                'question_type'   => $question_type,
                'answer_type' => $answer_type
            ]);

            $question_id = $question->max('id');
            
            if ($answer_type == 'fill_text'){
                $arr_exam_detail =  $this->insertCorrectAnswer($row['true_answers'], $arr_exam_detail, $question_id); 
                continue;
            }         

            $arr_exam_detail =  $this->insertCorrectAnswer($row['true_answers'], $arr_exam_detail, $question_id);              
    
            $this->insertOtherAnswer($row['other_answers'], $question_id);
        }

        ExamDetail::insert($arr_exam_detail);
    }

    private function insertOtherAnswer($str_answer, $question_id)
    {
        $arr_answers = explode("#a#", $str_answer);
        $arr_other_answers = array_filter($arr_answers, 'strlen');

        foreach ($arr_answers as $other_answer) {
            if (!empty($other_answer)) {
                $answer = new Answer();
                $answer->title = $other_answer;
                $answer->question_id = $question_id;
                $answer->save();
            }
        }
    }

    private function insertCorrectAnswer($str_answer, $arr_exam_detail, $question_id)
    {
        $arr_answers = explode("#a#", $str_answer);
        $arr_true_answers = array_filter($arr_answers, 'strlen');

        foreach ($arr_answers as $true_answer) {
            if (!empty($true_answer)) {
                
                $answer = new Answer();
                $answer->title = $true_answer;
                $answer->question_id = $question_id;
                $answer->correct = true;
                $answer->save();
                $answer_id = $answer->max('id');

                array_push($arr_exam_detail,[
                    'exam_id' => $this->exam_id,
                    'question_id' => $question_id,
                    'answer_id' => $answer_id
                ]);
            }
        }

        return $arr_exam_detail;
    }
}
