<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TransactionService
{
    public function create(array $data, ?UploadedFile $attachment = null): Transaction
    {
        return DB::transaction(function () use ($data, $attachment) {
            if ($attachment) {
                $data['attachment_path'] = $attachment->store('attachments', 'local');
            }

            $transaction = Transaction::create($data);
            return $transaction;
        });
    }

    public function update(Transaction $transaction, array $data, ?UploadedFile $attachment = null): Transaction
    {
        return DB::transaction(function () use ($transaction, $data, $attachment) {
            if ($attachment) {
                if ($transaction->attachment_path) {
                    Storage::disk('local')->delete($transaction->attachment_path);
                }
                $data['attachment_path'] = $attachment->store('attachments', 'local');
            }
            $transaction->update($data);
            return $transaction;
        });
    }

    public function delete(Transaction $transaction): void
    {
        DB::transaction(function () use ($transaction) {
            if ($transaction->attachment_path) {
                Storage::disk('local')->delete($transaction->attachment_path);
            }
            $transaction->delete();
        });
    }
}


