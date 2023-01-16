<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestion extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'question_id',
        'test_id',
    ];
    // has one question
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
    // has one
    public function participantTestQuestionAnswer()
    {
        return $this->belongsTo(ParticipantTestQuestionAnswer::class, 'id', 'test_question_id');
    }
}
