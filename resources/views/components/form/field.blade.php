@props(['label', 'name', 'type' => 'text', 'errors' => null])
<div class="grid gap-1">
    <label for="{{ $name }}" class="text-sm font-medium text-gray-700 dark:text-gray-200">{{ $label }}</label>
    <div class="relative">
        {{ $slot }}
        <svg
            x-show="validation['{{ $name }}'] && validation['{{ $name }}'].valid"
            class="pointer-events-none absolute right-2 top-1/2 size-4 -translate-y-1/2 text-green-600"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
        </svg>
        <svg
            x-show="validation['{{ $name }}'] && !validation['{{ $name }}'].valid"
            class="pointer-events-none absolute right-2 top-1/2 size-4 -translate-y-1/2 text-red-600"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </div>
    <p
        x-show="validation['{{ $name }}'] && !validation['{{ $name }}'].valid"
        x-text="validation['{{ $name }}'].message"
        class="text-sm text-red-600"></p>
    @if($errors)
        <p class="text-sm text-red-600">{{ $errors->first() }}</p>
    @endif
</div>
