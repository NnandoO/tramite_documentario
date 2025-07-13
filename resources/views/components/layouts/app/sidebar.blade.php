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
                    @if(auth()->user()->role_id == 4)
                        <li><a href="{{ url('/operador/repositorio') }}" class="block px-4 py-2 hover:bg-green-700 {{ request()->is('operador/repositorio') ? 'bg-green-700' : '' }}">Repositorio Digital</a></li>
                        <li><a href="{{ url('/operador/solicitudes') }}" class="block px-4 py-2 hover:bg-green-700 {{ request()->is('operador/solicitudes*') ? 'bg-green-700' : '' }}">Solicitudes</a></li>
                        <li><a href="{{ url('/operador/entregas') }}" class="block px-4 py-2 hover:bg-green-700 {{ request()->is('operador/entregas*') ? 'bg-green-700' : '' }}">Entregas y Notificaciones</a></li>
                        <li><a href="{{ url('/operador/auditoria') }}" class="block px-4 py-2 hover:bg-green-700 {{ request()->is('operador/auditoria') ? 'bg-green-700' : '' }}">Auditoría de Entregas</a></li>
                    @endif
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
