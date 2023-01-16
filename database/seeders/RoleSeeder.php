<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // insert roles into roles table in database (admin, participant)
        Role::create([
            'name' => 'admin'
        ]);
        Role::create([
            'name' => 'participant'
        ]);
    }
}
