<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserInfoRequest extends FormRequest
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
                'first_name' => ['required', 'string'],
                'middle_name' => ['nullable', 'string'],
                'last_name' => ['required', 'string'],
                'phone_number' => ['required', 'string'],
                'avatar' => ['nullable', 'image'],
            ],
            default => [
                'first_name' => ['nullable', 'string'],
                'middle_name' => ['nullable', 'string'],
                'last_name' => ['nullable', 'string'],
                'phone_number' => ['nullable', 'string'],
                'avatar' => ['nullable', 'image'],
            ]
        };
    }
}
