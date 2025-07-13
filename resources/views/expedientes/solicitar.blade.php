<x-layouts.app :title="__('Solicitar Copia')">
    <div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow">
        <h1 class="text-xl font-semibold mb-4">{{ __('Solicitar Copia de Expediente') }}</h1>
        @if($isRestricted ?? false)
            <div class="mb-4 p-4 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700">
                {{ __('Este expediente es restringido: debes indicar el motivo de tu solicitud.') }}
            </div>
        @endif
        <form x-data="solicitud()" @submit.prevent="submit" novalidate method="POST" action="{{ route('expedientes.solicitar.store') }}" class="grid gap-4">
            @csrf
            <x-form.field label="{{ __('Nombre solicitante') }}" name="nombre_solicitante" :errors="$errors->get('nombre_solicitante')">
                <input id="nombre_solicitante" type="text" name="nombre_solicitante" x-model="fields.nombre_solicitante" @input="validate('nombre_solicitante')" :class="classes('nombre_solicitante')" class="w-full border-gray-300 rounded focus:ring-indigo-200 focus:border-indigo-300" required />
            </x-form.field>
            <x-form.field label="{{ __('Código de expediente') }}" name="codigo_expediente" :errors="$errors->get('codigo_expediente')">
                <input id="codigo_expediente" type="text" name="codigo_expediente" x-model="fields.codigo_expediente" @input="validate('codigo_expediente')" :class="classes('codigo_expediente')" class="w-full border-gray-300 rounded focus:ring-indigo-200 focus:border-indigo-300" required />
            </x-form.field>
            <x-form.field label="{{ __('Tipo de trámite') }}" name="tipo_tramite" :errors="$errors->get('tipo_tramite')">
                <select id="tipo_tramite" name="tipo_tramite" x-model="fields.tipo_tramite" @change="validate('tipo_tramite')" :class="classes('tipo_tramite')" class="w-full border-gray-300 rounded focus:ring-indigo-200 focus:border-indigo-300" required>
                    <option value="" disabled>{{ __('Seleccione') }}</option>
                    @foreach($tramites as $id => $name)
                        <option value="{{ $id }}" @selected(old('tipo_tramite') == $id)>{{ $name }}</option>
                    @endforeach
                </select>
            </x-form.field>
            <x-form.field label="{{ __('Facultad') }}" name="facultad" :errors="$errors->get('facultad')">
                <select id="facultad" name="facultad" x-model="fields.facultad" @change="validate('facultad')" :class="classes('facultad')" class="w-full border-gray-300 rounded focus:ring-indigo-200 focus:border-indigo-300" required>
                    <option value="" disabled>{{ __('Seleccione') }}</option>
                    @foreach($facultades as $id => $name)
                        <option value="{{ $id }}" @selected(old('facultad') == $id)>{{ $name }}</option>
                    @endforeach
                </select>
            </x-form.field>
            <x-form.field label="{{ __('Fecha') }}" name="fecha" :errors="$errors->get('fecha')">
                <input id="fecha" type="date" name="fecha" x-model="fields.fecha" @input="validate('fecha')" :class="classes('fecha')" class="w-full border-gray-300 rounded focus:ring-indigo-200 focus:border-indigo-300" required />
            </x-form.field>
            <x-form.field label="{{ __('Motivo') }}" name="motivo" :errors="$errors->get('motivo')">
                <textarea name="motivo" rows="3" x-model="fields.motivo" @input="validate('motivo')"
                    class="w-full border rounded px-3 py-2 focus:ring-indigo-200 focus:border-indigo-300"
                    @if(!($isRestricted ?? false)) disabled @endif>{{ old('motivo') }}</textarea>
            </x-form.field>
            <x-form.field label="{{ __('Observaciones') }}" name="observaciones" :errors="$errors->get('observaciones')">
                <textarea id="observaciones" name="observaciones" x-model="fields.observaciones" class="w-full border-gray-300 rounded focus:ring-indigo-200 focus:border-indigo-300" rows="3"></textarea>
            </x-form.field>
            <div class="flex justify-end">
                <button type="submit" :disabled="hasErrors" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('Enviar solicitud') }}
                </button>
            </div>
        </form>
        <script>
            function solicitud() {
                return {
                    isRestricted: {{ $isRestricted ? 'true' : 'false' }},
                    fields: {
                        nombre_solicitante: '{{ old('nombre_solicitante') }}',
                        codigo_expediente: '{{ old('codigo_expediente') }}',
                        tipo_tramite: '{{ old('tipo_tramite') }}',
                        facultad: '{{ old('facultad') }}',
                        fecha: '{{ old('fecha') }}',
                        motivo: '{{ old('motivo') }}',
                        observaciones: '{{ old('observaciones') }}',
                    },
                    validation: {},
                    validate(field) {
                        const value = this.fields[field];
                        let valid = true;
                        let message = '';
                        if (!value && field !== 'observaciones' && !(field === 'motivo' && !this.isRestricted)) {
                            valid = false;
                            message = '{{ __('Este campo es obligatorio.') }}';
                        } else if (field === 'fecha') {
                            const today = new Date().toISOString().split('T')[0];
                            if (value > today) {
                                valid = false;
                                message = '{{ __('La fecha no puede ser futura.') }}';
                            }
                        }
                        this.validation[field] = { valid, message };
                    },
                    classes(field) {
                        if (!this.validation[field]) return '';
                        return this.validation[field].valid ? 'border-green-500 focus:border-green-500 focus:ring-green-300' : 'border-red-500 focus:border-red-500 focus:ring-red-300';
                    },
                    get hasErrors() {
                        const fields = ['nombre_solicitante','codigo_expediente','tipo_tramite','facultad','fecha'];
                        if (this.isRestricted) fields.push('motivo');
                        return fields.some(f => !this.validation[f]?.valid);
                    },
                    init() {
                        const fields = ['nombre_solicitante','codigo_expediente','tipo_tramite','facultad','fecha'];
                        if (this.isRestricted) fields.push('motivo');
                        fields.forEach(f => this.validate(f));
                    },
                    submit() {
                        const fields = ['nombre_solicitante','codigo_expediente','tipo_tramite','facultad','fecha'];
                        if (this.isRestricted) fields.push('motivo');
                        fields.forEach(f => this.validate(f));
                        if (!this.hasErrors) this.$el.submit();
                    }
                }
            }
        </script>
    </div>
</x-layouts.app>
