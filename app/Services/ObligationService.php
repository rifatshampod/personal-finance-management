<?php

namespace App\Services;

use App\Models\Obligation;
use App\Models\ObligationPayment;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ObligationService
{
    public function create(array $data): Obligation
    {
        return Obligation::create($data);
    }

    public function recordPayment(Obligation $obligation, array $data): ObligationPayment
    {
        return DB::transaction(function () use ($obligation, $data) {
            $amount = (float) $data['amount'];
            $remaining = (float) $obligation->remaining_amount;
            if ($amount <= 0 || $amount > $remaining) {
                throw new \InvalidArgumentException('Invalid payment amount.');
            }

            $transactionType = $obligation->direction === 'i_owe' ? 'expense' : 'income';

            $transaction = Transaction::create([
                'user_id' => $obligation->user_id,
                'account_id' => $data['account_id'],
                'type' => $transactionType,
                'amount' => $amount,
                'occurred_at' => $data['paid_at'] ?? now(),
                'notes' => $data['notes'] ?? null,
                'counterparty_id' => $obligation->counterparty_id,
            ]);

            /** @var ObligationPayment $payment */
            $payment = ObligationPayment::create([
                'user_id' => $obligation->user_id,
                'obligation_id' => $obligation->id,
                'account_id' => $data['account_id'],
                'amount' => $amount,
                'paid_at' => $data['paid_at'] ?? now(),
                'transaction_id' => $transaction->id,
                'notes' => $data['notes'] ?? null,
            ]);

            $newRemaining = $obligation->refresh()->remaining_amount;
            $obligation->status = $newRemaining == 0.0 ? 'settled' : 'partial';
            $obligation->save();

            return $payment;
        });
    }
}


