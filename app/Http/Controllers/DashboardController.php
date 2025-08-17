<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Obligation;
use App\Models\Transaction;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Totals scoped by OwnedByUserScope
        $accounts = Account::orderBy('name')->get();
        $totalBalance = $accounts->sum(fn (Account $a) => (float) $a->balance);

        $now = now();
        $incomeThisMonth = (float) Transaction::ofType('income')->forMonth((int) $now->year, (int) $now->month)->sum('amount');
        $expenseThisMonth = (float) Transaction::ofType('expense')->forMonth((int) $now->year, (int) $now->month)->sum('amount');
        $netFlow = $incomeThisMonth - $expenseThisMonth;

        $iOwe = Obligation::whereIn('status', ['open','partial'])->where('direction', 'i_owe')->with('counterparty')->limit(5)->get();
        $owedToMe = Obligation::whereIn('status', ['open','partial'])->where('direction', 'owed_to_me')->with('counterparty')->limit(5)->get();

        return view('dashboard.index', [
            'totalBalance' => $totalBalance,
            'incomeThisMonth' => $incomeThisMonth,
            'expenseThisMonth' => $expenseThisMonth,
            'netFlow' => $netFlow,
            'iOwe' => $iOwe,
            'owedToMe' => $owedToMe,
        ]);
    }
}


