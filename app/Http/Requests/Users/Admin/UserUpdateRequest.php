<?php

namespace App\Http\Requests\Users\Admin;

use App\Models\Profile;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       $profiles = Profile::pluck('name')->toArray();

        return [
            'name' => [
                'nullable',
                'string',
                'max:255',
                'min:3',
            ],
            'email' => [
                'nullable',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'nullable',
                'string',
                'min:6',
            ],
            'date_birthday' => [
                'nullable',
                'date',
            ],
            'gender' => [
                'nullable',
                'in:0,1',
            ],
            'profile' => [
                'nullable',
                'in:' . implode(',', $profiles),
            ],
        ];
    }
}
