<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantTestQuestionAnswer extends Model
{
    use HasFactory;
    // fillable
    protected $fillable = [
        'participant_test_id',
        'test_question_id',
        'answer',
        'confidence_answer',
        'answer_reason',
        'confidence_answer_reason',
        'test_result_category_id'
    ];
    // has one test_result_category
    public function testResultCategory()
    {
        return $this->belongsTo(TestResultCategory::class);
    }

    // has one test_question
    public function testQuestion()
    {
        return $this->belongsTo(TestQuestion::class);
    }
}
