<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Degree;

class DegreeSeeder extends Seeder
{
    public function run(): void
    {
        Degree::factory()->create([
            'user_id' => '1',
            'school' => 'Avans hogeschool Asociate Degree',
            'degree' => 'Informatica',
            'degreeYears' => '2',
            'currentYear' => '1',
            'description' => 'Dit is mijn eerste jaar voor informatica'
        ]);
    }
}
