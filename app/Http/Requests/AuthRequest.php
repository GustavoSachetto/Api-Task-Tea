<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            'email'    => 'email|exists:users,email',
            'nickname' => 'string|max:120|exists:users,nickname',
            'password' => 'required|string'
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
            'email.exists'      => 'O email selecionado não é valido',
            'email.email'       => 'O campo email deve ser um email valido exemplo: myaccount@gmail.com',

            'nickname.string'   => 'O campo nickname deve ser do tipo caracter apenas',
            'nickname.max'      => 'O campo nickname deve ter no máximo 120 caracteres',
            'nickname.exists'   => 'O nickname selecionado não é valido',

            'password.required' => 'O campo password é obrigatório',
            'password.string'   => 'O campo password deve ser do tipo string',
        ];
    }
}
