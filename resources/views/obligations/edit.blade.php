<x-app-layout>
<form method="post" action="{{ route('obligations.update', $obligation) }}" class="p-4 space-y-3">
    @csrf
    @method('put')
    <x-select name="counterparty_id" label="Counterparty">
        @foreach($counterparties as $p)
            <option value="{{ $p->id }}" @selected($obligation->counterparty_id===$p->id)>{{ $p->name }}</option>
        @endforeach
    </x-select>
    <x-select name="direction" label="Direction">
        @foreach(['i_owe' => 'I owe', 'owed_to_me' => 'Owed to me'] as $k => $v)
            <option value="{{ $k }}" @selected($obligation->direction===$k)>{{ $v }}</option>
        @endforeach
    </x-select>
    <x-input name="principal_amount" label="Amount" type="number" step="0.01" value="{{ $obligation->principal_amount }}" required />
    <x-input name="currency" label="Currency" value="{{ $obligation->currency }}" />
    <x-input name="purpose" label="Purpose" value="{{ $obligation->purpose }}" />
    <x-input name="due_date" label="Due Date" type="date" value="{{ optional($obligation->due_date)->format('Y-m-d') }}" />
    <x-input name="notes" label="Notes" value="{{ $obligation->notes }}" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


