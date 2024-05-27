<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        Tag::factory()->create([
            'tag' => 'Arduino',
        ]);
    }
}
