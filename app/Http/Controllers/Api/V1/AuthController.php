<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\Usuario;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreUsuarioRequest;
use App\Http\Requests\V1\LoginUsuarioRequest;
use App\Http\Resources\V1\UsuarioResource;

class AuthController extends Controller
{
    public function register(StoreUsuarioRequest $request)
    {
        $usuario = new UsuarioResource(Usuario::create([
            'nome' => $request->input("nome"),
            'email' => $request->input("email"),
            'senha' => Hash::make($request->input("senha")),
            'telefone' => $request->input("telefone"),
        ]));

        $token = $usuario->createToken('app-token')->plainTextToken;

        return response()->json([
            'message' => 'Usuário registrado com sucesso!',
            'usuario' => $usuario,
            'token' => $token
        ], 201);
    }

    public function login(LoginUsuarioRequest $request)
    {
        $usuario = new UsuarioResource(Usuario::where('email', $request->input('email'))->first());
        
        if ($usuario && Hash::check($request->input("senha"), $usuario->senha)) {
            $token = $usuario->createToken('app-token')->plainTextToken;

            return response()->json([
                'usuario' => $usuario,
                'token' => $token
            ]);
        }

        return response()->json(['message' => 'Credenciais inválidas'], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}
