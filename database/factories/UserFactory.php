<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdvancedAccess>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'               => fake()->name(),
            'nickname'           => fake()->unique()->userName(),
            'birthdate'          => fake()->date(),
            'email'              => fake()->unique()->safeEmail(),
            'image'              => fake()->optional(0.6)->imageUrl(),
            'banner'              => fake()->optional(0.6)->imageUrl(),
            'email_verified_at'  => now(),
            'password'           => static::$password ??= Hash::make('password'),
            'remember_token'     => Str::random(10)
        ];
    }

    /** 
     * Assigns role to user after creation.
    */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 1,
            ])
            ->afterCreating(function (User $user) {
                
                $user->assignRole(Role::inRandomOrder()->first()->id);
            });
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
