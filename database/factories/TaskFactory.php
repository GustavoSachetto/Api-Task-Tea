<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     * 
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'           => $this->faker->unique->words(4, true),
            'description'     => $this->faker->paragraph,
            'tip'             => $this->faker->sentence,
            'level'           => $this->faker->randomElement(['easy', 'medium', 'hard']),
            'image'           => fake()->optional(0.6)->imageUrl(),
            'categories_id'   => Category::inRandomOrder()->first()->id ?? Category::factory()->count(10),
            'user_creator_id' => User::role('responsible')->inRandomOrder()->first()->id ?? User::factory()->count(10),
        ];
    }
}
