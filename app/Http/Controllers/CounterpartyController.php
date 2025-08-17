<?php

namespace App\Http\Controllers;

use App\Models\Counterparty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CounterpartyController extends Controller
{
    public function index(): View
    {
        $counterparties = Counterparty::orderBy('name')->paginate(25);
        return view('counterparties.index', compact('counterparties'));
    }

    public function create(): View
    {
        return view('counterparties.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kind' => ['required', 'in:person,business'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:32'],
            'notes' => ['nullable', 'string'],
        ]);
        Counterparty::create($validated);
        return redirect()->route('counterparties.index')->with('status', 'Counterparty created');
    }

    public function edit(Counterparty $counterparty): View
    {
        $this->authorize('update', $counterparty);
        return view('counterparties.edit', compact('counterparty'));
    }

    public function update(Request $request, Counterparty $counterparty): RedirectResponse
    {
        $this->authorize('update', $counterparty);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'kind' => ['required', 'in:person,business'],
            'email' => ['nullable', 'email'],
            'phone' => ['nullable', 'string', 'max:32'],
            'notes' => ['nullable', 'string'],
        ]);
        $counterparty->update($validated);
        return redirect()->route('counterparties.index')->with('status', 'Counterparty updated');
    }

    public function destroy(Counterparty $counterparty): RedirectResponse
    {
        $this->authorize('delete', $counterparty);
        $counterparty->delete();
        return redirect()->route('counterparties.index')->with('status', 'Counterparty deleted');
    }
}


