<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'quiz_id',
        'title',
        'question_type',
        'answer_type'
    ];

    public function answers()
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }
}
