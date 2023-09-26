<?php

namespace App\Http\Requests;

use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CategoryListRequest extends FormRequest
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
            'name' => 'string|regex:/^[a-zA-Z0-9_-]+$/',
            'description' => 'string|regex:/^[a-zA-Z0-9_-]+$/',
            'active' => '',
            'sort' => 'string|regex:/^[a-zA-Z0-9_-]+$/',
            'per_page' => 'integer'
        ];
    }
}
