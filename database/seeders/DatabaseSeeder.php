<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Teste',
            'email' => 'teste@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe123'),
        ]);
    }
}
