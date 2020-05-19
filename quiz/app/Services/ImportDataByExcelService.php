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
            $question = Question::create([
                'quiz_id' => $this->quiz_id,
                'title'  => $row['question'],
                'type'   => $row['type']
                // 'score'  => ($row['score']) ? $row['score'] : 0,
            ]);

            $question_id = $question->max('id');
            
            $answer = Answer::create([
                'question_id' => $question_id,
                'title' => $row['true_answer'],
                'correct' => true,
            ]);
            $answer_id = $answer->max('id');

            array_push($arr_exam_detail,[
                'exam_id' => $this->exam_id,
                'question_id' => $question_id,
                'answer_id' => $answer_id
            ]);

            if($row['type'] == 'multi_choice'){
                $totalColumn = count($row);
                $totalOtherAnswer = $totalColumn - 3;

                $arr_answers = [];

                for($i = 1; $i <= $totalOtherAnswer;$i++){
                    array_push($arr_answers,[
                        'question_id' => $question_id,
                        'title' => 'multi_choice'
                    ]);                   
                }
                Answer::insert($arr_answers);
            }
        }
        ExamDetail::insert($arr_exam_detail);
    }
}