<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // get all participant count
        $participantCount = \App\Models\Participant::count();
        // get today participant count
        $todayParticipantCount = \App\Models\Participant::whereDate('created_at', date('Y-m-d'))->count();
        return view('admin.dashboard.index', compact('participantCount', 'todayParticipantCount'));
    }
}
