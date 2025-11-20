<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdvancedAccess>
 */
class AdvancedAccessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cpf'          => fake('pt_BR')->unique(false, 500000)->cpf(false),
            'phone_number' => fake('pt_BR')->unique(false, 500000)->cellphoneNumber(false),
            'user_id'      => $this->randomUserResponsibleId() ?? User::factory()->count(10)
        ];
    }

    /**
     * Get a random user_id with advanced_access in storage.
    */
    private function randomUserResponsibleId(): ?int
    {
        return fake()->unique()->randomElement(User::role('responsible')->pluck('id'));
    }
}
