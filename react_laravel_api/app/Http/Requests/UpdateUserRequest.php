<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class UpdateUserRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:55',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => [
                'nullable',  // Password is optional in the update
                'confirmed', // If provided, must match password_confirmation
                \Illuminate\Validation\Rules\Password::min(8) // If provided, must be at least 8 characters
                    ->letters()   // If provided, must have letters
                    ->symbols(),  // If provided, must have symbols
            ],
        ];
    }

 
}
