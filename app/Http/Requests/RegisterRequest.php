<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->letters()->numbers()->symbols()->mixedCase()
            ],
        ];
    }

    public function messages()
    {
        return [
            'name' => 'El campo nombre es requerido',
            'email.required' => 'El campo email es requerido',
            'email.email' => 'El email no tiene un formato valido',
            'email.unique' => 'El usuario ya esta registrado',
            'password.required' => 'El campo password es requerido',
            // 'password.min' => 'El password debe contener al menos 8 caracteres... ',
            // 'password.letters' => 'El password debe contener al menos una letra... ',
            // 'password.numbers' => 'El password debe contener al menos un número... ',
            // 'password.symbols' => 'El password debe contener al menos un símbolo... ',
            // 'password.mixed' => 'El password debe contener al menos una letra mayúscula... ',
            'password.min' => 'El password debe contener al menos 8 caracteres, entre ellos: al menos un número, un símbolo, una letra mayúscula y minúscula',
            'password.letters' => 'El password debe contener al menos 8 caracteres, entre ellos: al menos un número, un símbolo, una letra mayúscula y minúscula',
            'password.numbers' => 'El password debe contener al menos 8 caracteres, entre ellos: al menos un número, un símbolo, una letra mayúscula y minúscula',
            'password.symbols' => 'El password debe contener al menos 8 caracteres, entre ellos: al menos un número, un símbolo, una letra mayúscula y minúscula',
            'password.mixed' => 'El password debe contener al menos 8 caracteres, entre ellos: al menos un número, un símbolo, una letra mayúscula y minúscula',
            'password.confirmed' => "Los passwords no coinciden... "
        ];
    }
}
