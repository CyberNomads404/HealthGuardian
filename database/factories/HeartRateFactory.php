<?php

namespace Database\Factories;

use App\Models\HeartRate;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HeartRate>
 */
class HeartRateFactory extends Factory
{
    protected $model = HeartRate::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'heart_rate' => $this->faker->numberBetween(60, 100),
        ];
    }
}
