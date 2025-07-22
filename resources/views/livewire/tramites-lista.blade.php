<div class="container mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800 text-center mb-2">Lista de Trámites</h1>
        <p class="text-gray-600 text-center">Selecciona el tipo de trámite que necesitas realizar</p>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-yellow-100 border border-yellow-300 text-yellow-700 rounded-lg">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex flex-col space-y-4">
        @foreach($types as $index => $tramite)
            <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow duration-300 border border-gray-200">
                <div class="p-6 flex items-center justify-between">
                    <div class="flex items-center flex-1">
                        <div class="flex-shrink-0 w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-4">
                            <span class="text-green-700 font-semibold text-sm">{{ $index + 1 }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-base font-semibold text-gray-800 leading-snug truncate pr-4">
                                {{ $tramite }}
                            </h3>
                        </div>
                    </div>

                    <div class="flex-shrink-0">
                        <button
                            wire:click="verDetalle({{ $index + 1 }})"
                            class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-4 rounded-lg text-sm transition duration-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                            Detalle
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(count($types) === 0)
        <div class="text-center py-16">
            <div class="text-gray-400 text-6xl mb-4">📄</div>
            <p class="text-gray-500 text-lg">No hay trámites disponibles en este momento</p>
        </div>
    @endif
</div>