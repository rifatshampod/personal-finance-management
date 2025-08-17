<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Account;
use App\Models\Category;
use App\Models\Counterparty;
use App\Models\Transaction;
use App\Services\TransactionService;
use App\Services\TransferService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService,
        private readonly TransferService $transferService
    ) {}

    public function index(Request $request): View
    {
        $query = Transaction::query()->orderByDesc('occurred_at');

        if ($request->filled('type')) $query->where('type', $request->string('type'));
        if ($request->filled('account_id')) $query->where('account_id', $request->string('account_id'));
        if ($request->filled('category_id')) $query->where('category_id', $request->string('category_id'));
        if ($request->filled('counterparty_id')) $query->where('counterparty_id', $request->string('counterparty_id'));
        if ($request->filled('from')) $query->where('occurred_at', '>=', $request->date('from'));
        if ($request->filled('to')) $query->where('occurred_at', '<=', $request->date('to'));
        if ($request->filled('q')) $query->where('notes', 'like', '%'.$request->string('q').'%');

        $transactions = $query->paginate(25)->withQueryString();
        $accounts = Account::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $counterparties = Counterparty::orderBy('name')->get();

        return view('transactions.index', compact('transactions', 'accounts', 'categories', 'counterparties'));
    }

    public function create(): View
    {
        $accounts = Account::orderBy('name')->get();
        $incomeCategories = Category::where('type', 'income')->orderBy('name')->get();
        $expenseCategories = Category::where('type', 'expense')->orderBy('name')->get();
        $counterparties = Counterparty::orderBy('name')->get();
        return view('transactions.create', compact('accounts', 'incomeCategories', 'expenseCategories', 'counterparties'));
    }

    public function store(TransactionRequest $request): RedirectResponse
    {
        $data = $request->validated();
        if ($data['type'] === 'transfer') {
            /** @var \Illuminate\Http\Request $httpRequest */
            $httpRequest = request();
            $occurredAt = $httpRequest->input('occurred_at') ? Carbon::parse((string) $httpRequest->input('occurred_at')) : now();
            $this->transferService->create(
                (string) Auth::id(),
                $data['account_id'],
                $data['destination_account_id'],
                (float) $data['amount'],
                $occurredAt,
                $data['notes'] ?? null,
            );
            return redirect()->route('transactions.index')->with('status', 'Transfer created');
        }

        /** @var \Illuminate\Http\Request $httpRequest */
        $httpRequest = request();
        // Ensure user ownership set
        $data['user_id'] = (string) Auth::id();
        $this->transactionService->create($data, $httpRequest->hasFile('attachment') ? $httpRequest->file('attachment') : null);
        return redirect()->route('transactions.index')->with('status', 'Transaction created');
    }

    public function edit(Transaction $transaction): View
    {
        $this->authorize('update', $transaction);
        $accounts = Account::orderBy('name')->get();
        $incomeCategories = Category::where('type', 'income')->orderBy('name')->get();
        $expenseCategories = Category::where('type', 'expense')->orderBy('name')->get();
        $counterparties = Counterparty::orderBy('name')->get();
        return view('transactions.edit', compact('transaction', 'accounts', 'incomeCategories', 'expenseCategories', 'counterparties'));
    }

    public function update(TransactionRequest $request, Transaction $transaction): RedirectResponse
    {
        $this->authorize('update', $transaction);
        /** @var \Illuminate\Http\Request $httpRequest */
        $httpRequest = request();
        $this->transactionService->update($transaction, $request->validated(), $httpRequest->hasFile('attachment') ? $httpRequest->file('attachment') : null);
        return redirect()->route('transactions.index')->with('status', 'Transaction updated');
    }

    public function destroy(Transaction $transaction): RedirectResponse
    {
        $this->authorize('delete', $transaction);
        $this->transactionService->delete($transaction);
        return redirect()->route('transactions.index')->with('status', 'Transaction deleted');
    }
}