<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTestimonialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $name = $this->input('name');
        $initials = $this->input('initials');
        if ((! $initials || trim($initials) === '') && is_string($name)) {
            $parts = preg_split('/\s+/', trim($name));
            $calc = mb_strtoupper(
                mb_substr($parts[0] ?? '', 0, 1).mb_substr($parts[1] ?? '', 0, 1)
            );
            if ($calc === '') {
                $calc = mb_strtoupper(mb_substr($name, 0, 2));
            }
            $this->merge(['initials' => $calc]);
        }
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
            'initials' => ['nullable', 'string', 'max:5'],
            'variant' => ['required', 'in:normal,highlight,compact'],
        ];
    }
}
