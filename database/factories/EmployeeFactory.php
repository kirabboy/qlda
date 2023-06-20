<?php

namespace Database\Factories;

use App\Models\Admins;
use App\Models\Projects;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomImages =[
            'https://upanh123.com/wp-content/uploads/2020/12/anh-dai-dien-chat-cho-nu-1.jpg',
            'http://thuthuat123.com/uploads/2018/01/27/Avatar-dep-nhat-92_112148.jpg',
            'https://pdp.edu.vn/wp-content/uploads/2021/01/anh-avatar-dep-dai-dien-facebook-zalo.jpg',
            'https://hinhnen123.com/wp-content/uploads/2021/06/hinh-anh-avatar-dep-nhat-17.jpg',
            'https://img5.thuthuatphanmem.vn/uploads/2022/01/14/avatar-cho-nam-ngau-nhat_023716457.jpg',
            'https://scr.vn/wp-content/uploads/2020/08/Nh%C3%B3c-Maruko-d%E1%BB%85-th%C6%B0%C6%A1ng.jpeg',
            'https://scr.vn/wp-content/uploads/2020/08/Nh%C3%B3c-Maruko-d%E1%BB%85-th%C6%B0%C6%A1ng.jpeg',
            'https://scr.vn/wp-content/uploads/2020/08/Nh%C3%B3c-Maruko-d%E1%BB%85-th%C6%B0%C6%A1ng.jpeg',
            'https://scr.vn/wp-content/uploads/2020/08/Nh%C3%B3c-Maruko-d%E1%BB%85-th%C6%B0%C6%A1ng.jpeg',
            'https://scr.vn/wp-content/uploads/2020/08/Nh%C3%B3c-Maruko-d%E1%BB%85-th%C6%B0%C6%A1ng.jpeg',
            'https://scr.vn/wp-content/uploads/2020/08/Avatar-FB-cute.jpg'
       ];
    
        $admin_id = Admins::pluck('id')->toArray();
        $project_id = Projects::pluck('id')->toArray();
        return [
            'admin_id' => $this->faker->randomElement($admin_id),
            'project_id' => $this->faker->randomElement($project_id),
            'fullname' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'address' => $this->faker->address(),
            'birthday' => $this->faker->date(),
            'avatar' => $this->faker->randomElement($randomImages),
            'department' => $this->faker->text(10),
        ];
    }
}
