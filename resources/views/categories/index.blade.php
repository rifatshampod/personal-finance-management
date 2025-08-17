<x-app-layout>
<div class="p-4 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Categories</h1>
        <a href="{{ route('categories.create') }}" class="text-indigo-600">New</a>
    </div>
    <div class="grid grid-cols-2 gap-3">
        <x-card>
            <h2 class="font-semibold">Income</h2>
            <div class="mt-2 space-y-2">
                @forelse($income as $c)
                    <div class="flex items-center justify-between">
                        <div>{{ $c->name }}</div>
                        <a href="{{ route('categories.edit', $c) }}" class="text-xs text-indigo-600">Edit</a>
                    </div>
                @empty
                    <x-empty-state>No income categories</x-empty-state>
                @endforelse
            </div>
        </x-card>
        <x-card>
            <h2 class="font-semibold">Expense</h2>
            <div class="mt-2 space-y-2">
                @forelse($expense as $c)
                    <div class="flex items-center justify-between">
                        <div>{{ $c->name }}</div>
                        <a href="{{ route('categories.edit', $c) }}" class="text-xs text-indigo-600">Edit</a>
                    </div>
                @empty
                    <x-empty-state>No expense categories</x-empty-state>
                @endforelse
            </div>
        </x-card>
    </div>
    <x-bottom-nav />
</div>
</x-app-layout>


