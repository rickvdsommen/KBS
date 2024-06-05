<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'projectname' => $this->faker->unique()->sentence(2),
            'phaseName' => $this->faker->word,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['Planning', 'In Progress', 'Completed']),
            'startingDate' => $this->faker->date,
            'projectLeader' => $this->faker->name,
            'productOwner' => $this->faker->name,
        ];
    }
}
