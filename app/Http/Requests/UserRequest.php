<?php

namespace App\Http\Requests;

use App\Traits\HandlesHttpResponses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;


class UserRequest extends FormRequest
{
    use HandlesHttpResponses;
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
                'user_info.avatar' => ['nullable', 'image'],
            ],
            default => [
                'username' => ['nullable', 'string', 'unique:users,username'],
                'email' => ['nullable', 'string', 'email', 'unique:users,email'],
                'password' => ['nullable', 'min:8'],
            ]
        };
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            $this->error(
                'Invalid Data',
                $validator->errors(),
                Response::HTTP_BAD_REQUEST
            )
        );
    }
}
