<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class UsersExport implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        $users = User::whereHas('participant', function ($query) {
            $query->whereHas('participantTest');
        })->with(['participant','participant.participantTest','participant.participantTest.participantTestQuestionAnswers'=>function($query){
            // order by id
            return $query->orderBy('id');
        }])->get();

        // dd($users);

        return view('exports.reports-test',compact('users'));
    }
}
