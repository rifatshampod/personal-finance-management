<x-app-layout>
<form method="post" action="{{ route('counterparties.store') }}" class="p-4 space-y-3">
    @csrf
    <x-input name="name" label="Name" required />
    <x-select name="kind" label="Kind">
        <option value="person">Person</option>
        <option value="business">Business</option>
    </x-select>
    <x-input name="email" label="Email" type="email" />
    <x-input name="phone" label="Phone" />
    <x-input name="notes" label="Notes" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


