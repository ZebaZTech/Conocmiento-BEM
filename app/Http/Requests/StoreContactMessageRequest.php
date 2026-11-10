<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'message' => ['required', 'string'],
            'privacy' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'privacy.accepted' => 'Debes aceptar la política de tratamiento de datos personales.',
        ];
    }
}
