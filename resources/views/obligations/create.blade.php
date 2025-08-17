<x-app-layout>
<form method="post" action="{{ route('obligations.store') }}" class="p-4 space-y-3">
    @csrf
    <x-select name="counterparty_id" label="Counterparty">
        @foreach($counterparties as $p)
            <option value="{{ $p->id }}">{{ $p->name }}</option>
        @endforeach
    </x-select>
    <x-select name="direction" label="Direction">
        <option value="i_owe">I owe</option>
        <option value="owed_to_me">Owed to me</option>
    </x-select>
    <x-input name="principal_amount" label="Amount" type="number" step="0.01" required />
    <x-input name="currency" label="Currency" value="EUR" />
    <x-input name="purpose" label="Purpose" />
    <x-input name="due_date" label="Due Date" type="date" />
    <x-input name="notes" label="Notes" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


