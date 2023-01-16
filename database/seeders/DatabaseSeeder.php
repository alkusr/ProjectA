<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // call
        $this->call([
            RoleSeeder::class,
            ParticipantSeeder::class,
            AdminSeeder::class,
            QuestionSeeder::class,
            TestSeeder::class,
            TestResultCategorySeeder::class,
            ParticipantTestSeeder::class,
            ParticipantTestQuesionAnswerSeeder::class,
        ]);
    }
}
