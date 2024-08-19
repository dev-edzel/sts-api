<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return match ($this->method()) {
            'POST' => [
                'username' => ['required', 'string', 'unique:users,username'],
                'email' => ['required', 'string', 'email', 'unique:users,email'],
                'password' => ['required', 'min:8'],
                'user_info.first_name' => ['required', 'string'],
                'user_info.middle_name' => ['nullable', 'string'],
                'user_info.last_name' => ['required', 'string'],
                'user_info.phone_number' => ['required', 'string'],
                'user_info.avatar' => ['required', 'image'],
            ],
            default => []
        };
    }
}
