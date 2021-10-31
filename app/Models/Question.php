<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Basic Configuration
    |--------------------------------------------------------------------------
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'question',
        'image',
        'time_limit',
        'text_answer'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function choices()
    {
        $this->hasMany(Choice::class);
    }

    public function question_type()
    {
        $this->belongsTo(QuestionType::class);
    }

    public function quiz()
    {
        $this->belongsTo(Quiz::class);
    }
}
