<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'integer', Rule::exists('categories', 'id')],
            'notes' => ['nullable', 'string'],
            'status' => ['required', Rule::in(['pendiente', 'en_progreso', 'hecha'])],
            'estimated_cycles' => ['required', 'integer', 'between:1,20'],
        ];
    }
}
