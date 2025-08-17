<nav class="fixed bottom-0 inset-x-0 z-40 bg-white border-t border-gray-200 md:hidden">
    <ul class="grid grid-cols-5 text-xs">
        <li><a href="{{ route('dashboard') }}" class="block p-3 text-center">Dashboard</a></li>
        <li><a href="{{ route('accounts.index') }}" class="block p-3 text-center">Accounts</a></li>
        <li><a href="{{ route('transactions.create') }}" class="block p-3 text-center font-semibold">+</a></li>
        <li><a href="{{ route('obligations.index') }}" class="block p-3 text-center">IOUs</a></li>
        <li><a href="{{ route('settings.index') }}" class="block p-3 text-center">More</a></li>
    </ul>
</nav>


