<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;


class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // Example data for project categories
               $projectCategories = [
                ['project_id' => 1, 'category_id' => 1],
            ];
                    // Insert data into the database
        foreach ($projectCategories as $projectCategory) 
        {
            ProjectCategory::create($projectCategory);
        }
    }
}
