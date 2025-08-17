<x-app-layout>
<div class="p-4 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Transactions</h1>
        <a href="{{ route('transactions.create') }}" class="text-indigo-600">Add</a>
    </div>
    <form method="get" class="grid grid-cols-2 gap-2">
        <x-select name="account_id" label="Account">
            <option value="">All</option>
            @foreach($accounts as $a)
                <option value="{{ $a->id }}" @selected(request('account_id')==$a->id)>{{ $a->name }}</option>
            @endforeach
        </x-select>
        <x-select name="type" label="Type">
            <option value="">All</option>
            @foreach(['income','expense','transfer'] as $t)
                <option value="{{ $t }}" @selected(request('type')==$t)>{{ ucfirst($t) }}</option>
            @endforeach
        </x-select>
        <x-select name="category_id" label="Category">
            <option value="">All</option>
            @foreach($categories as $c)
                <option value="{{ $c->id }}" @selected(request('category_id')==$c->id)>{{ ucfirst($c->type) }} • {{ $c->name }}</option>
            @endforeach
        </x-select>
        <x-select name="counterparty_id" label="Counterparty">
            <option value="">All</option>
            @foreach($counterparties as $p)
                <option value="{{ $p->id }}" @selected(request('counterparty_id')==$p->id)>{{ $p->name }}</option>
            @endforeach
        </x-select>
        <x-input name="from" label="From" type="date" value="{{ request('from') }}" />
        <x-input name="to" label="To" type="date" value="{{ request('to') }}" />
        <x-input name="q" label="Search" value="{{ request('q') }}" />
        <div class="self-end"><x-button type="submit" class="w-full">Filter</x-button></div>
    </form>

    <x-card>
        <div class="space-y-2">
            @forelse($transactions as $t)
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-medium capitalize">{{ $t->type }}</div>
                        <div class="text-xs text-gray-500">{{ optional($t->occurred_at)->format('Y-m-d H:i') }}</div>
                    </div>
                    <x-money :amount="$t->amount" />
                </div>
            @empty
                <x-empty-state>No transactions found.</x-empty-state>
            @endforelse
        </div>
        <div class="mt-3">{{ $transactions->links() }}</div>
    </x-card>
    <x-bottom-nav />
</div>
</x-app-layout>


