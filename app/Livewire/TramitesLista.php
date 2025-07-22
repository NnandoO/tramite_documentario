<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\TramiteType;

class TramitesLista extends Component
{
    public $types = [];

    public function mount()
    {
        $this->types = TramiteType::orderBy('id')->pluck('name')->toArray();
    }

    public function verDetalle($tramiteId)
    {
        $this->redirectRoute('form.tramite', ['tramite' => $tramiteId]);
    }

    public function render()
    {
        return view('livewire.tramites-lista');
    }
}