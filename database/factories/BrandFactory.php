<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_name' => $this->faker->firstName(),
            'brand_tag' => $this->faker->lastName(),
            'description' => $this->faker->text(),
            'is_exclusive' => $this->faker->boolean(),
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
