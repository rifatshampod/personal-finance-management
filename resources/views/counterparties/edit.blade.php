<x-app-layout>
<form method="post" action="{{ route('counterparties.update', $counterparty) }}" class="p-4 space-y-3">
    @csrf
    @method('put')
    <x-input name="name" label="Name" value="{{ $counterparty->name }}" required />
    <x-select name="kind" label="Kind">
        @foreach(['person','business'] as $k)
            <option value="{{ $k }}" @selected($counterparty->kind===$k)>{{ ucfirst($k) }}</option>
        @endforeach
    </x-select>
    <x-input name="email" label="Email" type="email" value="{{ $counterparty->email }}" />
    <x-input name="phone" label="Phone" value="{{ $counterparty->phone }}" />
    <x-input name="notes" label="Notes" value="{{ $counterparty->notes }}" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


