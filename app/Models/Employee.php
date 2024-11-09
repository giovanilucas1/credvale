<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'usuario'; // Nome da tabela no banco de dados

    protected $fillable = [
        'nome_completo',
        'email_corporativo',
        'senha',
        'cpf',
        'setor',
        'cargo',
        'telefone',
        'data_admissao',
        'status_acesso',
        'permissao_acesso',
    ];

    protected $hidden = [
        'senha',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
