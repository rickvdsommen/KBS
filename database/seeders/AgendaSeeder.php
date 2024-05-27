<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Agenda;

class AgendaSeeder extends Seeder
{
    public function run(): void
    {
        Agenda::factory()->create([
            'email' => 'test@example.com',
            'datetime' => '2008-11-11',
            'title' => 'Afspraak bij de kapper',
            'personalStatus' => 'Bezet',
            'description' => 'Kapper voor een uur.',
            'location' => 'Kapper Rayan',
        ]);
    }
}
