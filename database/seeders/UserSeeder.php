<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Factory for seeding a User with the role 'user'
        User::factory()
            ->user()
            ->create([
                'name' => 'Test Gebruiker',
                'email' => 'test@example.com',
                'birthday' => '1998-05-13',
                'function' => 'Medewerker',
                'phone' => '+31600000000',
                'bio' => 'Hallo, ik ben een test gebruiker!',
            ]);
        
        // Factory for seeding a User with the role 'admin'
        User::factory()
            ->admin()
            ->create([
                'name' => 'Test Admin',
                'email' => 'admin@example.com',
                'birthday' => '1998-05-13',
                'function' => 'Begeleider',
                'phone' => '+31600000000',
                'bio' => 'Hallo, ik ben een admin gebruiker!',
            ]);

        User::factory(50)->user()->create();
    }
}
