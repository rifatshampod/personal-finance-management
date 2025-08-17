@props(['label' => null, 'name'])
<label class="block text-sm font-medium text-gray-700">{{ $label ?? ucwords(str_replace('_',' ',$name)) }}</label>
<input name="{{ $name }}" {{ $attributes->merge(['class' => 'mt-1 w-full rounded-md border-gray-300 bg-white text-gray-900 focus:border-indigo-500 focus:ring-indigo-500']) }} />


