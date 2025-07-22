<div>
    {{-- Botón de Notificaciones --}}
    <button wire:click="toggle" type="button"
        class="relative flex items-center px-3 py-2 rounded hover:bg-gray-100 transition focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" >
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159
                      c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <span>Notificaciones</span>
        @if ($noVistas > 0)
            <span class="ml-2 px-2 py-0.5 bg-red-600 text-white text-xs font-bold rounded-full">
                {{ $noVistas }}
            </span>
        @endif
    </button>

    {{-- Modal de Notificaciones --}}
    @if($open)
        {{-- Fondo oscuro que cubre toda la pantalla --}}
        <div class="fixed inset-0 bg-black bg-opacity-30 z-40"
             style="backdrop-filter: blur(1px);"
             wire:click="toggle"></div> {{-- Cierra el modal al hacer clic fuera --}}

        {{-- Contenedor del Modal principal (centrado) --}}
        <div class="fixed inset-0 flex items-center justify-center z-50 p-4">
            {{-- Contenido del Modal --}}
            <div class="bg-white rounded-lg shadow-lg p-4 max-w-md w-full mx-auto"
                 @click.stop> {{-- Evita que el click dentro del modal cierre el fondo --}}

                {{-- Título y botón para cerrar el modal principal --}}
                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-semibold text-lg">Notificaciones</h3>
                    <button wire:click="toggle" class="text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                {{-- Contenido de las notificaciones --}}
                @if(!$showPreferences) {{-- Solo muestra las notificaciones si no estamos en preferencias --}}
                    @if($notificaciones->isEmpty())
                        <p class="text-center text-gray-500 py-8">No tienes notificaciones.</p>
                    @else
                        <div class="space-y-3 max-h-64 overflow-y-auto"> {{-- Scroll si hay muchas notificaciones --}}
                            @foreach($notificaciones as $nota)
                                <div class="border rounded p-2 flex justify-between items-start
                                            @if(!$nota->visto) bg-gray-100 font-semibold @endif">
                                    <div>
                                        <p>{{ $nota->titulo }}</p>
                                        <p class="text-sm text-gray-600">{{ $nota->mensaje }}</p>
                                        <p class="text-xs text-gray-400">{{ $nota->created_at->diffForHumans() }}</p>
                                    </div>
                                    @if(!$nota->visto)
                                        <button wire:click="marcarComoVista({{ $nota->id }})"
                                                class="ml-2 bg-blue-600 hover:bg-blue-700 text-white px-2 py-1 rounded text-xs flex-shrink-0">
                                            Marcar como vista
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Botón para abrir la configuración de preferencias --}}
                    <div class="mt-4 border-t pt-4 text-center">
                        <button wire:click="openNotificationSettings"
                                class="text-blue-600 hover:text-blue-800 underline text-sm">
                            Configurar preferencias de notificación
                        </button>
                    </div>
                @else
                    {{-- Renderiza el componente de configuración de preferencias --}}
                    @livewire('notification-settings')

                    {{-- Botón para volver a la lista de notificaciones --}}
                    <div class="mt-4 text-center">
                        <button wire:click="closeNotificationSettings"
                                class="text-gray-600 hover:text-gray-900 underline text-sm">
                            Volver a Notificaciones
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>