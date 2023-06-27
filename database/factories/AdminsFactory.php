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
            'username' => 'admin',
            'fullname' => 'Supper Admin',
            'email' => 'admin@gmail.com',
            'phone' => '0313462346',
            'birthday' => '2000-01-01',
            'gender' => $this->faker->numberBetween($min = 0, $max = 1), 
            'avatar' => 'avatar-user.png',
            'address' => 'Thành phố Hồ Chí Minh',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),            
            'remember_token' => Str::random(10),
            'roles' => '3',
        ];
    }
}
