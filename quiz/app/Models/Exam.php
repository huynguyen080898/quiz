<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'title',
        'quiz_id',
        'time',
        'score',
        'status',
        'start_date',
        'end_date',
    ];
}
