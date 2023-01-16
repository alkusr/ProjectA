<?php

namespace App\Http\Controllers\API\Participant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class APIParticipantTestController extends Controller
{
    public function setAnswer(Request $request)
    {

        // dd($request->all());
        // get participant_test
        $participant_test = auth()->user()->participant->participantTest()->first();

        if (!$participant_test) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum mengerjakan test'
            ], 401);
        }

        if ($this->checkTime($participant_test)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah melewati batas waktu'
            ], 422);
        }
        // get id and answer of request
        $id = $request->test_question_id;
        $answer = $request->answer;
        // update participant_test_question_answer
        $participant_test->participantTestQuestionAnswers()->where('test_question_id', $id)->update([
            'answer' => $answer,
        ]);

        // response
        return response()->json([
            'status' => 'success',
            'message' => 'Answer berhasil disimpan',
        ]);
    }
    public function setAnswerconfidence(Request $request)
    {
        // get participant_test
        // dd($request->all());
        $participant_test = auth()->user()->participant->participantTest()->first();
        if (!$participant_test) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum mengerjakan test'
            ], 401);
        }

        if ($this->checkTime($participant_test)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah melewati batas waktu'
            ], 422);
        }
        // get id and answer of request
        $id = $request->test_question_id;
        $answer = $request->answer;
        // update participant_test_question_answer
        $participant_test->participantTestQuestionAnswers()->where('test_question_id', $id)->update([
            'confidence_answer' => $answer,
        ]);

        // response
        return response()->json([
            'status' => 'success',
            'message' => 'Answer berhasil disimpan',
        ]);
    }
    // setAnswerReason
    public function setAnswerReason(Request $request)
    {
        // get participant_test
        $participant_test = auth()->user()->participant->participantTest()->first();
        if (!$participant_test) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum mengerjakan test'
            ], 401);
        }

        if ($this->checkTime($participant_test)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah melewati batas waktu'
            ], 422);
        }
        // get id and answer of request
        $id = $request->test_question_id;
        $answer = $request->answer;
        // update participant_test_question_answer
        $participant_test->participantTestQuestionAnswers()->where('test_question_id', $id)->update([
            'answer_reason' => $answer,
        ]);

        // response
        return response()->json([
            'status' => 'success',
            'message' => 'Answer berhasil disimpan',
        ]);
    }
    // setAnswerReasonConfidence
    public function setAnswerReasonConfidence(Request $request)
    {
        // get participant_test
        $participant_test = auth()->user()->participant->participantTest()->first();
        if (!$participant_test) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda belum mengerjakan test'
            ], 401);
        }

        if ($this->checkTime($participant_test)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anda sudah melewati batas waktu'
            ], 422);
        }
        // get id and answer of request
        $id = $request->test_question_id;
        $answer = $request->answer;
        // update participant_test_question_answer
        $participant_test->participantTestQuestionAnswers()->where('test_question_id', $id)->update([
            'confidence_answer_reason' => $answer,
        ]);

        // response
        return response()->json([
            'status' => 'success',
            'message' => 'Answer berhasil disimpan',
        ]);
    }
    // check if created at greater than 60 minutes
    public function checkTime($participant_test)
    {
        // get created_at
        $created_at = $participant_test->created_at;
        // get current time
        $current_time = now();
        // get difference in minutes
        $difference = $current_time->diffInMinutes($created_at);
        // check if difference is greater than 60
        if ($difference > 60) {
            return true;
        }
        return false;
    }
}
