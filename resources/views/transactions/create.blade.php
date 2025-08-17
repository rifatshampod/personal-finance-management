<x-app-layout>
<form method="post" action="{{ route('transactions.store') }}" enctype="multipart/form-data" class="p-4 space-y-3" x-data="{ type: 'expense' }">
    @csrf
    <div class="flex gap-2">
        @foreach(['income','expense','transfer'] as $t)
            <button type="button" x-on:click="type='{{ $t }}'" :class="type==='{{ $t }}' ? 'bg-indigo-600 text-white' : 'bg-gray-100'" class="px-3 py-1 rounded">{{ ucfirst($t) }}</button>
        @endforeach
    </div>
    <input type="hidden" name="type" :value="type" />
    <x-select name="account_id" label="Account" required>
        @foreach($accounts as $a)
            <option value="{{ $a->id }}">{{ $a->name }}</option>
        @endforeach
    </x-select>
    <div x-show="type==='transfer'">
        <x-select name="destination_account_id" label="Destination Account">
            @foreach($accounts as $a)
                <option value="{{ $a->id }}">{{ $a->name }}</option>
            @endforeach
        </x-select>
    </div>
    <x-input name="amount" type="number" step="0.01" label="Amount" required />
    <x-input name="occurred_at" type="datetime-local" label="Date/Time" />
    <div x-show="type!=='transfer'">
        <x-select name="category_id" label="Category">
            <optgroup label="Income" x-show="type==='income'">
                @foreach($incomeCategories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </optgroup>
            <optgroup label="Expense" x-show="type==='expense'">
                @foreach($expenseCategories as $c)
                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </optgroup>
        </x-select>
        <x-select name="counterparty_id" label="Counterparty">
            <option value="">None</option>
            @foreach($counterparties as $p)
                <option value="{{ $p->id }}">{{ $p->name }}</option>
            @endforeach
        </x-select>
    </div>
    <x-input name="notes" label="Notes" />
    <x-input name="attachment" type="file" label="Attachment" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


