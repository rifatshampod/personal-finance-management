<x-app-layout>
<form method="post" action="{{ route('categories.store') }}" class="p-4 space-y-3">
    @csrf
    <x-select name="type" label="Type">
        <option value="income">Income</option>
        <option value="expense">Expense</option>
    </x-select>
    <x-input name="name" label="Name" required />
    <x-input name="color" label="Color" value="#64748b" />
    <x-input name="icon" label="Icon" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


