<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            ['name' => 'Location A'],
            ['name' => 'Location B'],
            ['name' => 'Location C'],
            // Add more locations as needed
        ]);
    }
}
