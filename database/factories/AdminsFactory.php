<?php

namespace Database\Factories;

use App\Enums\AdminRole;
use App\Enums\Gender;
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
            'phone' => '0312345678',
            'birthday' => '2000-01-01',
            'gender' => Gender::male,
            'avatar' => 'avatar-user.png',
            'address' => 'Thành phố Hồ Chí Minh',
            'email_verified_at' => now(),
            'password' => Hash::make('admin@'),
            'remember_token' => Str::random(10),
            'roles' => AdminRole::supper_admin,
        ];
    }
}
