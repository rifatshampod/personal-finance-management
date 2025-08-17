<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AccountController extends Controller
{
    public function index(): View
    {
        $accounts = Account::orderBy('name')->get();
        return view('accounts.index', compact('accounts'));
    }

    public function create(): View
    {
        return view('accounts.create');
    }

    public function store(AccountRequest $request): RedirectResponse
    {
        $account = Account::create($request->validated());
        return redirect()->route('accounts.index')->with('status', 'Account created');
    }

    public function show(Account $account): View
    {
        $this->authorize('view', $account);
        $account->load(['transactions' => function ($q) { $q->orderByDesc('occurred_at')->limit(25); }]);
        return view('accounts.show', compact('account'));
    }

    public function edit(Account $account): View
    {
        $this->authorize('update', $account);
        return view('accounts.edit', compact('account'));
    }

    public function update(AccountRequest $request, Account $account): RedirectResponse
    {
        $this->authorize('update', $account);
        $account->update($request->validated());
        return redirect()->route('accounts.index')->with('status', 'Account updated');
    }

    public function destroy(Account $account): RedirectResponse
    {
        $this->authorize('delete', $account);
        $account->delete();
        return redirect()->route('accounts.index')->with('status', 'Account deleted');
    }
}