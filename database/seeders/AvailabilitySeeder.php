<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Availability;

class AvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        Availability::factory()->create([
            'status' => 'aanwezig',
            'user_id' => '1',
        ]);
    }
}
