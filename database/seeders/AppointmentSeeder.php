<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        Appointment::factory()->create([
            // 'user_id' => '1',
            'start' => '2024-05-31 12:00:00',
            'end' => '2024-05-31 13:00:00',
            'title' => 'Kapper',
            // 'personalStatus' => 'Afwezig',
            // 'description' => 'Kapper voor een uur.',
            // 'location' => 'Kapper Den Bosch',
        ]);
    }
}
