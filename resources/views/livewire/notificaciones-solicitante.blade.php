<div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/notificacionesSolicitante.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    @endpush

    <main class="main-content p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Mis notificaciones</h2>

        @if (count($notificaciones))
            <div class="tabla-scroll">
                <table class="expedientes-table">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-2">N° Expediente</th>
                            <th class="p-2">Mensaje</th>
                            <th class="p-2">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notificaciones as $notif)
                            <tr>
                                <td class="p-2">{{ $notif->codigo }}</td>
                                <td class="p-2">{{ $notif->mensaje }}</td>
                                <td class="p-2">{{ \Carbon\Carbon::parse($notif->created_at)->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center text-gray-500 py-8">
                <i class="fas fa-bell-slash fa-2x mb-2"></i>
                <p>No tienes notificaciones por el momento.</p>
            </div>
        @endif
    </main>
</div>
