<?php

namespace App\Livewire;

use Livewire\Component;

class HistorialTramites extends Component
{
    public $tramites;

    public function mount()
    {
        $this->tramites = [
            [
                'expediente' => '2024-001-IS',
                'tipo_tramite' => 'CONSTANCIA DE EXPEDITO PARA OPTAR TÍTULO PROFESIONAL',
                'fecha_envio' => '22/07/2025',
                'funcionario' => 'Dr. Maria González',
                'identificador' => '22/07/2025'
            ]
        ];
    }

    public function render()
    {
        return view('livewire.historial-tramites');
    }
}
