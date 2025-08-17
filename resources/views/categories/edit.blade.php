<x-app-layout>
<form method="post" action="{{ route('categories.update', $category) }}" class="p-4 space-y-3">
    @csrf
    @method('put')
    <x-select name="type" label="Type">
        @foreach(['income','expense'] as $t)
            <option value="{{ $t }}" @selected($category->type===$t)>{{ ucfirst($t) }}</option>
        @endforeach
    </x-select>
    <x-input name="name" label="Name" value="{{ $category->name }}" required />
    <x-input name="color" label="Color" value="{{ $category->color }}" />
    <x-input name="icon" label="Icon" value="{{ $category->icon }}" />
    <div class="fixed bottom-0 inset-x-0 bg-white border-t p-3">
        <x-button type="submit" class="w-full">Save</x-button>
    </div>
</form>
</x-app-layout>


