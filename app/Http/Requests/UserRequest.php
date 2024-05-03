<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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

        $user = $this->route('user');

        return [
            'name' => 'required',
            'lastname'  => 'required',
            'municipio_id'  => 'required',
            'email' => 'required|email|unique:users,email,' . ($user ? $user->id : null),
            'status' => ['required', 'not_in:Selecione uma opção'],
            'password' => 'required_if:password,!=,null|min:6',
            'roles' => 'required',
            'created_by',
            'updated_by',
        ];
    }

    public function messages(): array
    {
        return[
            'name.required' => 'Campo Nome é obrigatório!',
            'lastname.required' => 'Campo Sobrenome é obrigatório!',
            'municipio_id.required' => 'Campo Município é obrigatório!',
            'email.required' => 'Campo E-mail é obrigatório!',
            'email.email' => 'Necessário enviar E-mail válido!',
            'email.unique' => 'O E-mail já está cadastrado!',
            'status.not_in' => 'Campo Status é obrigatório!',
            'password.required_if' => 'Campo Senha é obrigatório!',
            'password.min' => 'Senha com no mínimo :min caracteres!',
            'roles.required' => 'Campo Papel é obrigatório!',
        ];
    }
}
