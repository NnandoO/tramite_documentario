<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificacionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'expediente_entregado_id' => [
                'required',
                'exists:expediente_entregado,id',
            ],
            'solicitud_id' => [
                'required',
                'exists:solicitud_expedientes,id',
                function ($attr, $value, $fail) {
                    $entregaId = $this->input('expediente_entregado_id');
                    $entrega = \App\Models\ExpedienteEntregado::find($entregaId);
                    if ($entrega && $entrega->solicitud_id != $value) {
                        $fail(__('El expediente no pertenece a la solicitud.'));
                    }
                },
            ],
        ];
    }
}

