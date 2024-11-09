<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/css/perfil.css') <!-- Carrega o CSS específico do perfil -->
</head>
<body>
    @include('commons.nav.menulateral') <!-- Inclui o menu lateral -->

    <div class="container mt-4">
        <h2 class="text-center mb-3">Perfil do Usuário</h2>
        <div class="card shadow-sm p-3 profile-card">
            @if(isset($user))
                <table class="table table-borderless mb-4">
                    <tbody>
                        <tr>
                            <th>Nome Completo:</th>
                            <td>{{ $user->nome_completo }}</td>
                        </tr>
                        <tr>
                            <th>CPF:</th>
                            <td>{{ $user->cpf }}</td>
                        </tr>
                        <tr>
                            <th>Setor:</th>
                            <td>{{ $user->setor }}</td>
                        </tr>
                        <tr>
                            <th>Cargo:</th>
                            <td>{{ $user->cargo }}</td>
                        </tr>
                        <tr>
                            <th>E-mail Corporativo:</th>
                            <td>{{ $user->email_corporativo }}</td>
                        </tr>
                        <tr>
                            <th>Telefone:</th>
                            <td>{{ $user->telefone }}</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Formulário de troca de senha -->
                <form method="POST" action="{{ route('perfil.update-password') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="mb-2">
                        <label for="new_password" class="form-label">Nova Senha</label>
                        <input type="password" name="new_password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="confirm_password" class="form-label">Confirmar Senha</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary btn-sm">Trocar Senha</button>
                    </div>
                </form>
            @else
                <p class="text-danger">Erro: Usuário não encontrado.</p>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
