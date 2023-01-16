<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestResultCategorySeeder extends Seeder
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
                'name' => 'Miskonsepsi',
            ],
            [
                'name' => 'Tidak Paham Konsep',
            ],
            [
                'name' => 'Paham Konsep',
            ],
        ];
        foreach ($data as $item) {
            \App\Models\TestResultCategory::create([
                'name' => $item['name'],
            ]);
        }
    }
}
