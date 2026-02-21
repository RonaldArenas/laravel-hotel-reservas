<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'document_type_id' => 'required|in:1,2,3',
            'document_number'  => 'required|min:6|max:20|unique:users,document_number',
            'name'             => 'required|string|max:50',
            'lastname'         => 'required|string|max:50',
            'phone'            => 'required|min:7|max:20',
            'email'            => 'required|email|unique:users,email',
            'password'         => 'required|min:6|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'document_type_id.required' => 'Seleccione el tipo de documento',
            'document_number.required'  => 'Ingrese el número de documento',
            'document_number.unique'    => 'Este documento ya está registrado',
            'email.unique'              => 'Este email ya está registrado',
            'password.confirmed'        => 'Las contraseñas no coinciden',
        ];
    }
}