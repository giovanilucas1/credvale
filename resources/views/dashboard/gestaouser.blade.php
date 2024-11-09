<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register_user'])) {
        // Registrar novo usuário
        $nomeCompleto = $_POST['nome_completo'];
        $cpf = $_POST['cpf']; // Adicionado o CPF
        $emailCorporativo = $_POST['email_corporativo'];
        $senha = Hash::make($_POST['senha']);
        $setor = $_POST['setor'];
        $cargo = $_POST['cargo'];
        $permissaoAcesso = $_POST['permissao_acesso'];

        $insert = DB::insert('INSERT INTO usuario (nome_completo, cpf, email_corporativo, senha, setor, cargo, permissao_acesso, status_acesso) VALUES (?, ?, ?, ?, ?, ?, ?, ?)', [$nomeCompleto, $cpf, $emailCorporativo, $senha, $setor, $cargo, $permissaoAcesso, 'Ativo']);

        if ($insert) {
            echo "<div class='alert alert-success'>Usuário registrado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao registrar o usuário.</div>";
        }
    }

    if (isset($_POST['reset_password'])) {
        // Resetar senha
        $userId = $_POST['user_id'];
        $newPassword = $_POST['new_password'];

        if ($newPassword === $_POST['confirm_password']) {
            $hashedPassword = Hash::make($newPassword);
            $update = DB::update('UPDATE usuario SET senha = ? WHERE id = ?', [$hashedPassword, $userId]);

            if ($update) {
                echo "<div class='alert alert-success'>Senha alterada com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao alterar a senha.</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>As senhas não coincidem.</div>";
        }
    }

    if (isset($_POST['delete_user'])) {
        // Excluir usuário
        $userId = $_POST['user_id'];
        $delete = DB::delete('DELETE FROM usuario WHERE id = ?', [$userId]);

        if ($delete) {
            echo "<div class='alert alert-success'>Usuário excluído com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao excluir o usuário.</div>";
        }
    }

    if (isset($_POST['block_user'])) {
        // Bloquear usuário
        $userId = $_POST['user_id'];
        $block = DB::update('UPDATE usuario SET status_acesso = ? WHERE id = ?', ['Inativo', $userId]);

        if ($block) {
            echo "<div class='alert alert-success'>Usuário bloqueado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao bloquear o usuário.</div>";
        }
    }
}

$usuarios = DB::select('SELECT * FROM usuario');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/menulateral.css', 'resources/css/gestaouser.css'])
</head>
<body>
    @include('commons.nav.menulateral')

    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestão de Usuários</h1>

        <!-- Botão de Novo Usuário -->
        <div class="mb-3 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#newUserModal">Novo Usuário</button>
        </div>

        <!-- Tabela de usuários -->
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome Completo</th>
                        <th>CPF</th>
                        <th>Email Corporativo</th>
                        <th>Setor</th>
                        <th>Cargo</th>
                        <th>Permissão de Acesso</th>
                        <th>Status de Acesso</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario->id ?></td>
                            <td><?= $usuario->nome_completo ?></td>
                            <td><?= $usuario->cpf ?></td> <!-- Exibição do CPF -->
                            <td><?= $usuario->email_corporativo ?></td>
                            <td><?= $usuario->setor ?></td>
                            <td><?= $usuario->cargo ?></td>
                            <td><?= $usuario->permissao_acesso ?></td>
                            <td><?= $usuario->status_acesso ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteUserModal<?= $usuario->id ?>">Excluir</button>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#resetPasswordModal<?= $usuario->id ?>">Resetar Senha</button>
                                <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#blockUserModal<?= $usuario->id ?>">Bloquear</button>
                            </td>
                        </tr>

                        <!-- Modal para Resetar Senha -->
                        <div class="modal fade" id="resetPasswordModal<?= $usuario->id ?>" tabindex="-1" aria-labelledby="resetPasswordModalLabel<?= $usuario->id ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="resetPasswordModalLabel<?= $usuario->id ?>">Resetar Senha</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="">
                                            @csrf
                                            <input type="hidden" name="user_id" value="<?= $usuario->id ?>">
                                            <div class="mb-3">
                                                <label for="new_password" class="form-label">Nova Senha</label>
                                                <input type="password" name="new_password" class="form-control" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="confirm_password" class="form-label">Confirmar Senha</label>
                                                <input type="password" name="confirm_password" class="form-control" required>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" name="reset_password" class="btn btn-primary">Confirmar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para Excluir Usuário -->
                        <div class="modal fade" id="deleteUserModal<?= $usuario->id ?>" tabindex="-1" aria-labelledby="deleteUserModalLabel<?= $usuario->id ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteUserModalLabel<?= $usuario->id ?>">Excluir Usuário</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem certeza que deseja excluir o usuário <?= $usuario->nome_completo ?>?</p>
                                        <form method="POST" action="">
                                            @csrf
                                            <input type="hidden" name="user_id" value="<?= $usuario->id ?>">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" name="delete_user" class="btn btn-danger">Excluir</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para Bloquear Usuário -->
                        <div class="modal fade" id="blockUserModal<?= $usuario->id ?>" tabindex="-1" aria-labelledby="blockUserModalLabel<?= $usuario->id ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="blockUserModalLabel<?= $usuario->id ?>">Bloquear Usuário</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Tem certeza que deseja bloquear o usuário <?= $usuario->nome_completo ?>?</p>
                                        <form method="POST" action="">
                                            @csrf
                                            <input type="hidden" name="user_id" value="<?= $usuario->id ?>">
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" name="block_user" class="btn btn-secondary">Bloquear</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal para Registrar Novo Usuário -->
        <div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserModalLabel">Registrar Novo Usuário</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="">
                            @csrf
                            <!-- Campos para registro do novo usuário -->
                            <div class="mb-3">
                                <label for="nome_completo" class="form-label">Nome Completo</label>
                                <input type="text" name="nome_completo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" name="cpf" class="form-control" maxlength="11" required>
                            </div>
                            <div class="mb-3">
                                <label for="email_corporativo" class="form-label">Email Corporativo</label>
                                <input type="email" name="email_corporativo" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" name="senha" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="setor" class="form-label">Setor</label>
                                <input type="text" name="setor" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="cargo" class="form-label">Cargo</label>
                                <select name="cargo" class="form-select" required>
                                    <option value="Vendas">Vendas</option>
                                    <option value="Vendedor">Vendedor</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Operacional">Operacional</option>
                                    <option value="Digitação">Digitação</option>
                                    <option value="Triagem">Triagem</option>
                                    <option value="Diretoria e Gerência">Diretoria e Gerência</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="permissao_acesso" class="form-label">Permissão de Acesso</label>
                                <select name="permissao_acesso" class="form-select" required>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" name="register_user" class="btn btn-success">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
