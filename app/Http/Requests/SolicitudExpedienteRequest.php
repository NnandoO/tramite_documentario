<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Expediente;

class SolicitudExpedienteRequest extends FormRequest
{
    public bool $isRestricted = false;

    protected function prepareForValidation(): void
    {
        $codigo = $this->input('codigo_expediente');
        $this->isRestricted = (bool) Expediente::where('codigo', $codigo)
            ->value('restringido');
    }
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_solicitante' => 'required|string|max:255',
            'codigo_expediente'  => 'required|string|exists:expedientes,codigo',
            'tipo_tramite'       => 'required|exists:tramites,id',
            'facultad'           => 'required|exists:facultades,id',
            'fecha'              => 'required|date|before_or_equal:today',
            'motivo'             => $this->isRestricted
                ? 'required|string|max:500'
                : 'nullable|string|max:500',
            'observaciones'      => 'nullable|string|max:1000',
        ];
    }
}
