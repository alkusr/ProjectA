<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantTestResultDetail extends Model
{
    use HasFactory;
    protected $fillable = ['test_result_category_id', 'percent'];
    // has one test_result_category
    public function testResultCategory()
    {
        return $this->belongsTo(TestResultCategory::class);
    }
}
