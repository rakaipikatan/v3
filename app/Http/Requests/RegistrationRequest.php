<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'event_id' => ['required', 'exists:events,id'],
            'category_id' => ['required', 'exists:categories,id'],
            'jersey_size_id' => ['required', 'exists:jersey_sizes,id'],
            'race_event_ids' => ['required', 'array', 'min:1', 'max:3'],
            'race_event_ids.*' => ['distinct', 'exists:race_events,id'],
            'emergency_contact_name' => ['required', 'string', 'max:255'],
            'emergency_contact_phone' => ['required', 'string', 'max:30'],
            'data_declaration_agreed' => ['accepted'],
            'rules_agreement_agreed' => ['accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'race_event_ids.max' => 'You may select at most 3 competition numbers.',
            'race_event_ids.min' => 'Select at least 1 competition number.',
        ];
    }
}
