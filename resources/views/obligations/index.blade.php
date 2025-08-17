<x-app-layout>
<div class="p-4 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">IOUs</h1>
        <a href="{{ route('obligations.create') }}" class="text-indigo-600">New</a>
    </div>
    <div class="grid grid-cols-2 gap-3">
        <x-card>
            <h2 class="font-semibold">I owe</h2>
            <div class="mt-2 space-y-2">
                @forelse($iOwe as $o)
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $o->counterparty->name }}</div>
                            <div class="text-xs text-gray-500">Due {{ optional($o->due_date)->format('Y-m-d') }}</div>
                        </div>
                        <x-money :amount="$o->remaining_amount" :currency="$o->currency" />
                    </div>
                @empty
                    <x-empty-state>No debts</x-empty-state>
                @endforelse
            </div>
        </x-card>
        <x-card>
            <h2 class="font-semibold">Owed to me</h2>
            <div class="mt-2 space-y-2">
                @forelse($owedToMe as $o)
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $o->counterparty->name }}</div>
                            <div class="text-xs text-gray-500">Due {{ optional($o->due_date)->format('Y-m-d') }}</div>
                        </div>
                        <x-money :amount="$o->remaining_amount" :currency="$o->currency" />
                    </div>
                @empty
                    <x-empty-state>No receivables</x-empty-state>
                @endforelse
            </div>
        </x-card>
    </div>
    <x-bottom-nav />
</div>
</x-app-layout>


