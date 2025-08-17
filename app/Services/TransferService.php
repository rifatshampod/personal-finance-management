<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransferService
{
    public function create(string $userId, string $sourceAccountId, string $destinationAccountId, float $amount, \DateTimeInterface $occurredAt, ?string $notes = null): array
    {
        if ($sourceAccountId === $destinationAccountId) {
            throw new \InvalidArgumentException('Source and destination accounts must be different.');
        }
        $group = (string) Str::uuid();

        return DB::transaction(function () use ($userId, $sourceAccountId, $destinationAccountId, $amount, $occurredAt, $notes, $group) {
            $legA = Transaction::create([
                'user_id' => $userId,
                'account_id' => $sourceAccountId,
                'type' => 'expense',
                'amount' => $amount,
                'occurred_at' => $occurredAt,
                'notes' => $notes,
                'transfer_group' => $group,
                'destination_account_id' => $destinationAccountId,
            ]);

            $legB = Transaction::create([
                'user_id' => $userId,
                'account_id' => $destinationAccountId,
                'type' => 'income',
                'amount' => $amount,
                'occurred_at' => $occurredAt,
                'notes' => $notes,
                'transfer_group' => $group,
                'destination_account_id' => $destinationAccountId,
            ]);

            return [$legA, $legB];
        });
    }
}


