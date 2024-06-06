<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Import the DB facade


class UserProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example data for user projects
        $userProjects = [
            ['user_id' => 1, 'project_id' => 1],
            ['user_id' => 2, 'project_id' => 1],
            // Add more rows as needed
        ];

        // Insert data into the database
        DB::table('user_project')->insert($userProjects);
    }
}
