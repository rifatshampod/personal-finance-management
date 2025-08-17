<x-app-layout>
<div class="p-4 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Obligation</h1>
        <a href="{{ route('obligations.edit', $obligation) }}" class="text-indigo-600">Edit</a>
    </div>
    <x-card>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div><span class="text-gray-500">Counterparty</span><div>{{ $obligation->counterparty->name }}</div></div>
            <div><span class="text-gray-500">Direction</span><div class="capitalize">{{ str_replace('_',' ', $obligation->direction) }}</div></div>
            <div><span class="text-gray-500">Principal</span><div><x-money :amount="$obligation->principal_amount" :currency="$obligation->currency" /></div></div>
            <div><span class="text-gray-500">Remaining</span><div><x-money :amount="$obligation->remaining_amount" :currency="$obligation->currency" /></div></div>
            <div><span class="text-gray-500">Status</span><div class="capitalize">{{ $obligation->status }}</div></div>
            <div><span class="text-gray-500">Due</span><div>{{ optional($obligation->due_date)->format('Y-m-d') }}</div></div>
        </div>
    </x-card>

    <x-card>
        <h2 class="font-semibold">Payments</h2>
        <div class="mt-2 space-y-2">
            @forelse($obligation->payments as $p)
                <div class="flex items-center justify-between">
                    <div class="text-sm">{{ optional($p->paid_at)->format('Y-m-d H:i') }}</div>
                    <x-money :amount="$p->amount" :currency="$obligation->currency" />
                </div>
            @empty
                <x-empty-state>No payments yet.</x-empty-state>
            @endforelse
        </div>
    </x-card>

    <x-card>
        <form method="post" action="{{ route('obligations.payments.store', $obligation) }}" class="space-y-2">
            @csrf
            <x-input name="amount" label="Amount" type="number" step="0.01" />
            <x-select name="account_id" label="Account">
                @foreach(\App\Models\Account::orderBy('name')->get() as $a)
                    <option value="{{ $a->id }}">{{ $a->name }}</option>
                @endforeach
            </x-select>
            <x-input name="paid_at" label="Paid at" type="datetime-local" />
            <x-input name="notes" label="Notes" />
            <x-button type="submit" class="w-full">Record Payment</x-button>
        </form>
    </x-card>
    <x-bottom-nav />
</div>
</x-app-layout>


