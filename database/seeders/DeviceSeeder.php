<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        Device::factory()->create([
            'status' => 'Aanwezig',
            'user_id' => '1',
        ]);
    }
}
