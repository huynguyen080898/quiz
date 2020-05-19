<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamDetail extends Model
{
    protected $table = 'exam_details';

    protected $fillable = [
        'exam_id',
        'question_id',
        'answer_id',
        'score'
    ];
}
