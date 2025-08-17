<x-app-layout>
@php($user = auth()->user())
<div class="p-4 space-y-4">
    <h1 class="text-xl font-semibold">Dashboard</h1>
    <div class="grid grid-cols-2 gap-3">
        <x-card>
            <div class="text-sm text-gray-500">Total Balance</div>
            <div class="text-2xl font-semibold">{{-- computed in controller later --}}</div>
        </x-card>
        <x-card>
            <div class="text-sm text-gray-500">This Month Income</div>
            <div class="text-2xl font-semibold"></div>
        </x-card>
        <x-card>
            <div class="text-sm text-gray-500">This Month Expense</div>
            <div class="text-2xl font-semibold"></div>
        </x-card>
        <x-card>
            <div class="text-sm text-gray-500">Net Flow</div>
            <div class="text-2xl font-semibold"></div>
        </x-card>
    </div>

    <x-card>
        <div class="flex items-center justify-between">
            <h2 class="font-semibold">Open Obligations</h2>
            <a href="{{ route('obligations.index') }}" class="text-indigo-600">View all</a>
        </div>
        <div class="mt-3 text-sm text-gray-500">No data yet.</div>
    </x-card>

    <x-bottom-nav />
</div>
</x-app-layout>


