<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(6)
            ->has(\App\Models\Consultation::factory(3), 'consultations')
            ->create();
        \App\Models\User::factory()
            ->has(\App\Models\Consultation::factory(0))
            ->create([
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'role' => 0,
                'about' => 'text',
                'approved' => 0,
                ]);
        \App\Models\User::factory()
            ->has(\App\Models\Consultation::factory(3))
            ->create([
                'name' => 'teacher1',
                'email' => 'teacher1@mail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'role' => 1,
                'about' => 'text',
                'approved' => 1,
            ]);
        \App\Models\User::factory()
        ->has(\App\Models\Consultation::factory(0))
        ->create([
            'name' => 'teacher2',
            'email' => 'teacher2@mail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
            'role' => 1,
            'about' => 'text',
            'approved' => 0,
        ]);
        \App\Models\User::factory()
            ->has(\App\Models\Consultation::factory(0))
            ->create([
                'name' => 'student',
                'email' => 'student@mail.com',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
                'role' => 2,
                'about' => 'text',
                'approved' => 0,
            ]);
    }
}
