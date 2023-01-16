<?php

namespace Database\Seeders;

use App\Models\TestResultCategory;
use Illuminate\Database\Seeder;

class ParticipantTestQuesionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get all participant
        $participants = \App\Models\Participant::all();
        $participants->each(function ($participant) {
            // get participant test
            $participantTest = $participant->participantTest()->first();
            // get test
            $test = $participantTest->test;
            // get all questions
            $testQuestions = $test->testQuestions;
            $testQuestions->each(function ($testQuestion) use ($participantTest) {
                // get question
                $question = $testQuestion->question;
                // get correct_choice
                $correctChoice = $question->correct_choice;
                // get correct_answer_reason
                $correctAnswerReason = $question->correct_answer_reason;

                // get last test result category
                $lastTestResultCategory = TestResultCategory::orderBy('created_at', 'desc')->first();

                $participantTest->participantTestQuestionAnswers()->create([
                    'test_question_id' => $testQuestion->id,
                    'answer' => $correctChoice,
                    'confidence_answer' => true,
                    'answer_reason' => $correctAnswerReason,
                    'confidence_answer_reason' => true,
                    'test_result_category_id' => $lastTestResultCategory->id,
                ]);
            });
            // get all participant test question answers group by test_result_category_id
            // $participantTestQuestionAnswers = $participantTest->participantTestQuestionAnswers()->get()->groupBy('test_result_category_id');

            // calculate percentase for all category

            // $participantTestResult = $participantTest->participantTestResult()->create([
            //     'participant_id' => $participantTest->participant_id,
            // ]);
        });
    }
}
