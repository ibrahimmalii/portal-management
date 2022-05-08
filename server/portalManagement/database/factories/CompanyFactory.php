<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'name_ar' => $this->faker->company(),
            'license_number' => $this->faker->numberBetween(0, 343234234),
            'license_address' => $this->faker->address(),
            'date_of_issuance_of_license' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'central_number' => $this->faker->numberBetween(0, 343234234),
            'file_number' => $this->faker->numberBetween(0, 343234234),
            'civil_authority_number' => $this->faker->numberBetween(0, 343234234),
            'commercial_register_number' => $this->faker->numberBetween(0, 343234234),
            'address_automatic_number' => $this->faker->numberBetween(0, 343234234),
            'description' => $this->faker->text(),
            'address' => $this->faker->address(),
            'expired_at' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
        ];
    }
}
