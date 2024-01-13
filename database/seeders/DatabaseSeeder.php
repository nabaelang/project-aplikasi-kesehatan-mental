<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '0895375873744',
                'password' => Hash::make('admin'),
                'roles' => 'ADMIN'

            ],
            [
                'name' => 'testing',
                'email' => 'testing@gmail.com',
                'nrp' => '11500000',
                'password' => Hash::make('HMIF2023'),
                'roles' => 'USER'
            ]
        ]);
    }
}
