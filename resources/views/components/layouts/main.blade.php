<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mesa de Partes Virtual') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-white">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-[#22572D] min-h-screen flex flex-col fixed left-0">
            <div class="p-4 text-white">
                <h1 class="text-xl font-bold">Mesa de Partes Virtual</h1>
                <p class="text-sm text-gray-300">UNCP</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 pt-4">
                <a href="{{ route('dashboard') }}"
                   class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard') ? 'bg-[#E5C300] text-black' : 'text-white hover:bg-[#1a4423]' }}">
                    <i class="fas fa-home w-6"></i>
                    <span>Mi Panel</span>
                </a>

                <!-- Menú desplegable para Nuevo Trámite -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open"
                            class="flex items-center w-full px-4 py-3 text-white hover:bg-[#1a4423]">
                        <i class="fas fa-file-alt w-6"></i>
                        <span>Nuevo Trámite</span>
                        <i class="fas fa-chevron-down ml-auto"></i>
                    </button>
                    <div x-show="open"
                         @click.away="open = false"
                         class="absolute left-0 w-full bg-[#1a4423] py-2">
                        <a href="{{ route('tramites.nuevo', 'cambio-asesor') }}"
                           class="block px-4 py-2 text-white hover:bg-[#22572D]">
                            Cambio de Asesor
                        </a>
                        <a href="{{ route('tramites.nuevo', 'designacion-jurado') }}"
                           class="block px-4 py-2 text-white hover:bg-[#22572D]">
                            Designación de Jurado
                        </a>
                        <a href="{{ route('tramites.nuevo', 'carta-no-adeudo') }}"
                           class="block px-4 py-2 text-white hover:bg-[#22572D]">
                            Carta de No Adeudo
                        </a>
                    </div>
                </div>

                <a href="{{ route('tramites.index') }}"
                   class="flex items-center px-4 py-3 {{ request()->routeIs('tramites.*') ? 'bg-[#E5C300] text-black' : 'text-white hover:bg-[#1a4423]' }}">
                    <i class="fas fa-history w-6"></i>
                    <span>Historial de Trámites</span>
                </a>
            </nav>

            <!-- User Profile -->
            <div class="p-4 bg-[#1a4423] text-white">
                <div class="flex items-center space-x-3">
                    <div class="bg-[#E5C300] rounded-full w-8 h-8 flex items-center justify-center text-black font-bold">
                        {{ substr(Auth::user()->name ?? '', 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-medium">{{ Auth::user()->name ?? 'Usuario' }}</p>
                        <p class="text-xs text-gray-300">Estudiante</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 ml-64">
            <!-- Top Navigation -->
            <div class="bg-white border-b border-gray-200">
                <div class="px-4 py-3 flex justify-between items-center">
                    <nav class="flex" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <span class="text-gray-700">{{ request()->route()->getName() }}</span>
                            </li>
                        </ol>
                    </nav>
                    <div>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-800 flex items-center">
                                <i class="fas fa-sign-out-alt mr-2"></i>
                                Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <main class="p-6 bg-gray-100 min-h-screen">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
