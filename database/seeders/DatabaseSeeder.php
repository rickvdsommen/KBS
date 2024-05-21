<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Gebruiker',
            'email' => 'test@example.com',
            'birthday' => '1998-05-13',
            'function' => 'Medewerker',
            'phone' => '+31600000000',
            'bio' => 'Hallo, ik ben een test gebruiker!',
        ]);
    }
}
