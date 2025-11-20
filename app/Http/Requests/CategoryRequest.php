<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required|string|unique:categories|min:3|max:40'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'O campo name é obrigatório',
            'name.string'   => 'O campo name deve ser do tipo string',
            'name.unique'   => 'O campo name já existe na tabela categories',
            'name.max'      => 'O campo name deve ter no máximo 40 caracteres',
            'name.min'      => 'O campo name deve ter no mínimo 3 caracteres',
        ];
    }
}
