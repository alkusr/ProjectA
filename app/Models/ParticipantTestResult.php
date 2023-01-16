<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantTestResult extends Model
{
    use HasFactory;
    // fillable participant_id
    protected $fillable = ['participant_id'];
    // has many participantTestResultDetail
    public function participantTestResultDetails()
    {
        return $this->hasMany(ParticipantTestResultDetail::class);
    }
}
