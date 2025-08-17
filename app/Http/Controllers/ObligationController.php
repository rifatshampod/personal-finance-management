<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObligationRequest;
use App\Models\Counterparty;
use App\Models\Obligation;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ObligationController extends Controller
{
    public function index(): View
    {
        $iOwe = Obligation::where('direction', 'i_owe')->orderByDesc('created_at')->get();
        $owedToMe = Obligation::where('direction', 'owed_to_me')->orderByDesc('created_at')->get();
        return view('obligations.index', compact('iOwe', 'owedToMe'));
    }

    public function create(): View
    {
        $counterparties = Counterparty::orderBy('name')->get();
        return view('obligations.create', compact('counterparties'));
    }

    public function store(ObligationRequest $request): RedirectResponse
    {
        $obligation = Obligation::create($request->validated());
        return redirect()->route('obligations.index')->with('status', 'Obligation created');
    }

    public function show(Obligation $obligation): View
    {
        $this->authorize('view', $obligation);
        $obligation->load('payments');
        return view('obligations.show', compact('obligation'));
    }

    public function edit(Obligation $obligation): View
    {
        $this->authorize('update', $obligation);
        $counterparties = Counterparty::orderBy('name')->get();
        return view('obligations.edit', compact('obligation', 'counterparties'));
    }

    public function update(ObligationRequest $request, Obligation $obligation): RedirectResponse
    {
        $this->authorize('update', $obligation);
        $obligation->update($request->validated());
        return redirect()->route('obligations.show', $obligation)->with('status', 'Obligation updated');
    }

    public function destroy(Obligation $obligation): RedirectResponse
    {
        $this->authorize('delete', $obligation);
        $obligation->delete();
        return redirect()->route('obligations.index')->with('status', 'Obligation deleted');
    }
}


