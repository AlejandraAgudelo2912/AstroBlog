<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|unique:categories,name|max:255',
            'description' => 'nullable',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
