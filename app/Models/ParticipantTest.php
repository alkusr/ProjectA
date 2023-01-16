<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantTest extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'participant_id',
        'test_id',
    ];

    // has one test
    public function test()
    {
        return $this->belongsTo(Test::class);
    }
    // has many participant_test_question_answer
    public function participantTestQuestionAnswers()
    {
        return $this->hasMany(ParticipantTestQuestionAnswer::class);
    }
    // has one participant_test_results
    public function participantTestResult()
    {
        return $this->hasOne(ParticipantTestResult::class);
    }

    // send mail
    public function sendResultToMail()
    {
    }
}
