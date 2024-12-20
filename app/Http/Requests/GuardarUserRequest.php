<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarUserRequest extends FormRequest
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
            'name' => 'sometimes|string|max:100',
            'last_name' => 'sometimes|string|max:100',
            'email' => 'sometimes|email|unique:users,email|max:100',
            'phone' => 'sometimes|string|max:100',
            'password' => 'sometimes|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio',
            'name.string' => 'El campo nombre debe ser un texto',
            'name.max' => 'El campo nombre no puede tener más de 100 caracteres',
            'last_name.required' => 'El campo apellido es obligatorio',
            'last_name.string' => 'El campo apellido debe ser un texto',
            'last_name.max' => 'El campo apellido no puede tener más de 100 caracteres',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser un email válido',
            'email.unique' => 'El campo email ya está en uso',
            'email.max' => 'El campo email no puede tener más de 100 caracteres',
            'phone.required' => 'El campo teléfono es obligatorio',
            'phone.string' => 'El campo teléfono debe ser un texto',
            'phone.max' => 'El campo teléfono no puede tener más de 100 caracteres',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.string' => 'El campo contraseña debe ser un texto',
            'password.max' => 'El campo contraseña no puede tener más de 100 caracteres',
        ];
    }
}
