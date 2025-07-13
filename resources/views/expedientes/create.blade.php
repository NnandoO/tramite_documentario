<x-layouts.app :title="__('Registrar Expediente')">
    <div class="container mx-auto grid max-w-xl gap-6 p-6">
        <h1 class="text-2xl font-bold">{{ __('Registrar Expediente') }}</h1>
        <form x-data="metadatos()" @submit.prevent="submit()" novalidate method="POST" action="{{ route('expedientes.store') }}" class="grid gap-4">
            @csrf
            <x-form.field label="Nombre del expediente" name="nombre" :errors="$errors->get('nombre')">
                <input id="nombre" type="text" name="nombre" value="{{ old('nombre') }}" required class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
            </x-form.field>

            <x-form.field label="Dependencia de origen" name="dependencia" :errors="$errors->get('dependencia')">
                <select id="dependencia" name="dependencia" required class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="" disabled {{ old('dependencia') ? '' : 'selected' }}>{{ __('Seleccione') }}</option>
                    @foreach($dependencias as $dependencia)
                        <option value="{{ $dependencia->id }}" @selected(old('dependencia') == $dependencia->id)>{{ $dependencia->nombre }}</option>
                    @endforeach
                </select>
            </x-form.field>

            <h2 class="mt-4 text-lg font-semibold">{{ __('Metadatos del expediente') }}</h2>

            <x-form.field label="Tipo de trámite" name="tipo_tramite" :errors="$errors->get('tipo_tramite')">
                <select id="tipo_tramite" name="tipo_tramite"
                    x-model="fields.tipo_tramite"
                    @change="validate('tipo_tramite')"
                    :class="classes('tipo_tramite')"
                    required
                    class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="" disabled {{ old('tipo_tramite') ? '' : 'selected' }}>{{ __('Seleccione') }}</option>
                    @foreach($tramites as $tramite)
                        <option value="{{ $tramite->id }}" @selected(old('tipo_tramite') == $tramite->id)>{{ $tramite->nombre }}</option>
                    @endforeach
                </select>
            </x-form.field>

            <x-form.field label="Fecha del expediente" name="fecha_expediente" :errors="$errors->get('fecha_expediente')">
                <input id="fecha_expediente" type="date" name="fecha_expediente"
                    x-model="fields.fecha_expediente"
                    @input="validate('fecha_expediente')"
                    :class="classes('fecha_expediente')"
                    value="{{ old('fecha_expediente') }}" required
                    class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" />
            </x-form.field>

            <x-form.field label="Facultad" name="facultad" :errors="$errors->get('facultad')">
                <select id="facultad" name="facultad"
                    x-model="fields.facultad"
                    @change="validate('facultad')"
                    :class="classes('facultad')"
                    required
                    class="w-full rounded border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="" disabled {{ old('facultad') ? '' : 'selected' }}>{{ __('Seleccione') }}</option>
                    @foreach($facultades as $facultad)
                        <option value="{{ $facultad->id }}" @selected(old('facultad') == $facultad->id)>{{ $facultad->nombre }}</option>
                    @endforeach
                </select>
            </x-form.field>

            <div class="flex justify-end">
                <button type="submit"
                    :disabled="hasErrors"
                    class="rounded bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed">
                    {{ __('Guardar y archivar') }}
                </button>
            </div>
        </form>
        <script>
            function metadatos() {
                return {
                    fields: {
                        tipo_tramite: '{{ old('tipo_tramite') }}',
                        fecha_expediente: '{{ old('fecha_expediente') }}',
                        facultad: '{{ old('facultad') }}',
                    },
                    validation: {},
                    validate(field) {
                        const value = this.fields[field];
                        let valid = true;
                        let message = '';

                        if (!value) {
                            valid = false;
                            message = '{{ __('Este campo es obligatorio.') }}';
                        } else if (field === 'fecha_expediente') {
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
                        return this.validation[field].valid
                            ? 'border-green-500 focus:border-green-500 focus:ring-green-300'
                            : 'border-red-500 focus:border-red-500 focus:ring-red-300';
                    },
                    get hasErrors() {
                        return Object.values(this.validation).some(v => !v.valid);
                    },
                    init() {
                        ['tipo_tramite','fecha_expediente','facultad'].forEach(f => this.validate(f));
                    },
                    submit() {
                        ['tipo_tramite','fecha_expediente','facultad'].forEach(f => this.validate(f));
                        if (!this.hasErrors) this.$el.submit();
                    }
                }
            }
        </script>
    </div>
</x-layouts.app>
