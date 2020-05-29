<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $table = 'results';

    protected $fillable = [
        'user_id',
        'exam_id',
        'score',
        'total_true_answer',
        'total_question'
    ];
}
