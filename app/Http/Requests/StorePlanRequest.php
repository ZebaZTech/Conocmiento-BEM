<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $features = $this->input('features_text');
        if (is_string($features)) {
            $features = array_filter(array_map('trim', preg_split('/\R/', $features)));
        }
        if (!is_array($features)) {
            $features = [];
        }

        $excluded = $this->input('excluded_features_text');
        if (is_string($excluded)) {
            $excluded = array_filter(array_map('trim', preg_split('/\R/', $excluded)));
        }
        if (!is_array($excluded)) {
            $excluded = null;
        }

        $this->merge([
            'features' => array_values($features),
            'excluded_features' => $excluded && count($excluded) > 0 ? array_values($excluded) : null,
            'featured' => $this->boolean('featured'),
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'description' => ['nullable', 'string'],
            'period' => ['required', 'string', 'max:50'],
            'features' => ['required', 'array'],
            'features.*' => ['required', 'string'],
            'excluded_features' => ['nullable', 'array'],
            'excluded_features.*' => ['nullable', 'string'],
            'featured' => ['nullable', 'boolean'],
        ];
    }
}
