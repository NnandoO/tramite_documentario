<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\Status;

class RegistroEnvioAutomatico extends Component
{
    public $paginaActual = 1;
    public $porPagina = 4;
    public $totalPaginas = 1;

    public function mount()
    {
        $this->actualizarTotalPaginas();
    }

    public function anterior()
    {
        if ($this->paginaActual > 1) {
            $this->paginaActual--;
        }
    }

    public function siguiente()
    {
        if ($this->paginaActual < $this->totalPaginas) {
            $this->paginaActual++;
        }
    }

    private function actualizarTotalPaginas()
    {
        $enviado = Status::where('name', 'Enviado')->value('id');
        $totalExpedientes = DB::table('expedientes')->where('status_id', $enviado)->count();
        $this->totalPaginas = (int) ceil($totalExpedientes / $this->porPagina);
    }

    public function render()
    {
        $this->actualizarTotalPaginas();

        $enviado = Status::where('name', 'Enviado')->value('id');
        $expedientes = DB::table('expedientes')
            ->where('status_id', $enviado)
            ->orderByDesc('fecha_envio')
            ->offset(($this->paginaActual - 1) * $this->porPagina)
            ->limit($this->porPagina)
            ->get();

        return view('livewire.registro-envio-automatico', [
            'expedientes' => $expedientes
        ]);
    }
}
