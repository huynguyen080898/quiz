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
        'description',
        'status',
        'key',
        'image_url',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'exam_key'
    ];

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz', 'quiz_id', 'id');
    }
}
