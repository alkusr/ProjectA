<?php

namespace App\Models;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory;
    // fillable name, school_origin
    protected $fillable = ['name', 'school_origin', 'class'];
    // has one participant_test
    public function participantTest()
    {
        return $this->hasOne(ParticipantTest::class);
    }
    // has one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sendResult()
    {
        $data["email"] = $this->user()->first()->email;
        $data["title"] = env('APP_NAME');
        $participant_test = $this->participantTest;
        $pdf = PDF::loadView('emails.pdf-template', compact('participant_test'));
        Mail::send('emails.hasil-test', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])->attachData($pdf->stream(), 'HASIL_TEST.pdf', [
                    'mime' => 'application/pdf',
                ]);
        });
        // return $pdf->stream();
    }
}
