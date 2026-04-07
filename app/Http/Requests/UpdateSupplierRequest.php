<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supplier = $this->route('supplier');

        return [
            'name'           => ['sometimes', 'required', 'string', 'max:255', 'unique:suppliers,name,' . $supplier->id],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone'          => ['nullable', 'string', 'max:50'],
            'email'          => ['nullable', 'email', 'max:255', 'unique:suppliers,email,' . $supplier->id],
            'address'        => ['nullable', 'string'],
        ];
    }
}
