<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ParticipantTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get first test
        $test = \App\Models\Test::first();

        // get all participants
        $participants = \App\Models\Participant::all();
        $participants->each(function ($participant) use ($test) {
            // create participant test
            $participant->participantTest()->create([
                'test_id' => $test->id,
            ]);
        });
    }
}
