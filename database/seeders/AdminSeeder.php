<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create user admin and add to table admin
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role_id' => 1
            ]
        ];

        foreach ($data as $item) {
            \App\Models\User::create([
                'email' => $item['email'],
                'password' => $item['password'],
                'role_id' => $item['role_id'],
            ])->admin()->create([
                'name' => $item['name']
            ]);
        }
    }
}
