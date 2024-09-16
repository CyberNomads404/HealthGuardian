<?php

namespace App\Http\Requests\Register;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'type' => 'required|integer|between:0,3',
            'heart_rate' => 'sometimes|required_if:type,0|integer',
            'blood_pressure_systolic' => 'sometimes|required_if:type,1|integer',
            'blood_pressure_diastolic' => 'sometimes|required_if:type,1|integer',
            'physical_activity' => 'sometimes|required_if:type,2|string',
            'dietary_habit' => 'sometimes|required_if:type,3|string',
        ];
    }

    /**
     * Custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'date.required' => 'A data é obrigatória.',
            'type.required' => 'O tipo de registro é obrigatório.',
            'heart_rate.required_if' => 'A frequência cardíaca é obrigatória para este tipo de registro.',
            'blood_pressure_systolic.required_if' => 'A pressão arterial sistólica é obrigatória para este tipo de registro.',
            'blood_pressure_diastolic.required_if' => 'A pressão arterial diastólica é obrigatória para este tipo de registro.',
            'physical_activity.required_if' => 'A atividade física é obrigatória para este tipo de registro.',
            'dietary_habit.required_if' => 'O hábito alimentar é obrigatório para este tipo de registro.',
        ];
    }
}
