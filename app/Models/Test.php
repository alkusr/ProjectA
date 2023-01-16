<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;
    // has many test_question
    public function testQuestions()
    {
        return $this->hasMany(TestQuestion::class);
    }
}
