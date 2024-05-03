<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewPasswordRequest extends FormRequest
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
            'password' => 'required',
            'password' => 'required|min:8',
            'repeatPassword' => 'required',
            'repeatPassword' => 'required|min:8',
            //'email' => 'required|email|unique:users,email',
            
        ];
    }

    public function messages(): array
    {
        return[
            'password.required' => 'Campo Digite a nova senha é obrigatório!',
            'repeatPassword.required' => 'Campo Repita a nova senha é obrigatório!',       
            'password.min' => 'Senha com no mínimo :min caracteres!',
            'repeatPassword.min' => 'Senha com no mínimo :min caracteres!',
        ];
    }
}
