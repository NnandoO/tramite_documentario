<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Status;

class CanalizarEnvio extends Component
{
    public $expedientes = [];
    public $expedienteSeleccionado = null;

    public $endpoint;
    public $usuario;
    public $token;
    public $cabeceras = '';

    public $mensajeExito = null;
    public $mensajeError = null;

    public function mount()
    {
        $this->cargarExpedientes();
    }

    public function cargarExpedientes()
    {
        $enviado = Status::where('name', 'Enviado')->value('id');
        $this->expedientes = DB::table('expedientes')
            ->where('status_id', $enviado)
            ->where('medio_envio', 'Otro medio')
            ->orderByDesc('fecha_envio')
            ->get();
    }

    public function seleccionarExpediente($id)
    {
        $this->expedienteSeleccionado = DB::table('expedientes')->find($id);
        $this->mensajeExito = null;
        $this->mensajeError = null;
    }

    public function enviarCanalizacion()
    {
        $this->validate([
            'endpoint' => 'required|url',
            'usuario' => 'required|string',
            'token' => 'required|string',
        ]);

        if (!$this->expedienteSeleccionado) {
            $this->mensajeError = 'Debe seleccionar un expediente.';
            return;
        }

        try {
            $payload = [
                'codigo' => $this->expedienteSeleccionado->codigo,
                'solicitante' => $this->expedienteSeleccionado->solicitante,
                'sumilla' => $this->expedienteSeleccionado->sumilla,
                'fecha_ingreso' => $this->expedienteSeleccionado->fecha_ingreso,
                'observaciones' => $this->expedienteSeleccionado->observaciones,
            ];

            $headers = [
                'Authorization' => 'Bearer ' . $this->token,
                'Usuario' => $this->usuario,
            ];

            if (!empty($this->cabeceras)) {
                $adicionales = json_decode($this->cabeceras, true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($adicionales)) {
                    $headers = array_merge($headers, $adicionales);
                }
            }

            $response = Http::withHeaders($headers)->post($this->endpoint, $payload);

            if ($response->successful()) {
                $canalizado = Status::where('name', 'Canalizado')->value('id');
                DB::table('expedientes')
                    ->where('id', $this->expedienteSeleccionado->id)
                    ->update(['status_id' => $canalizado]);

                return redirect()->route('canalizarEnvio')
                    ->with('success', 'Envío realizado correctamente al servicio externo.');
            } else {
                $this->mensajeError = 'Error en el servicio: ' . $response->body();
                $this->mensajeExito = null;
            }
        } catch (\Exception $e) {
            Log::error('Error de canalización: ' . $e->getMessage());
            $this->mensajeError = 'No se pudo conectar con el servicio externo.';
            $this->mensajeExito = null;
        }
    }

    public function cancelar()
    {
        return redirect()->route('canalizarEnvio');
    }

    public function render()
    {
        return view('livewire.canalizar-envio');
    }
}
