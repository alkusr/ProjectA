<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create test
        $data = [
            [
                'name' => 'fourtest',
            ],
        ];
        foreach ($data as $item) {
            // get all questions
            $questions = \App\Models\Question::all();
            $testQuestions = [];
            foreach ($questions as $question) {
                $testQuestions[] = [
                    'question_id' => $question->id,
                ];
            }
            // create test
            \App\Models\Test::create([
                'name' => $item['name'],
            ])->testQuestions()->createMany($testQuestions);
        }
    }
}
