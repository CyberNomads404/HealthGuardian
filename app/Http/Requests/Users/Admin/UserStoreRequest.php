<?php

namespace App\Http\Requests\Users\Admin;

use App\Models\Profile;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
                'required',
                'string',
                'max:255',
                'min:3',
            ],
            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
            ],
            'date_birthday' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                'in:0,1',
            ],
            'profile' => [
                'required',
                'in:' . implode(',', $profiles),
            ],
        ];
    }
}
