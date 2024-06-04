<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use Illuminate\Support\Carbon;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        // Appointment::factory()->create([
        //     // 'user_id' => '1',
        //     'start' => '2024-05-31 12:00:00',
        //     'end' => '2024-05-31 13:00:00',
        //     'title' => 'Kapper',
        //     // 'personalStatus' => 'Afwezig',
        //     // 'description' => 'Kapper voor een uur.',
        //     // 'location' => 'Kapper Den Bosch',
        // ]);

        Appointment::factory()->create([
            'start' => Carbon::now()->format('Y-m-d 12:00:00'),
            'end' => Carbon::now()->format('Y-m-d 13:00:00'),
            'title' => 'Verassings Event',
        ]);
    }
}
