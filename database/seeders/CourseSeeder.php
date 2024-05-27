<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::factory()->create([
            'email' => 'test@example.com',
            'courseName' => 'Lean Orange Belt',
            'description' => 'Ik kan bedrijven helpen met hun processen!',

        ]);
    }
}
