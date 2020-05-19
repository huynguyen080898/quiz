<?php

namespace App\Services;

use ZipArchive;
use DOMDocument;
use App\Models\Answer;
use App\Models\Question;
use App\Models\ExamDetail;

class ImportDataByWordService{

    public static function importData($file,$quiz_id,$exam_id)
    {
        $filePath = $file->getRealPath();
        $striped_content = '';
        $zip = new ZipArchive;
        $dataFile = 'word/document.xml';
        // Open received archive file
        if (true === $zip->open($filePath)) {
            if (($index = $zip->locateName($dataFile)) !== false) {
                $data = $zip->getFromIndex($index);
                $zip->close();

                $dom = new DOMDocument;
                $dom->loadXML($data, LIBXML_NOENT
                    | LIBXML_XINCLUDE
                    | LIBXML_NOERROR
                    | LIBXML_NOWARNING);

                $xmldata = $dom->saveXML();
               
                $striped_content = strip_tags($xmldata);
                
                $striped_content = trim($striped_content);

                $arr_data = explode("#q#", $striped_content);

                $arr_exam_detail = [];

                foreach ($arr_data as $data) {
                    
                    if (!empty($data)) {
                        $arr_question = explode("#a#", $data);
                        $question_title = $arr_question[0];

                        $question = new Question();
                        $question->title = $question_title;
                        $question->quiz_id = $quiz_id;
                        $question->type = 'multi_choice';
                        $question->save();

                        $question_id = $question->max('id');

                        $str_answers = strstr($data, "#a#");
                        $arr_answers = explode("#a#", $str_answers);

                        foreach ($arr_answers as $val) {
                            if (!empty($val)) {
                                $val = trim($val);
                                $answer = new Answer();

                                if (substr($val,0, 1) === '*') {
                                    $answer_title = substr($val,1);
                                    $answer->title = trim($answer_title);
                                    $answer->question_id = $question_id;
                                    $answer->correct = true;
                                    $answer->save();

                                    $answer_id = $answer->max('id');

                                    array_push($arr_exam_detail,[
                                        'exam_id' => $exam_id,
                                        'question_id' => $question_id,
                                        'answer_id' => $answer_id
                                    ]);
            
                                    continue;
                                }

                                $answer->title = $val;
                                $answer->question_id = $question_id;
                                $answer->save();
                            }
                        }
                    }
                }
                ExamDetail::insert($arr_exam_detail);
            }
        }
    }
}