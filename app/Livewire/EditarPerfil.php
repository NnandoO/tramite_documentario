<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditarPerfil extends Component
{
    public $email;
    public $cargo;
    public $dependencia;
    public $showSuccess = false;

    public function mount()
    {
        $user = Auth::user();
        $this->email = $user->email;
        $this->cargo = $user->cargo;
        $this->dependencia = $user->dependencia;
    }

    public function actualizar()
    {
        $validated = $this->validate([
            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email,' . Auth::id(),
                'regex:/@(gmail\.com|hotmail\.com|uncp\.edu\.pe)$/',
            ],
            'cargo' => 'required|string|max:255',
            'dependencia' => 'required|string|max:255',
        ], [
            'email.regex' => 'El gmail ingresado es invalido.',
            'cargo.required' => 'Elija una opción.',
            'dependencia.required' => 'Elija una opción.',
        ]);

        $user = Auth::user();
        $correoAnterior = $user->email; // Guardar correo anterior antes de actualizarlo

        DB::transaction(function () use ($user, $validated, $correoAnterior) {
            // Actualizar tabla users
            $user->email = $validated['email'];
            $user->cargo = $validated['cargo'];
            $user->dependencia = $validated['dependencia'];
            $user->save();

            // Actualizar columna funcionario_destinatario en tabla tramites
            DB::table('tramites')
                ->where('funcionario_destinatario', $correoAnterior)
                ->update(['funcionario_destinatario' => $validated['email']]);
        });

        $this->showSuccess = true;
    }

    public function render()
    {
        return view('livewire.editar-perfil');
    }
}