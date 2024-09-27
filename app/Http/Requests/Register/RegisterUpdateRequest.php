<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            // Register
            'date' => [
                'sometimes',
                'date',
            ],

            // HeartRate
            'heart_rate' => [
                'sometimes',
                'integer',
            ],

            // BloodPressure
            'systolic_pressure' => [
                'sometimes',
                'integer',
            ],
            'diastolic_pressure' => [
                'sometimes',
                'integer',
            ],

            //PhysicalActivity
            'activity_description' => [
                'min:1',
                'string',
                'sometimes',
            ],
            'duration' => [
                'sometimes',
                'integer',
            ],

            //DietaryHabit
            'food_description' => [
                'min:1',
                'string',
                'sometimes',
            ],
            'calories' => [
                'sometimes',
                'integer',
            ],
        ];
    }
}
