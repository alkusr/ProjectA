<?php

namespace App\Http\Livewire\Admin\Test;

use App\Models\Question;
use Livewire\Component;

class TestShow extends Component
{
    public $test;
    public $name;

    public $questions;
    public $isEdit = false;

    public function setModel()
    {
        $this->name = $this->test->name;

    }
    // updateTitle
    public function updateName()
    {
        $this->test->name = $this->name;
        $this->test->save();
        $this->dispatchBrowserEvent('success', ['message' => "Title berhasil diupdate"]);
    }

    // setEdit
    public function setEdit($val)
    {
        $this->isEdit = $val;
        // dd($this->test);
        $this->setModel();
    }
    // deleteQuestion
    public function deleteQuestion($id)
    {
        // delete test question
        $testQuestion = \App\Models\TestQuestion::find($id);
        // check if test question already deleted
        if (!$testQuestion) {
            $this->dispatchBrowserEvent('success-delete', ['message' => "soal sudah dihapus"]);

            return;
        }
        $testQuestion->delete();
        $this->dispatchBrowserEvent('success-delete', ['message' => "soal berhasil dihapus"]);
    }
    // addQuestion
    public function addQuestion($id)
    {
        // check if test question not exist
        if (Question::find($id) == null) {
            // dispacth event
            $this->dispatchBrowserEvent('success-delete', ['message' => "soal tidak ditemukan"]);
            return;
        }
        // check if question already exist in test
        if ($this->test->testQuestions->where('question_id', $id)->count() > 0) {
            // dispacth event
            $this->dispatchBrowserEvent('success-delete', ['message' => "soal sudah ada di test ini"]);
            return;
        }

        // get question
        $question = Question::find($id);
        // get test
        $this->test->testQuestions()->create([
            'question_id' => $question->id,
            'test_id' => $this->test->id,
        ]);
        $this->dispatchBrowserEvent('success', ['message' => "soal berhasil ditambahkan"]);
    }
    // get test
    public function getTest()
    {
        $this->test = \App\Models\Test::first()->load(['testQuestions', 'testQuestions.question', 'testQuestions.question.choices', 'testQuestions.question.answerReasons']);
    }
    public function render()
    {
        $this->getTest();
        // get all questions where not has testQuestion
        $this->questions = Question::whereDoesntHave('testQuestion')->get();
        return view('livewire.admin.test.test-show');
    }
}
