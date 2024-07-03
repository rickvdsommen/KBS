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
            ['name' => 'B.107'],
            ['name' => 'Server ruimte'],
            ['name' => 'B.003'],
            // Add more locations as needed
        ]);
    }
}
