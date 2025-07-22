<div class="w-full min-h-screen bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-xl p-6 space-y-8">

        {{-- Sección 1: Lista de funcionarios --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-4">Funcionarios de Soporte</h2>
            <div class="grid md:grid-cols-3 gap-4">
                @php
                    $funcionarios = [
                        ['nombre' => 'Funcionario 1', 'telefono' => '987654321', 'correo' => 'func1@soporte.edu'],
                        ['nombre' => 'Funcionario 2', 'telefono' => '912345678', 'correo' => 'func2@soporte.edu'],
                        ['nombre' => 'Funcionario 3', 'telefono' => '901234567', 'correo' => 'func3@soporte.edu'],
                    ];
                @endphp

                @foreach ($funcionarios as $funcionario)
                    <div class="border border-gray-300 rounded-lg p-4 bg-gray-50">
                        <h3 class="font-semibold text-lg text-gray-700">{{ $funcionario['nombre'] }}</h3>
                        <p class="text-sm text-gray-600">📞 {{ $funcionario['telefono'] }}</p>
                        <p class="text-sm text-gray-600">✉️ {{ $funcionario['correo'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Sección 2: Formulario de contacto --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-4">Enviar mensaje de soporte</h2>

            <form class="space-y-4">
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Tus nombres</label>
                        <input type="text" id="nombre" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ej: Juan Pérez">
                    </div>

                    <div>
                        <label for="facultad" class="block text-sm font-medium text-gray-700 mb-1">Facultad</label>
                        <input type="text" id="facultad" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ej: Ingeniería de Sistemas">
                    </div>

                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" id="telefono" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ej: 987654321">
                    </div>

                    <div>
                        <label for="correo_usuario" class="block text-sm font-medium text-gray-700 mb-1">Tu correo (para recibir respuesta)</label>
                        <input type="email" id="correo_usuario" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Ej: tu.correo@ejemplo.com">
                    </div>

                    <div class="md:col-span-2">
                        <label for="correo_funcionario" class="block text-sm font-medium text-gray-700 mb-1">Enviar a funcionario</label>
                        <select id="correo_funcionario" class="w-full border border-gray-300 rounded-lg p-2">
                            <option value="">-- Seleccionar funcionario --</option>
                            @foreach ($funcionarios as $funcionario)
                                <option value="{{ $funcionario['correo'] }}">{{ $funcionario['nombre'] }} - {{ $funcionario['correo'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                    <textarea id="mensaje" rows="5" class="w-full border border-gray-300 rounded-lg p-2" placeholder="Escribe tu consulta..."></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-800 hover:bg-green-900 text-white px-6 py-2 rounded-lg shadow">
                        Enviar mensaje
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
