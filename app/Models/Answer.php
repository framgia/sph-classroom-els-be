<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $with = ['choice'];

    protected $fillable = [
        'quizzes_taken_id',
        'choice_id',
        'question_id',
        'text_answer',
        'text_correct',
        'time_left'
    ];

    public function choice()
    {
        return $this->belongsTo(Choice::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
