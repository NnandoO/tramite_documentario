<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-gray-100 text-gray-800 flex">
    <aside class="bg-gray-800 text-white w-64 p-4 space-y-2">
        <h1 class="text-xl font-semibold mb-4">Operador: {{ auth()->user()->name }}</h1>
        <nav class="space-y-1">
            <a href="{{ url('/operador/repositorio') }}" class="block hover:bg-gray-700 rounded p-2">Repositorio Digital</a>
            <a href="{{ url('/operador/solicitudes') }}" class="block hover:bg-gray-700 rounded p-2">Solicitudes</a>
            <a href="{{ url('/operador/entregas') }}" class="block hover:bg-gray-700 rounded p-2">Entregas y Notificaciones</a>
            <a href="{{ url('/operador/auditoria') }}" class="block hover:bg-gray-700 rounded p-2">Auditoría de Entregas</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="pt-4">
            @csrf
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 rounded p-2">Cerrar sesión</button>
        </form>
    </aside>
    <main class="flex-1 p-4">
        @yield('module')
    </main>
    @fluxScripts
</body>
</html>
