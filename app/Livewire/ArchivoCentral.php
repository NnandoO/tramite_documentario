<?php

namespace App\Livewire;

use App\Models\Expediente;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ArchivoCentral extends Component
{
    use WithPagination;
    public $search = '';
    public $year;
    public $month;
    public $faculty;
    public $type;
    public $state;

    public const FACULTIES = [
        'Arquitectura',
        'Ingeniería Civil',
        'Ingeniería de Minas',
        'Ingeniería de Sistemas',
        'Ingeniería Eléctrica y Electrónica',
        'Ingeniería Mecánica',
        'Ingeniería Metalúrgica y de Materiales',
        'Ingeniería Química',
        'Ingeniería Química Industrial',
        'Ingeniería Química Ambiental',
        'Administración de Empresas',
        'Contabilidad',
        'Economía',
        'Administración de Negocios - Tarma',
        'Administración Hotelera y Turismo - Tarma',
        'Antropología',
        'Ciencias de la Comunicación',
        'Derecho y Ciencias Políticas',
        'Sociología',
        'Trabajo Social',
        'Educación Inicial',
        'Educación Primaria',
        'Educación Filosofía, Ciencias Sociales y Relaciones Humanas',
        'Educación Lengua, Literatura y Comunicación',
        'Educación Ciencias Naturales y Ambientales',
        'Educación Ciencias Matemáticas e Informática',
        'Educación Física y Psicomotricidad',
        'Agronomía',
        'Ciencias Forestales y del Ambiente',
        'Ingeniería en Industrias Alimentarias',
        'Zootecnia',
        'Ing. Agroindustrial - Tarma',
        'Ing. Agronomía Tropical - Satipo',
        'Ing. Forestal Tropical - Satipo',
        'Ing. Industrias Alimentarias Tropical - Satipo',
        'Zootecnia Tropical - Satipo',
    ];

    public const TYPES = [
        'ACCESO A LA INFORMACIÓN PÚBLICA',
        'SEMIBECAS Y BECAS – CEPRE',
        'CARNÉ UNIVERSITARIO',
        'SOLICITUD DE DESCUENTO POR PLANILLA – CEPRE',
        'INSCRIPCIÓN – CEPRE',
        'EXAMEN COMPLEMENTARIO',
        'CONSTANCIA DE ESTUDIOS – CEPRE',
        'DUPLICADO DE CONSTANCIA DE HABILITACIÓN – CEPRE',
        'EXAMEN EXTEMPORÁNEO / JUSTIFICACIÓN DE INASISTENCIA',
        'CAMBIO DE FACULTAD – CEPRE',
        'INSCRIPCIÓN EXAMEN PRIMERA SELECCIÓN',
        'INSCRIPCIÓN EXAMEN ORDINARIO',
        'CONSTANCIA DE PRÁCTICAS PREPROFESIONALES/INTERNADO',
        'INSCRIPCIÓN CONCURSO DOCTORADO (EXTERNO/INTERNO/ORDINARIO)',
        'CERTIFICADO DE ESTUDIOS DE PREGRADO (FORMATO 1 y 2)',
        'CONSTANCIA DE RÉCORD ACADÉMICO, MATRÍCULA Y OTROS',
        'ETC. (agregar las demás según lista completa)',
    ];

    protected $queryString = [
        'search'  => ['except' => ''],
        'year'    => ['except' => null],
        'month'   => ['except' => null],
        'faculty' => ['except' => null],
        'type'    => ['except' => null],
        'state'   => ['except' => null],
    ];

    public function updated($field)
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = null;
        $this->year = null;
        $this->month = null;
        $this->faculty = null;
        $this->type = null;
        $this->state = null;
    }

    public function getYearsProperty()
    {
        $driver = DB::connection()->getDriverName();
        $expression = $driver === 'sqlite'
            ? "strftime('%Y', fecha_expediente)"
            : 'YEAR(fecha_expediente)';

        return Expediente::query()
            ->selectRaw($expression.' as year')
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year');
    }

    public function getMonthsProperty(): array
    {
        return [
            1 => __('Enero'),
            2 => __('Febrero'),
            3 => __('Marzo'),
            4 => __('Abril'),
            5 => __('Mayo'),
            6 => __('Junio'),
            7 => __('Julio'),
            8 => __('Agosto'),
            9 => __('Septiembre'),
            10 => __('Octubre'),
            11 => __('Noviembre'),
            12 => __('Diciembre'),
        ];
    }

    public function getFacultiesProperty(): array
    {
        return self::FACULTIES;
    }

    public function getTypesProperty(): array
    {
        return self::TYPES;
    }

    public function getStatesProperty(): array
    {
        return [
            'finalizado' => __('Finalizado'),
            'pendiente' => __('Pendiente'),
        ];
    }

    public function render()
    {
        $query = Expediente::query()
            ->select(['id', 'id as codigo', 'nombre', 'fecha_expediente', 'facultad_id', 'tipo_tramite_id'])
            ->with(['tramite', 'facultad', 'documentos']);

        $query->when($this->search, function ($q) {
            $search = $this->search;
            $q->where('nombre', 'like', "%{$search}%");
        });
        $query->when($this->year, fn ($q) => $q->whereYear('fecha_expediente', $this->year));
        $query->when($this->month, fn ($q) => $q->whereMonth('fecha_expediente', $this->month));
        $query->when($this->faculty, fn ($q) =>
            $q->whereHas('facultad', fn ($sub) => $sub->where('nombre', $this->faculty))
        );
        $query->when($this->type, fn ($q) =>
            $q->whereHas('tramite', fn ($sub) => $sub->where('nombre', $this->type))
        );

        $query->when($this->state === 'finalizado', fn ($q) => $q->has('documentos'));
        $query->when($this->state === 'pendiente', fn ($q) => $q->doesntHave('documentos'));

        $expedientes = $query->orderByDesc('fecha_expediente')->get();

        return view('livewire.archivo-central', [
            'expedientes'   => $expedientes,
            'years'         => $this->years,
            'months'        => $this->months,
            'facultades'    => $this->faculties,
            'tiposTramite'  => $this->types,
            'states'        => $this->states,
        ]);
    }
}
