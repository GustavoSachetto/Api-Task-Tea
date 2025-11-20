<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title'           => 'required|string|max:255',
            'description'     => 'required|string',
            'tip'             => 'required|string',
            'level'           => 'required|in:easy,medium,hard',
            'categories_id'   => 'required|exists:categories,id'
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
            'title.required'           => 'O campo título é obrigatório',

            'description.required'     => 'O campo descrição é obrigatório',

            'tip.required'             => 'O campo dica é obrigatório',

            'level.required'           => 'O campo nível é obrigatório',
            'level.in'                 => 'O campo nível deve ser easy, medium, ou hard',
            
            'categories_id.required'   => 'O campo categoria é obrigatório',
            'categories_id.exists'     => 'Categoria inválida'
        ];
    }
}