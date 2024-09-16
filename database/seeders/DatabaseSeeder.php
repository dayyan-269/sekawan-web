<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Account\Admin;
use App\Models\Account\Supervisor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('password123'),
        ]);

        Supervisor::factory()->create([
            'name' => 'Supervisor',
            'email' => 'supervisor@email.com',
            'password' => Hash::make('password123'),
        ]);

        Supervisor::factory()->create([
            'name' => 'Supervisor 2',
            'email' => 'supervisor2@email.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
