<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    //
    public function register(RegisterRequest $request)
    {
        //validar los datos
        $data = $request->validated();

        //crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        //retornar una respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function login(LoginRequest $request)
    {
        //validar entrada de datos
        $data = $request->validated();

        //si las credenciales no son correctas
        if(!Auth::attempt($data)) {
            return response([
                'errors' => ['Las credenciales proporcionadas no son correctas']
            ], 422); //default status 200
        }

        $user = Auth::user();

        // $token = $user->createToken('token')->plainTextToken;
        // $token->token->expires_at = now()->addMinutes(1);
        // $token->token->save();

        //retornar una respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout(Request $request)
    {
        // obtener el usuario autenticado
        $user = $request->user();
        // $user->currentAccessToken()->delete(); //elimina el toke activo
        $user->tokens()->delete(); //elimina todos los tokens asociados al usuario

        return [
            'user' => null
        ];

    }
}
