<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpedienteMetadataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'dependencia' => ['required', 'exists:dependencias,id'],
            'tipo_tramite' => ['required', 'exists:tramites,id'],
            'fecha_expediente' => ['required', 'date', 'before_or_equal:today'],
            'facultad' => ['required', 'exists:facultades,id'],
        ];
    }
}
