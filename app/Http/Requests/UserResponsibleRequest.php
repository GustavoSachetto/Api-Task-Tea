<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserResponsibleRequest extends FormRequest
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
            'name'          => 'required|max:60',
            'email'         => 'required|email|unique:users,email',
            'password'      => 'required|min:6',
            'birthdate'     => 'date|required',
            'nickname'      => 'required|unique:users,nickname',
            'cpf'           => 'string|size:11|unique:advanced_access,cpf',
            'phone_number'  => 'required|string|size:11|unique:advanced_access,phone_number'
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
            'name.required'         => 'O campo nome é obrigatório.',
            'name.max'              => 'O nome não pode ter mais que 60 caracteres.',

            'email.required'        => 'O campo email é obrigatório.',
            'email.email'           => 'O campo email deve ser um email válido, exemplo: myaccount@gmail.com.',
            'email.unique'          => 'O email fornecido já está em uso.',

            'password.required'     => 'O campo senha é obrigatório.',
            'password.min'          => 'A senha deve ter no mínimo 6 caracteres.',

            'birthdate.date'        => 'O campo data de nascimento deve ser no formato Y-m-d.',
            'birthdate.required'    => 'O campo data de nascimento é obrigatório.',

            'nickname.required'     => 'O campo apelido é obrigatório.',
            'nickname.unique'       => 'O apelido fornecido já está em uso.',

            'cpf.string'            => 'O campo CPF deve ser uma string.',
            'cpf.size'              => 'O CPF deve ter exatamente 11 caracteres.',
            'cpf.unique'            => 'O CPF fornecido já está em uso.',

            'phone_number.required' => 'O campo telefone é obrigatório.',
            'phone_number.string'   => 'O campo telefone deve ser uma string.',
            'phone_number.size'     => 'O telefone deve ter exatamente 11 dígitos.',
        ];
    }
}
