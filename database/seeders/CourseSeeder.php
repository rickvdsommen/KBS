<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        Course::factory()->create([
            'user_id' => '1',
            'courseName' => 'Lean Orange Belt',
            'year' => '2023',
            'description' => 'Ik kan bedrijven helpen met hun processen!',
        ]);
    }
}
