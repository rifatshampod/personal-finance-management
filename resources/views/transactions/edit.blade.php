<x-app-layout>
<form method="post" action="{{ route('transactions.update', $transaction) }}" enctype="multipart/form-data" class="p-4 space-y-3">
    @csrf
    @method('put')
    <x-select name="account_id" label="Account" required>
        @foreach($accounts as $a)
            <option value="{{ $a->id }}" @selected($transaction->account_id===$a->id)>{{ $a->name }}</option>
        @endforeach
    </x-select>
    <x-input name="amount" type="number" step="0.01" label="Amount" value="{{ $transaction->amount }}" required />
    <x-input name="occurred_at" type="datetime-local" label="Date/Time" value="{{ optional($transaction->occurred_at)->format('Y-m-d\TH:i') }}" />
    <x-select name="category_id" label="Category">
        <optgroup label="Income">
            @foreach($incomeCategories as $c)
                <option value="{{ $c->id }}" @selected($transaction->category_id===$c->id)>{{ $c->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Expense">
            @foreach($expenseCategories as $c)
                <option value="{{ $c->id }}" @selected($transaction->category_id===$c->id)>{{ $c->name }}</option>
            @endforeach
        </optgroup>
    </x-select>
    <x-select name="counterparty_id" label="Counterparty">
        <option value="">None</option>
        @foreach($counterparties as $p)
            <option value="{{ $p->id }}" @selected($transaction->counterparty_id===$p->id)>{{ $p->name }}</option>
        @endforeach
    </x-select>
    <x-input name="notes" label="Notes" value="{{ $transaction->notes }}" />
    <x-input name="attachment" type="file" label="Attachment" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


