<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'user_receiver_id' => 'required|exists:user_relationships,user_related_id',
            'tasks_id'         => 'required|exists:tasks,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'user_receiver_id.required' => 'O usuário receptor é obrigatório.',
            'user_receiver_id.exists'   => 'O usuário receptor não foi encontrado.',
            
            'tasks_id.required'         => 'A tarefa é obrigatória.',
            'tasks_id.exists'           => 'A tarefa não foi encontrada.'
        ];
    }
}