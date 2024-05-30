<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        Agenda::factory()->create([
            'user_id' => '1',
            'start_time' => '2024-05-31 12:00:00',
            'finish_time' => '2024-05-31 13:00:00',
            'title' => 'Kapper',
            'personalStatus' => 'Afwezig',
            'description' => 'Kapper voor een uur.',
            'location' => 'Kapper Den Bosch',
        ]);
    }
}
