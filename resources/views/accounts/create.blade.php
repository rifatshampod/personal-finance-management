<x-app-layout>
<form method="post" action="{{ route('accounts.store') }}" class="p-4 space-y-3">
    @csrf
    <x-input name="name" label="Name" required />
    <x-select name="type" label="Type" required>
        <option value="cash">Cash</option>
        <option value="bank">Bank</option>
        <option value="mobile_wallet">Mobile Wallet</option>
        <option value="card">Card</option>
        <option value="other">Other</option>
    </x-select>
    <x-input name="currency" label="Currency" value="EUR" />
    <x-input name="institution_name" label="Institution" />
    <x-input name="account_number" label="Account Number" />
    <x-input name="opening_balance" label="Opening Balance" type="number" step="0.01" value="0" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
<input type="hidden" name="currency" value="EUR" />
</form>
</x-app-layout>


