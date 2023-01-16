<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    // guarded
    protected $guarded = [];
    // has many choice
    public function choices()
    {
        return $this->hasMany(Choice::class);
    }
    // has many answer_reason
    public function answerReasons()
    {
        return $this->hasMany(AnswerReason::class);
    }
    // has one test_question
    public function testQuestion()
    {
        return $this->hasOne(TestQuestion::class);
    }
}
