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
            ->admin()
            ->create([
                'name' => 'Gebruiker',
                'email' => 'test@example.com',
                'birthday' => '1998-05-13',
                'function' => 'Medewerker',
                'phone' => '+31600000000',
                'location' => 'B.107',
                'bio' => 'Ik ben een test gebruiker!',
            ]);
        
        // Factory for seeding a User with the role 'admin'
        User::factory()
            ->admin()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'birthday' => '1998-05-13',
                'function' => 'Begeleider',
                'phone' => '+31600000000',
                'location' => 'Server ruimte',
                'bio' => 'Ik ben een admin gebruiker!',
            ]);

        User::factory()
        ->admin()
        ->create([
            'name' => 'Bertus Rosier',
            'email' => 'b.rosier@avans.nl',
            'birthday' => null,
            'function' => 'Baas',
            'phone' => '',
            'location' => '',
            'bio' => '',
        ]);

        User::factory(10)->user()->create();
    }
}
