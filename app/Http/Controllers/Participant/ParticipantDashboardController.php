<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class ParticipantDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $question_count = Test::first()->testQuestions()->count();
        return view('participant.dashboard.index',compact('question_count'));
    }
}
