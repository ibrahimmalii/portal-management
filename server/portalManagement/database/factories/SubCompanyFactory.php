<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCompany>
 */
class SubCompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return[
            'company_id' => Company::factory(),
            'name' => $this->faker->company(),
            'description' => $this->faker->text(),
            'address' => $this->faker->address(),
            'expired_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}
