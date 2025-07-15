<x-layouts.app :title="__('Archivo Central')">
    <!-- Título -->
    <div class="pb-4">
        <h1 class="text-3xl font-bold text-green-800">Registro de expediente</h1>
    </div>

    <!-- Formulario de registro -->
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl p-6 mb-6 space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <flux:input name="nombre" placeholder="Nombre del expediente" label="Nombre del expediente" />
            <flux:input name="dependencia" placeholder="Dependencia de origen" label="Dependencia de origen" />
            <flux:input type="date" name="fecha" label="Fecha" />
        </div>
        <div>
            <flux:button color="yellow">Guardar expediente</flux:button>
        </div>
    </div>

    <!-- Filtros -->
    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl mt-5 p-4 space-y-6">
        <flux:input icon="magnifying-glass" placeholder="Filtrar por palabras clave " />
    </div>

    <div class="max-w-5xl mx-auto bg-white shadow-md rounded-xl mt-3 p-4 space-y-6">
        <span class="text-gray-700 text-bold">Filtros </span>
        <flux:input icon="magnifying-glass" placeholder="Filtrar por palabras clave " />
        <div class="flex flex-wrap gap-4 mt-4">
            <flux:select wire:model="year" placeholder="Año">
                <flux:select.option>2021</flux:select.option>
                <flux:select.option>2022</flux:select.option>
                <flux:select.option>2023</flux:select.option>
                <flux:select.option>2024</flux:select.option>
                <flux:select.option>2025</flux:select.option>
            </flux:select>

            <flux:select wire:model="month" placeholder="Mes">
                <flux:select.option>Enero</flux:select.option>
                <flux:select.option>Febrero</flux:select.option>
                <flux:select.option>Marzo</flux:select.option>
                <flux:select.option>Abril</flux:select.option>
                <flux:select.option>Mayo</flux:select.option>
                <flux:select.option>Junio</flux:select.option>
                <flux:select.option>Julio</flux:select.option>
                <flux:select.option>Agosto</flux:select.option>
                <flux:select.option>Septiembre</flux:select.option>
                <flux:select.option>Octubre</flux:select.option>
                <flux:select.option>Noviembre</flux:select.option>
                <flux:select.option>Diciembre</flux:select.option>
            </flux:select>

        <flux:select wire:model="faculty" placeholder="Facultad">
    <flux:select.option>Enfermería</flux:select.option>
    <flux:select.option>Medicina Humana</flux:select.option>
    <flux:select.option>Arquitectura</flux:select.option>
    <flux:select.option>Ingeniería Civil</flux:select.option>
    <flux:select.option>Ingeniería de Minas</flux:select.option>
    <flux:select.option>Ingeniería de Sistemas</flux:select.option>
    <flux:select.option>Ingeniería Eléctrica y Electrónica</flux:select.option>
    <flux:select.option>Ingeniería Mecánica</flux:select.option>
    <flux:select.option>Ingeniería Metalúrgica y de Materiales</flux:select.option>
    <flux:select.option>Ingeniería Química</flux:select.option>
    <flux:select.option>Ingeniería Química Industrial</flux:select.option>
    <flux:select.option>Ingeniería Química Ambiental</flux:select.option>
    <flux:select.option>Administración de Empresas</flux:select.option>
    <flux:select.option>Contabilidad</flux:select.option>
    <flux:select.option>Economía</flux:select.option>
    <flux:select.option>Administración de Negocios - Tarma</flux:select.option>
    <flux:select.option>Administración Hotelera y Turismo - Tarma</flux:select.option>
    <flux:select.option>Antropología</flux:select.option>
    <flux:select.option>Ciencias de la Comunicación</flux:select.option>
    <flux:select.option>Derecho y Ciencias Políticas</flux:select.option>
    <flux:select.option>Sociología</flux:select.option>
    <flux:select.option>Trabajo Social</flux:select.option>
    <flux:select.option>Educación Inicial</flux:select.option>
    <flux:select.option>Educación Primaria</flux:select.option>
    <flux:select.option>Educación Filosofía, Ciencias Sociales y Relaciones Humanas</flux:select.option>
    <flux:select.option>Educación Lengua, Literatura y Comunicación</flux:select.option>
    <flux:select.option>Educación Ciencias Naturales y Ambientales</flux:select.option>
    <flux:select.option>Educación Ciencias Matemáticas e Informática</flux:select.option>
    <flux:select.option>Educación Física y Psicomotricidad</flux:select.option>
    <flux:select.option>Agronomía</flux:select.option>
    <flux:select.option>Ciencias Forestales y del Ambiente</flux:select.option>
    <flux:select.option>Ingeniería en Industrias Alimentarias</flux:select.option>
    <flux:select.option>Zootecnia</flux:select.option>
    <flux:select.option>Ing. Agroindustrial - Tarma</flux:select.option>
    <flux:select.option>Ing. Agronomía Tropical - Satipo</flux:select.option>
    <flux:select.option>Ing. Forestal Tropical - Satipo</flux:select.option>
    <flux:select.option>Ing. Industrias Alimentarias Tropical - Satipo</flux:select.option>
    <flux:select.option>Zootecnia Tropical - Satipo</flux:select.option>
</flux:select>


        <flux:select wire:model="document_type" placeholder="Tipo de documento">
            <flux:select.option>Solicitud</flux:select.option>
            <flux:select.option>Constancia</flux:select.option>
            <flux:select.option>Certificado</flux:select.option>
            <flux:select.option>Resolución</flux:select.option>
            <flux:select.option>Informe</flux:select.option>
            <flux:select.option>Memorando</flux:select.option>
            <flux:select.option>Oficio</flux:select.option>
        </flux:select>

        <flux:select wire:model="status" placeholder="Estado">
            <flux:select.option>Pendiente</flux:select.option>
            <flux:select.option>En Proceso</flux:select.option>
            <flux:select.option>Finalizado</flux:select.option>
        </flux:select>

        <div class="flex justify-end">
            <flux:button variant="primary" color="yellow">Limpiar filtros</flux:button>
        </div>
    </div>


    <!-- Tabla de expedientes -->
    <div class="bg-white shadow-md rounded-xl p-6">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700 uppercase">
                <tr>
                    <th class="px-4 py-2">Código</th>
                    <th class="px-4 py-2">Trámite</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Facultad</th>
                    <th class="px-4 py-2">Estado</th>
                    <th class="px-4 py-2 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <tr>
                    <td class="px-4 py-2">00001</td>
                    <td class="px-4 py-2">Constancia de estudios</td>
                    <td class="px-4 py-2">08/07/2025</td>
                    <td class="px-4 py-2">Sistemas</td>
                    <td class="px-4 py-2">Finalizado</td>
                    <td class="px-4 py-2 text-center">
                        <a href="#" class="text-green-700 font-bold text-lg">👁️</a>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-2">00002</td>
                    <td class="px-4 py-2">Constancia de estudios</td>
                    <td class="px-4 py-2">09/07/2025</td>
                    <td class="px-4 py-2">Sistemas</td>
                    <td class="px-4 py-2">Finalizado</td>
                    <td class="px-4 py-2 text-center">
                        <a href="#" class="text-green-700 font-bold text-lg">👁️</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</x-layouts.app>
