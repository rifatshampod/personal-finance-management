<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ObligationPaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'amount' => ['required', 'numeric', 'gt:0'],
            'account_id' => ['required', 'string'],
            'paid_at' => ['nullable', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}


