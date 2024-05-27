<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectTag;

class ProjectTagRelationshipsSeeder extends Seeder
{
    public function run(): void
    {
        ProjectTag::factory()->create([
            'project_id' => 1,
            'tag_id' => 1,
        ]);
    }
}
