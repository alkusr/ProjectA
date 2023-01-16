<?php

namespace App\Http\Livewire\Participant\Test;

use App\Models\ParticipantTestQuestionAnswer;
use Livewire\Component;

class AnswerTest extends Component
{
    public $participant_test;
    public $duration;
    public $timeStart;
    public $timeEnd;
    public $timeOut;
    public $preview;
    public $baseQuestions;
    public $questions;
    public $lastPage;
    public $page = 1;
    // mount
    public function mount()
    {
        $this->participantTest();
        $this->getBaseQuestion();
        $this->preview = false;
        $this->timeOut = false;
        $this->duration = 60;
        $this->timeStart = now();
        $this->timeEnd = now()->addMinutes($this->duration);
        $this->lastPage = count($this->baseQuestions);
    }
    // check time out
    public function checkTimeOut()
    {
        if (!$this->timeEnd->isFuture()) {
            $this->timeOut = true;
            $this->showPreview();
        }
    }
    // showPreview
    public function showPreview()
    {
        $this->preview = true;
    }
    // set time out
    public function setTimeOut()
    {
        $this->timeOut = true;
        // set preview
        $this->showPreview();
    }
    // backToQuestion
    public function backToQuestion()
    {
        // if time out
        if ($this->timeOut) {
            return;
        }
        $this->preview = false;
    }
    // load
    public function participantTest()
    {
        $id = $this->participant_test->id;
        $this->participant_test = $this->participant_test->load(['test', 'test.testQuestions', 'test.testQuestions.participantTestQuestionAnswer' => function ($query) use ($id) {
            $query->where('participant_test_id', $id);
        }, 'test.testQuestions.question', 'test.testQuestions.question.choices', 'test.testQuestions.question.answerReasons']);
    }
    // page
    public function page($page)
    {
        if ($page < 1 && $page > $this->lastPage) {
            return;
        }

        $this->page = $page;
    }

    // get base question
    public function getBaseQuestion()
    {
        $this->baseQuestions = $this->participant_test->test->testQuestions->toArray();
        // dd($this->baseQuestions);
    }

    // next page
    public function nextPage()
    {
        if ($this->page < $this->lastPage) {
            $this->page++;
        }
    }
    // previous page
    public function previousPage()
    {
        if ($this->page > 1) {
            $this->page--;
        }
    }
    // get confidence value
    public function getConfidenceValue($key)
    {
        switch ($key) {
            case 'A':
                $key = true;
                break;
            case 'B':
                $key = false;
                break;
            default:
                $key = null;
                break;
        }
        return $key;
    }
    // update answer
    public function updateAnswer($id, $key, $choice)
    {
        $this->checkTimeOut();
        // if time out
        if ($this->timeOut) {
            return;
        }
        ParticipantTestQuestionAnswer::where('participant_test_id', $this->participant_test->id)->where('test_question_id', $id)->update([$choice => $key]);
        $this->participantTest();
        $this->getBaseQuestion();
        // check time out
    }
    // choice
    public function choice($id, $key)
    {
        $this->updateAnswer($id, $key, 'answer');
    }
    // confidence choice
    public function confidenceChoice($id, $key)
    {
        $key = $this->getConfidenceValue($key);
        $this->updateAnswer($id, $key, 'confidence_answer');
    }

    // reason answer
    public function reasonAnswer($id, $key)
    {
        $this->updateAnswer($id, $key, 'answer_reason');
    }
    // confidence reason answer
    public function confidenceReasonAnswer($id, $key)
    {
        $key = $this->getConfidenceValue($key);
        $this->updateAnswer($id, $key, 'confidence_answer_reason');
    }
    public function render()
    {
        // dd($this->baseQuestions);
        $this->question = $this->baseQuestions[$this->page - 1];
        // dd($this->question);
        return view('livewire.participant.test.answer-test');
    }
}
