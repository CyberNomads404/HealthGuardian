<?php

namespace Database\Factories;

use App\Models\BloodPressure;
use App\Models\DietaryHabit;
use App\Models\HeartRate;
use App\Models\PhysicalActivity;
use App\Models\Register;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Register>
 */
class RegisterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Register::class;

    public function definition(): array
    {
        return [
            'date' => fake()->dateTimeBetween(now(), now()->addMonths(1))
        ];
    }

    public function withRandomPolymorphic()
    {
        return $this->state(function () {
            $polymorphicModels = [
                HeartRate::class,
                BloodPressure::class,
                PhysicalActivity::class,
                DietaryHabit::class,
            ];

            $polymorphicModel = $this->faker->randomElement($polymorphicModels);
            $polymorphicInstance = $polymorphicModel::factory()->create();

            return [
                'register_id' => $polymorphicInstance->id,
                'register_type' => $polymorphicModel,
            ];
        });
    }
}
