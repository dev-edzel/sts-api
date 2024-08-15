<?php

namespace App\Http\Requests;

use App\Traits\HandlesHttpResponses;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class TicketRequest extends FormRequest
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
                'reference_no' => ['nullable', 'string'],
                'ticket_types_id' => ['nullable', 'exists:ticket_types,id'],
                'category_id' => ['nullable', 'exists:categories,id'],
                'sub_category_id' => ['nullable', 'exists:sub_categories,id'],
                'status' => [
                    'nullable',
                    Rule::in([
                        'open', // The ticket has been created and is awaiting assignment or action.
                        'in_progress', // The ticket has been assigned and is being worked on.
                        'pending', // The ticket is waiting for input or action from someone else, such as the customer or another team.
                        'resolved', // The issue has been addressed and the ticket is considered complete.
                        'on_hold', // The ticket is temporarily paused for a specific reason.
                        'escalated', // The ticket has been flagged for urgent attention or has been escalated to a higher level of support.
                        're_opened' // A previously resolved ticket has been reopened due to a recurring or unresolved issue.
                    ])
                ],
                'ticket_infos.email' => ['required', 'string', 'email'],
                'ticket_infos.first_name' => ['required', 'string'],
                'ticket_infos.middle_name' => ['nullable', 'string'],
                'ticket_infos.last_name' => ['required', 'string'],
                'ticket_infos.address' => ['required', 'string'],
                'ticket_infos.phone_number' => ['required', 'string'],
                'ticket_infos.subject' => ['nullable', 'string'],
                'ticket_infos.concern' => ['nullable', 'string'],
                'ticket_infos.attachment' => ['nullable', 'file', 'mimes:jpeg,png,pdf'],
            ],
            default => [
                'status' => [
                    'nullable',
                    Rule::in([
                        'open', // The ticket has been created and is awaiting assignment or action.
                        'in_progress', // The ticket has been assigned and is being worked on.
                        'pending', // The ticket is waiting for input or action from someone else, such as the customer or another team.
                        'resolved', // The issue has been addressed and the ticket is considered complete.
                        'on_hold', // The ticket is temporarily paused for a specific reason.
                        'escalated', // The ticket has been flagged for urgent attention or has been escalated to a higher level of support.
                        're_opened' // A previously resolved ticket has been reopened due to a recurring or unresolved issue.
                    ])
                ],
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
