<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:50'],

            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'username' => [
                'required',
                'string',
                'min:3',
                'max:20',
                'regex:/^[a-z0-9]+$/',
                'unique:users,username',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],

            'country' => ['nullable', 'string', 'max:100'],

            'currency' => ['nullable', 'string', 'size:3'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email already exists.',
            'password.confirmed' => 'Password confirmation does not match.',
            'username.regex' => 'Username must contain only lowercase letters and numbers.',
        ];
    }
}
