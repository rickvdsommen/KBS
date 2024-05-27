<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Degree;

class DegreeSeeder extends Seeder
{
    public function run(): void
    {
        Degree::factory()->create([
            'email' => 'test@example.com',
            'school' => 'Avans hogeschool Asociate Degree',
            'degree' => 'Informatica',
            'experienceYears' => '2',
            'year' => '2',
            'description' => 'Dit is mijn laatste jaar voor informatica'

        ]);
    }
}
