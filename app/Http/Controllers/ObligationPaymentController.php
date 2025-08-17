<?php

namespace App\Http\Controllers;

use App\Http\Requests\ObligationPaymentRequest;
use App\Models\Account;
use App\Models\Obligation;
use App\Models\ObligationPayment;
use App\Services\ObligationService;
use Illuminate\Http\RedirectResponse;

class ObligationPaymentController extends Controller
{
    public function __construct(private readonly ObligationService $obligationService) {}

    public function store(ObligationPaymentRequest $request, Obligation $obligation): RedirectResponse
    {
        $this->authorize('view', $obligation);
        $data = $request->validated();
        $this->obligationService->recordPayment($obligation, $data);
        return redirect()->route('obligations.show', $obligation)->with('status', 'Payment recorded');
    }

    public function destroy(Obligation $obligation, ObligationPayment $payment): RedirectResponse
    {
        $this->authorize('delete', $payment);
        // For simplicity in MVP, forbid deletion if it would desync linked transaction
        return redirect()->back()->withErrors('Deleting payments is not supported in MVP.');
    }
}


