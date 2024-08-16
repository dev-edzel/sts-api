<?php

namespace App\Http\Requests;

use App\Traits\HandlesHttpResponses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class MerchantRequest extends FormRequest
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
                'name' => ['required', 'string'],
                'short_name' => [
                    'required',
                    'string',
                    'unique:merchants,short_name'
                ],
            ],
            default => [
                'name' => ['nullable', 'string'],
                'short_name' => [
                    'nullable',
                    'string',
                    'unique:merchants,short_name'
                ],
            ],
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
