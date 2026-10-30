<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFocusSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'task_id' => [
                'nullable',
                'integer',
                Rule::exists('tasks', 'id')->where('user_id', $this->user()?->id),
            ],
            'minutes' => ['required', 'integer', 'min:1', 'max:1440'],
            'completed' => ['required', 'boolean'],
        ];
    }
}
