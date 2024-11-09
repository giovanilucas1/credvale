<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showProfile()
    {
        // Verifica se o usuário está na sessão
        if (!session()->has('usuario')) {
            return redirect()->route('login.form')->withErrors(['session_expired' => 'Sessão expirada. Faça login novamente.']);
        }

        // Pega o ID do usuário da sessão
        $userId = session('usuario')->id;

        // Busca o usuário no banco de dados pelo ID
        $user = DB::table('usuario')->where('id', $userId)->first();

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return redirect()->back()->withErrors(['user_not_found' => 'Usuário não encontrado.']);
        }

        // Retorna a view do perfil com os dados do usuário
        return view('dashboard.perfil', compact('user'));
    }

    // Exemplo de método no UserController
    public function listarUsuarios()
    {
        $usuarios = DB::table('usuario')->get(); // Ajuste conforme seu modelo ou estrutura de banco
        return view('dashboard.gestaouser', compact('usuarios'));
    }

    public function updatePassword(Request $request)
{
    // Valida as senhas recebidas
    $request->validate([
        'new_password' => 'required|min:6',
        'confirm_password' => 'required|same:new_password',
    ]);

    // Pega o ID do usuário da sessão
    $userId = session('usuario')->id;

    // Atualiza a senha no banco de dados
    $hashedPassword = Hash::make($request->new_password);
    DB::table('usuario')
        ->where('id', $userId)
        ->update(['senha' => $hashedPassword]);

    return redirect()->route('perfil')->with('success', 'Senha atualizada com sucesso!');
}

public function listarBancos()
{
    $bancos = DB::table('bancos')->get(); // Verifique se a tabela 'bancos' existe e tem os campos corretos
    return view('dashboard.gestaobancos', compact('bancos'));
}


}

