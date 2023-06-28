<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admins;
use App\Models\Employee;
use App\Models\Project_report;
use App\Models\Projects;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // Employee::factory()->count(3)->create();
        Admins::factory()->count(1)->create();
        // Projects::factory()->count(10)->create();
        // Project_report::factory()->count(10)->create();
    }
}
