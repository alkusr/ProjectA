<?php

namespace App\Http\Livewire\Participant\Test;

use Livewire\Component;

class TestPreview extends Component
{
    public $participant_test;
    public $baseQuestions;
    public $show;
    // mount
    public function mount()
    {
        $this->participantTest();
        $this->getBaseQuestion();
        $this->show = false;
    }
    // showpreview
    public function showpreview()
    {
        $this->show = true;
    }
    // load
    public function participantTest()
    {
        $id = $this->participant_test->id;
        $this->participant_test = $this->participant_test->load(['participantTestResult', 'participantTestResult.participantTestResultDetails', 'participantTestResult.participantTestResultDetails.testResultCategory', 'test', 'test.testQuestions', 'test.testQuestions.participantTestQuestionAnswer' => function ($query) use ($id) {
            $query->where('participant_test_id', $id);
        }, 'test.testQuestions.participantTestQuestionAnswer.testResultCategory', 'test.testQuestions.question', 'test.testQuestions.question.choices', 'test.testQuestions.question.answerReasons']);
    }
    // get base question
    public function getBaseQuestion()
    {
        $this->baseQuestions = $this->participant_test->test->testQuestions;
        // dd($this->baseQuestions);
    }
    public function render()
    {
        // dd($this->baseQuestions);
        return view('livewire.participant.test.test-preview');
    }
}
