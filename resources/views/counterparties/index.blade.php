<x-app-layout>
<div class="p-4 space-y-4">
    <div class="flex items-center justify-between">
        <h1 class="text-xl font-semibold">Counterparties</h1>
        <a href="{{ route('counterparties.create') }}" class="text-indigo-600">New</a>
    </div>
    <x-card>
        <div class="space-y-2">
            @forelse($counterparties as $p)
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-medium">{{ $p->name }}</div>
                        <div class="text-xs text-gray-500 capitalize">{{ $p->kind }}</div>
                    </div>
                    <div class="text-xs"><a href="{{ route('counterparties.edit', $p) }}" class="text-indigo-600">Edit</a></div>
                </div>
            @empty
                <x-empty-state>No counterparties</x-empty-state>
            @endforelse
        </div>
        <div class="mt-3">{{ $counterparties->links() }}</div>
    </x-card>
    <x-bottom-nav />
</div>
</x-app-layout>


