<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Course;
use App\Models\Skill;
use App\Models\Agenda;
use App\Models\Device;
use App\Models\Tag;
use App\Models\ProjectTag;
use App\Models\ProjectCategory;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(DegreeSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(SkillSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(DeviceSeeder::class);
        $this->call(ProjectTagRelationshipsSeeder::class);
        $this->call(ProjectCategorySeeder::class);
        $this->call(UserProjectSeeder::class); 

    }
}
