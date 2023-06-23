<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Projects;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project_report>
 */
class Project_reportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $employee_id = Employee::pluck('id')->toArray();
        $project_id = Projects::pluck('id')->toArray();
        return [
            'employee_id' => $this->faker->randomElement($employee_id),
            'project_id' => $this->faker->randomElement($project_id),
            'title_report' => $this->faker->title(),
            'description_report' => $this->faker->text(30),
            'date_cre_report' => $this->faker->date(),
            'note' => $this->faker->text(20),
            'status' => $this->faker->numberBetween($min = 0, $max = 2),
            'file_report' => $this->faker->numerify('dossier ######')
        ];
    }
}
