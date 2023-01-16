<?php

namespace App\Http\Controllers\Admin;

use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // s
        return view('admin.Question.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.Question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'question' => 'required',
            'choice' => 'required',
            'choice_reason' => 'required',
            'choice_correct' => 'required',
            'choice_reason_correct' => 'required',
        ]);
        // get all data
        $data = $request->all();
        // add to database
        $question = Question::create([
            'title' => $data['question'],
            'correct_choice' => Str::upper($data['choice_correct']),
            'correct_answer_reason' => Str::upper(
                $data['choice_reason_correct']
            ),
        ]);

        // dump($data['choice']);
        foreach ($data['choice'] as $key => $value) {
            $key = Str::upper(str_replace('"', '', $key));
            $question->choices()->create([
                'choice' => $value ?? "",
                'key' => $key,
            ]);
        }
        foreach ($data['choice_reason'] as $key => $value) {
            $key = Str::upper(str_replace('"', '', $key));
            $question->answerReasons()->create([
                'reason' => $value ?? "",
                'key' => $key,
            ]);
        }
        return redirect()->route('admin.question.index')->with('success', 'Soal berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view('admin.Question.show', compact('question'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        // dd($question);
        return view('admin.Question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        // validation
        $request->validate([
            'question' => 'required',
            'choice' => 'required',
            'choice_reason' => 'required',
            'choice_correct' => 'required',
            'choice_reason_correct' => 'required',
        ]);
        // get all data
        $data = $request->all();

        // update database
        $question->update([
            'title' => $data['question'],
            'correct_choice' => Str::upper(
                $data['choice_correct']
            ),
            'correct_answer_reason' => Str::upper(
                $data['choice_reason_correct']
            ),
        ]);
        // delete all choices
        $question->choices()->delete();
        $question->answerReasons()->delete();

        // dump($data['choice']);
        foreach ($data['choice'] as $key => $value) {
            $key = Str::upper(str_replace('"', '', $key));
            $question->choices()->create([
                'choice' => $value ?? "",
                'key' => $key,
            ]);
        }
        foreach ($data['choice_reason'] as $key => $value) {
            $key = Str::upper(str_replace('"', '', $key));
            $question->answerReasons()->create([
                'reason' => $value ?? "",
                'key' => $key,
            ]);
        }
        return redirect()->route('admin.question.index')->with('success', 'Soal berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('admin.question.index')->with('success', 'Data berhasil dihapus');
    }
}
