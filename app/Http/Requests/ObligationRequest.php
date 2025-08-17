<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObligationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'counterparty_id' => ['required', 'string'],
            'direction' => ['required', 'in:i_owe,owed_to_me'],
            'principal_amount' => ['required', 'numeric', 'gt:0'],
            'currency' => ['required', 'string', 'size:3'],
            'purpose' => ['nullable', 'string', 'max:255'],
            'due_date' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}


