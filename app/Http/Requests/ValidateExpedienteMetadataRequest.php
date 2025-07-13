<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateExpedienteMetadataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tipo_tramite' => ['required', 'exists:tramites,id'],
            'fecha_expediente' => ['required', 'date', 'before_or_equal:today'],
            'facultad' => ['required', 'exists:facultades,id'],
        ];
    }
}
