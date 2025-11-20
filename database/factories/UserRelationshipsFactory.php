<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRelationships>
 */
class UserRelationshipsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id"           => $this->randomUserResponsibleId() ?? User::factory()->count(10),
            "user_related_id"   => $this->randomUserChildId() ?? User::factory()->count(10),
        ];
    }

    /** 
     * Get a random user_id with advanced_access in storage.
    */
    private function randomUserResponsibleId(): ?int
    {
        return fake()->randomElement(User::role('responsible')->pluck('id'));
    }

    /** 
     * Get a random user_id in storage.
    */
    private function randomUserChildId(): ?int
    {
        return fake()->unique()->randomElement(User::role('child')->pluck('id'));
    }
}
