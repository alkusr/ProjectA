<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title' => 'Bentuk struktur Lewis dari unsur O dengan nomor atom 8 ',
                'choice' => [
                    'A' => 'gambar 1',
                    'B' => 'gambar 2',
                    'C' => 'gambar 3',
                    'D' => 'gambar 4',
                    'E' => 'gambar 5'
                ],
                'correct_choice' => 'D',
                'answer_reason' => [
                    'A' => 'Karena struktur Lewis menunjukkan isotop',
                    'B' => 'Karena struktur Lewis menunjukkan nomor atom',
                    'C' => 'Karena struktur Lewis menunjukkan elektron terluar',
                    'D' => 'Karena struktur Lewis menunjukkan periode unsur atom O',
                    'E' => 'Karena struktur Lewis menunjukkan elektron valensi suatu atom'
                ],
                'correct_answer_reason' => 'E'
            ],
            [
                'title' => '
                            Perhatikan gambar berikut!
                            <br>
                            <img src="https://i.ibb.co/qxXxXxq/gambar-2.png" alt="gambar-2" border="0" width="300" height="300">
                            Berdasarkan struktur lewis, maka struktur lewis yang tepat dari N3- adalah
                            ',
                'choice' => [
                    'A' => 'gambar 1',
                    'B' => 'gambar 2',
                    'C' => 'gambar 3',
                    'D' => 'gambar 4',
                    'E' => 'gambar 5'
                ],
                'correct_choice' => 'C',
                'answer_reason' => [
                    'A' => 'Karena melepas 3 elektron',
                    'B' => 'Karena menangkap 3 elektron',
                    'C' => 'Karena terletak pada periode 5',
                    'D' => 'Karena memiliki nomor atom 7',
                    'E' => 'Karena terletak pada golongan 2'
                ],
                'correct_answer_reason' => 'B'
            ],
            [
                'title' => '
                            Berikut ini struktur Lewis yang tepat untuk menggambarkan senyawa kimia CHCl3 adalah….
                            ',
                'choice' => [
                    'A' => 'gambar 1',
                    'B' => 'gambar 2',
                    'C' => 'gambar 3',
                    'D' => 'gambar 4',
                    'E' => 'gambar 5'
                ],
                'correct_choice' => 'A',
                'answer_reason' => [
                    'A' => 'Terdapat 7 elektron disekitar atom Cl (sesuai kaidah oktet)',
                    'B' => 'Elektron disekitar atom C sesuai dengan kaidah duplet ada 8 elektron',
                    'C' => 'Elektron terluar pada atom Cl terdapat 8 yang sesuai dengan kaidah duplet',
                    'D' => 'Sesuai kaidah duplet, elektron yang terdapat disekitar atom Cl ada 7 elektron',
                    'E' => 'Jumlah elektron yang terdapat disekitar atom Cl terdapat 8 elektron (sesuai kaidah oktet)'
                ],
                'correct_answer_reason' => 'E'
            ],
            [
                'title' => '
                            Senyawa HCl  merupakan senyawa kovalen, berikut ini struktur Lewis yang benar yaitu
                            ',
                'choice' => [
                    'A' => 'gambar 1',
                    'B' => 'gambar 2',
                    'C' => 'gambar 3',
                    'D' => 'gambar 4',
                    'E' => 'gambar 5'
                ],
                'correct_choice' => 'A',
                'answer_reason' => [
                    'A' => 'Ikatan kovalen tunggal karena pemakaian bersama pasangan elektron oleh atom Cl yang memiliki 3 pasang elektron bebas',
                    'B' => 'Ikatan kovalen rangkap karena pemakaian bersama 2 pasangan elektron dari atom H dan Cl yang memiliki 3 pasang elektron bebas',
                    'C' => 'Ikatan kovalen tunggal karena pemakaian bersama pasangan elektron oleh dua atom H dan Cl yang memiliki 3 pasang elektron bebas',
                    'D' => 'Ikatan kovalen tunggal karena pemakaian bersama pasangan elektron oleh dua atom H dan Cl yang memiliki 1 pasang elektron bebas',
                    'E' => 'Ikatan kovalen tunggal karena pemakaian bersama pasangan elektron oleh dua atom H dan Cl yang memiliki 2 pasang elektron bebas'
                ],
                'correct_answer_reason' => 'C'
            ],
        ];
        // insert to question,choice,answer_reason
        foreach ($data as $key => $value) {
            $question = Question::create([
                'title' => $value['title'],
                'correct_choice' => $value['correct_choice'],
                'correct_answer_reason' => $value['correct_answer_reason'],
            ]);

            foreach ($value['choice'] as $key => $choice) {
                $question->choices()->createMany([
                    [
                        'choice' => $choice,
                        'key' => $key
                    ]
                ]);
            }
            foreach ($value['answer_reason'] as $key => $answer_reason) {
                $question->answerReasons()->createMany([
                    [
                        'reason' => $answer_reason,
                        'key' => $key
                    ]
                ]);
            }
        }
    }
}
