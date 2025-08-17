<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'in:income,expense,transfer'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'account_id' => ['required', 'string'],
            'occurred_at' => ['nullable', 'date'],
            'category_id' => ['nullable', 'string', 'required_if:type,income,expense'],
            'counterparty_id' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'destination_account_id' => ['nullable', 'string', 'required_if:type,transfer', 'different:account_id'],
            'attachment' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:5120'],
        ];
    }
}


