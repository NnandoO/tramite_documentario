<x-layouts.app.sidebar :title="$title ?? null">
    <main class="p-6">
        @yield('content')
    </main>
</x-layouts.app.sidebar>
