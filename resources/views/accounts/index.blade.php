<x-app-layout>
<div class="p-4 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Accounts</h1>
        <a href="{{ route('accounts.create') }}" class="text-indigo-600">New</a>
    </div>
    @if($accounts->isEmpty())
        <x-empty-state>No accounts yet.</x-empty-state>
    @else
        <div class="space-y-2">
            @foreach($accounts as $account)
                <x-card class="flex items-center justify-between">
                    <div>
                        <div class="font-medium">{{ $account->name }}</div>
                        <div class="text-xs text-gray-500">{{ ucfirst($account->type) }} • {{ $account->currency }}</div>
                    </div>
                    <div class="text-right">
                        <x-money :amount="$account->balance" :currency="$account->currency" />
                        <div class="text-xs"><a href="{{ route('accounts.show', $account) }}" class="text-indigo-600">View</a></div>
                    </div>
                </x-card>
            @endforeach
        </div>
    @endif
    <x-bottom-nav />
</div>
</x-app-layout>


