@props(['label', 'name' => 'documents[]', 'errors'])
<div class="grid gap-1">
    <label class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $label }}</label>
    <input type="file" name="{{ $name }}" accept="application/pdf" multiple
        class="w-full rounded border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" />
    @if($errors)
        <p class="text-sm text-red-600">{{ $errors->first() }}</p>
    @endif
</div>
