<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admins>
 */
class AdminsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => $this->faker->username(),
            'fullname' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'birthday' => $this->faker->date(),
            'gender' => $this->faker->numberBetween($min = 0, $max = 1), 
            'avatar' => $this->faker->imageUrl($width = 200, $height = 200),
            'address' => $this->faker->address(),
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),            
            'remember_token' => Str::random(10),
            'roles' => $this->faker->numberBetween($min = 1, $max = 3), 
        ];
    }
}
