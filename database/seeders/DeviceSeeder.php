<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        Device::factory()->create([
            'deviceId' => '1214551',
            'time' => '17:00:00',
            'status' => 'offline',
            'user_id' => '1',
        ]);
    }
}
