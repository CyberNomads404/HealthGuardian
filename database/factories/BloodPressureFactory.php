<?php

namespace Database\Factories;

use App\Models\BloodPressure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BloodPressure>
 */
class BloodPressureFactory extends Factory
{
    protected $model = BloodPressure::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
    */
    public function definition(): array
    {
        return [
            'systolic_pressure' => $this->faker->numberBetween(90, 140),
            'diastolic_pressure' => $this->faker->numberBetween(60, 90),
        ];
    }
}
