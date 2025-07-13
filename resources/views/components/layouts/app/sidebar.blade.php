<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-gray-100 flex">
    <aside class="bg-green-800 text-white w-64 flex flex-col justify-between">
        <div>
            <div class="p-4 text-2xl font-bold">Trámite Digital</div>
            <nav class="mt-4">
                <ul>
                    <li><a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-green-700 {{ request()->routeIs('dashboard') ? 'bg-green-700' : '' }}">Dashboard</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-green-700">Mis Asignaciones</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-green-700">Pendientes</a></li>
                    <li><a href="#" class="block px-4 py-2 hover:bg-green-700">Completados</a></li>
                    <li><a href="{{ route('archivo.central') }}" class="block px-4 py-2 hover:bg-green-700 {{ request()->is('archivo-central') ? 'bg-green-700' : '' }}">Archivo Central</a></li>
                </ul>
            </nav>
        </div>
        <div class="p-4 space-y-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded">Cerrar Sesión</button>
            </form>
            <div class="flex items-center space-x-2">
                <span class="relative flex h-8 w-8 overflow-hidden rounded-full bg-green-500 justify-center items-center uppercase">{{ auth()->user()->initials() }}</span>
                <span>{{ auth()->user()->name }}</span>
            </div>
        </div>
    </aside>
    <main class="flex-1">
        {{ $slot }}
    </main>
    @fluxScripts
</body>
</html>
