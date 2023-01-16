<?php

namespace App\Http\Controllers\Participant;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\TestResultCategory;
use Illuminate\Http\Request;

class ParticipantTestController extends Controller
{
    // index
    // public function index()
    // {
    //     // auth()->user()->participant->participantTest()->delete();
    //     if (auth()->user()->participant->participantTest()->count() > 0) {
    //         return redirect()->route('participant.dashboard')->with('warning', 'Anda sudah mengerjakan test');
    //     }
    //     // get first test
    //     $test = Test::first();
    //     // create a new participant_test on current participant
    //     $participant_test = auth()->user()->participant->participantTest()->create([
    //         'test_id' => $test->id,
    //     ]);

    //     // each participant_test test_question
    //     $participant_test->test->testQuestions->each(function ($test_question) use ($participant_test) {
    //         // create a new participant_test_question_answer on current participant_test
    //         $participant_test->participantTestQuestionAnswers()->create([
    //             'test_question_id' => $test_question->id,
    //         ]);
    //     });

    //     // participantTestResult
    //     $participant_test->participantTestResult()->create([
    //         'participant_id' => auth()->user()->participant->id,
    //     ])->participantTestResultDetails()->createMany(
    //         // get all test_result_category
    //         TestResultCategory::all()->map(function ($test_result_category) {
    //             return [
    //                 'test_result_category_id' => $test_result_category->id,
    //                 'percent' => 0,
    //             ];
    //         })->toArray()
    //     );

    //     // dd($participant_test);
    //     return view('participant.test.index', compact('participant_test'));
    // }
    public function index()
    {
        // auth()->user()->participant->participantTest()->delete();
        if (auth()->user()->participant->participantTest()->count() > 0) {
            return redirect()->route('participant.dashboard')->with('warning', 'Anda sudah mengerjakan test');
        }
        // get first test
        $test = Test::first();
        // create a new participant_test on current participant
        $participant_test = auth()->user()->participant->participantTest()->create([
            'test_id' => $test->id,
        ]);

        // each participant_test test_question
        $participant_test->test->testQuestions->each(function ($test_question) use ($participant_test) {
            // create a new participant_test_question_answer on current participant_test
            $participant_test->participantTestQuestionAnswers()->create([
                'test_question_id' => $test_question->id,
            ]);
        });

        // participantTestResult
        $participant_test->participantTestResult()->create([
            'participant_id' => auth()->user()->participant->id,
        ])->participantTestResultDetails()->createMany(
            // get all test_result_category
            TestResultCategory::all()->map(function ($test_result_category) {
                return [
                    'test_result_category_id' => $test_result_category->id,
                    'percent' => 0,
                ];
            })->toArray()
        );
        $participant_test = $participant_test->load(['test', 'test.testQuestions', 'test.testQuestions.participantTestQuestionAnswer' => function ($query) use ($participant_test) {
            $query->where('participant_test_id', $participant_test->id);
        }, 'test.testQuestions.question' => function ($query) {
            $query->select('id', 'title');
        }, 'test.testQuestions.question.choices', 'test.testQuestions.question.answerReasons']);
        // dd($participant_test);
        $test_question = $participant_test->test->testQuestions;
        // dd($test_question);
        return view('participant.test.index', compact('test_question','test'));
    }

    // calculate
    public function calculate(Request $request)
    {
        // get participant_test
        $participant_test = auth()->user()->participant->participantTest;
        // dd($participant_test);
        $participant_test = $participant_test->load(['participantTestQuestionAnswers'=>function($query){
            // order by id
            return $query->orderBy('id');
        }, 'participantTestQuestionAnswers.testQuestion', 'participantTestQuestionAnswers.testQuestion.question']);

        // each participantTestQuestionAnswers calculate
        $participant_test->participantTestQuestionAnswers->each(function ($item) {
            //  category result
            // 1 = Miskonsepsi
            // 2 = tidak paham konsep
            // 3 = paham konsep

            if (!is_null($item->answer) && !is_null($item->confidence_answer) && !is_null($item->answer_reason) && !is_null($item->confidence_answer_reason)) {
                // get test_question.question
                $question = $item->testQuestion->question;

                $category_id = 2;


                // benar
                $answer_correct = $item->answer == $question->correct_choice;
                // yakin
                $confidence_answer_sure =  $item->confidence_answer == 1;
                // benar
                $answer_reason_correct = $item->answer_reason == $question->correct_answer_reason;
                // yakin
                $confidence_answer_reason_sure = $item->confidence_answer_reason == 1;
                if ($answer_correct && $confidence_answer_sure && $answer_reason_correct && $confidence_answer_reason_sure) {
                    $category_id = 3;
                }
                if (($answer_correct && $confidence_answer_sure && !$answer_reason_correct && $confidence_answer_reason_sure) ||
                    (!$answer_correct && $confidence_answer_sure && !$answer_reason_correct && $confidence_answer_reason_sure)
                ) {
                    $category_id = 1;
                }

                $item->update([
                    'test_result_category_id' => $category_id,
                ]);
            }
        });
        // get all test result category
        $testResultCategories = \App\Models\TestResultCategory::get(['id', 'name']);
        // clone test result category
        $testResultCategoriesClone = $testResultCategories->map(function ($testResultCategory) {
            return $testResultCategory;
        });
        // create new empty collection for each test result category with key name
        $testResultCategories = $testResultCategories->mapWithKeys(function ($item) {
            return [$item->name => collect()];
        });
        $answer = $participant_test->participantTestQuestionAnswers;

        $dataresult = $answer->load('testResultCategory')->groupBy('testResultCategory.name');
        // union test result category with data result
        $dataresult = $dataresult->union($testResultCategories);
        // create variable total and get total of all item in collection
        $total = $dataresult->sum(function ($item) {
            return $item->count();
        });
        // get percent of each item in collection
        $dataresult = $dataresult->map(function ($item) use ($total) {
            return $item->count() / $total * 100;
        });

        // create participant test result detail
        $dataresult->each(function ($item, $key) use ($participant_test, $testResultCategoriesClone) {

            $testResultCategory = $testResultCategoriesClone->where('name', $key)->first();
            // if test result category not found
            if ($testResultCategory) {
                $participant_test->participantTestResult->participantTestResultDetails->where('test_result_category_id', $testResultCategory->id)->first()->update([
                    'percent' => $item,
                ]);
            }
        });

        auth()->user()->participant->sendResult();

        return redirect()->route('participant.preview');
    }
    // preview
    public function preview()
    {
        $participant_test = auth()->user()->participant->participantTest;
        return view('participant.test.preview', compact('participant_test'));
    }
}
