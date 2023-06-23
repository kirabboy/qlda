<?php

namespace Database\Factories;

use App\Models\Admins;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $admin_id = Admins::pluck('id')->toArray();
        return [
            'admin_id' => $this->faker->randomElement($admin_id),
            'name_project' => $this->faker->name(),
            'description' => $this->faker->text(50),
            'ref' => $this->faker->text(20),
            'planning' => $this->faker->text(20),
            'status' => $this->faker->numberBetween($min = 0, $max = 2),
            'date_cre' => $this->faker->DateTime(),
            'version' => $this->faker->randomDigit(),
            'sample_status_MA' => $this->faker->numberBetween($min = 0, $max = 2),
            'file_upload' => $this->faker->imageUrl($width = 200, $height = 200),
            'note' => $this->faker->text(50),
            'name_CT' => $this->faker->name(),
            'company_CT' => $this->faker->text(10),
            'designtion_CT' => $this->faker->text(10),
            'mobile_CT' => $this->faker->phoneNumber(),
            'email_CT' => $this->faker->unique()->safeEmail,
            'contract_status' => $this->faker->numberBetween($min = 0, $max = 1),
            'material_delivery_Pro' => $this->faker->numberBetween($min = 0, $max = 1),
            'lead_time_Pro' => $this->faker->text(10),
            'person_in_charge_Ur' => $this->faker->name(),
        ];
    }
}
