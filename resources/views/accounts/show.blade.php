<x-app-layout>
<div class="p-4 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">{{ $account->name }}</h1>
        <a href="{{ route('accounts.edit', $account) }}" class="text-indigo-600">Edit</a>
    </div>
    <x-card>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-sm text-gray-500">Balance</div>
                <div class="text-2xl font-semibold"><x-money :amount="$account->balance" :currency="$account->currency" /></div>
            </div>
            <div class="text-sm text-gray-500">Type: {{ ucfirst($account->type) }}</div>
        </div>
    </x-card>

    <x-card>
        <h2 class="font-semibold">Recent Transactions</h2>
        <div class="mt-2 space-y-2">
            @forelse($account->transactions as $txn)
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-medium capitalize">{{ $txn->type }}</div>
                        <div class="text-xs text-gray-500">{{ optional($txn->occurred_at)->format('Y-m-d H:i') }}</div>
                    </div>
                    <x-money :amount="$txn->amount" />
                </div>
            @empty
                <x-empty-state>No transactions yet.</x-empty-state>
            @endforelse
        </div>
    </x-card>
    <x-bottom-nav />
</div>
</x-app-layout>


