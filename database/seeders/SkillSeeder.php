<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        Skill::factory()->create([
            'user_id' => '1',
            'skillname' => 'Solderen',
            'skillExperience' => '4',
            'description' => 'Dingen solderen zoals Arduino en metalen pijpen.',
        ]);
    }
}
