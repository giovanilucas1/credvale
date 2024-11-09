<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Busca o usuário no banco de dados pelo email corporativo
        $usuario = DB::table('usuario')
            ->where('email_corporativo', $request->email)
            ->first();

        // Verifica se o usuário existe e a senha está correta
        if ($usuario && Hash::check($request->password, $usuario->senha)) {
            // Armazene o usuário na sessão para a autenticação
            session(['usuario' => $usuario]);

            // Redireciona para o dashboard com o ID do usuário
            return redirect()->route('home', ['id' => $usuario->id]);
        }

        // Autenticação falhou
        return back()->withErrors([
            'login' => 'Credenciais inválidas.',
        ])->withInput();
    }
}
