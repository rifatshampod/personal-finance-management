<div class="p-4 space-y-4">
    <h1 class="text-xl font-semibold">Settings</h1>
    <x-card>
        <form method="post" action="#" class="space-y-2">
            @csrf
            <x-input name="default_currency" label="Default currency" value="EUR" />
            <label class="flex items-center gap-2"><input type="checkbox" name="dark_mode" class="rounded" /> Dark mode</label>
            <x-select name="week_start" label="Week starts on">
                <option value="1">Monday</option>
                <option value="0">Sunday</option>
            </x-select>
            <x-button type="submit">Save</x-button>
        </form>
    </x-card>
    <x-bottom-nav />
</div>


