<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:cash,bank,mobile_wallet,card,other'],
            'currency' => ['required', 'string', 'size:3'],
            'institution_name' => ['nullable', 'string', 'max:255'],
            'account_number' => ['nullable', 'string', 'max:255'],
            'opening_balance' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}


