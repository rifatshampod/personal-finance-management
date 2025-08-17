<x-app-layout>
<form method="post" action="{{ route('accounts.update', $account) }}" class="p-4 space-y-3">
    @csrf
    @method('put')
    <x-input name="name" label="Name" value="{{ $account->name }}" required />
    <x-select name="type" label="Type" required>
        @foreach(['cash','bank','mobile_wallet','card','other'] as $t)
            <option value="{{ $t }}" @selected($account->type===$t)>{{ ucwords(str_replace('_',' ',$t)) }}</option>
        @endforeach
    </x-select>
    <x-input name="currency" label="Currency" value="{{ $account->currency }}" />
    <x-input name="institution_name" label="Institution" value="{{ $account->institution_name }}" />
    <x-input name="account_number" label="Account Number" value="{{ $account->account_number }}" />
    <x-input name="opening_balance" label="Opening Balance" type="number" step="0.01" value="{{ $account->opening_balance }}" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


