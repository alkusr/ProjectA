<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create real data for participants then add to table participants
        $data = [
            [
                'name' => 'participant1',
                'email' => 'participant1@gmail.com',
                'password' => bcrypt('password'),
                "school_origin" => "school1",
                'class' => 'class1',
                'role_id' => 2
            ],
            [
                'name' => 'participant2',
                'email' => 'participant2@gmail.com',
                'password' => bcrypt('password'),
                "school_origin" => "school2",
                'class' => 'class2',
                'role_id' => 2
            ]
        ];
        foreach ($data as $item) {
            \App\Models\User::create([
                'email' => $item['email'],
                'password' => $item['password'],
                'role_id' => $item['role_id'],
            ])->participant()->create([
                'name' => $item['name'],
                'class' => $item['class'],
                'school_origin' => $item['school_origin']
            ]);
        }
    }
}
