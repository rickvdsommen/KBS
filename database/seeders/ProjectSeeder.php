<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::factory()->create([
            'projectname' => 'Aquathermie',
            'phaseName' => 'Ontwerp fase',
            'description' => 'In dit project willen we het temperatuur volgen van de water en nog veel meer!',
            'status' => 'Lopend',
            'startingDate' => '2024-05-13',
            'projectLeader' => 'The Leader',
            'productOwner' => 'Bertus Rosier',
        ]);
    }
}
