<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpedienteEntregadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'files' => ['required', 'array'],
            'files.*' => 'required|file|mimes:pdf,docx|max:10240',
        ];
    }
}
