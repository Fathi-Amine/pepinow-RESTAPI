<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name field must be a string.',
            'email.required' => 'the email field is required',
            'email.string' => 'the email field must be a string',
            'email.email' => 'the email must be a valid email address: example@example.com',
            'email.unique' => 'This email is already used',
            'password.required' => 'The password field is required',
            'password.confirmed' => 'The password fields must match',
            'password.min' => 'The password must have a minimum of 8 characters'
        ];
    }
}
