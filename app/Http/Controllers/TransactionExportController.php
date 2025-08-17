<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
// return type left untyped to avoid static analysis issue when symfony/http-foundation isn't resolved

class TransactionExportController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', Transaction::class);
        $filename = 'transactions_export_'.now()->format('Ymd_His').'.csv';

        $query = Transaction::query()->orderBy('occurred_at');
        if ($request->filled('type')) $query->where('type', $request->string('type'));
        if ($request->filled('account_id')) $query->where('account_id', $request->string('account_id'));
        if ($request->filled('category_id')) $query->where('category_id', $request->string('category_id'));
        if ($request->filled('counterparty_id')) $query->where('counterparty_id', $request->string('counterparty_id'));
        if ($request->filled('from')) $query->where('occurred_at', '>=', $request->date('from'));
        if ($request->filled('to')) $query->where('occurred_at', '<=', $request->date('to'));

        return response()->streamDownload(function () use ($query) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['id','account_id','type','amount','occurred_at','category_id','counterparty_id','notes']);
            $query->chunk(500, function ($rows) use ($out) {
                foreach ($rows as $row) {
                    fputcsv($out, [
                        $row->id,
                        $row->account_id,
                        $row->type,
                        $row->amount,
                        optional($row->occurred_at)->toIso8601String(),
                        $row->category_id,
                        $row->counterparty_id,
                        $row->notes,
                    ]);
                }
            });
            fclose($out);
        }, $filename, [
            'Content-Type' => 'text/csv',
        ]);
    }
}