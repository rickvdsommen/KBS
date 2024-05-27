<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        Skill::factory()->create([
            'email' => 'test@example.com',
            'skillname' => 'solderen',
            'skillExperience' => '4',
            'description' => 'Machines solderen zoals Arduino en pijpen.',
        ]);
    }
}
