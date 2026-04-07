<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

// app/Http/Requests/UpdateGenericRequest.php
class UpdateGenericRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // ignore the current record's own name when checking uniqueness
        $genericId = $this->route('generic')->id;

        return [
            'name'        => ['sometimes', 'string', 'max:255', "unique:generics,name,{$genericId}"],
            'description' => ['nullable', 'string'],
        ];
    }
}
