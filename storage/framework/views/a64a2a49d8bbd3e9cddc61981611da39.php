<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/perfil.css'); ?> <!-- Carrega o CSS específico do perfil -->
</head>
<body>
    <?php echo $__env->make('commons.nav.menulateral', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Inclui o menu lateral -->

    <div class="container mt-4">
        <h2 class="text-center mb-3">Perfil do Usuário</h2>
        <div class="card shadow-sm p-3 profile-card">
            <?php if(isset($user)): ?>
                <table class="table table-borderless mb-4">
                    <tbody>
                        <tr>
                            <th>Nome Completo:</th>
                            <td><?php echo e($user->nome_completo); ?></td>
                        </tr>
                        <tr>
                            <th>CPF:</th>
                            <td><?php echo e($user->cpf); ?></td>
                        </tr>
                        <tr>
                            <th>Setor:</th>
                            <td><?php echo e($user->setor); ?></td>
                        </tr>
                        <tr>
                            <th>Cargo:</th>
                            <td><?php echo e($user->cargo); ?></td>
                        </tr>
                        <tr>
                            <th>E-mail Corporativo:</th>
                            <td><?php echo e($user->email_corporativo); ?></td>
                        </tr>
                        <tr>
                            <th>Telefone:</th>
                            <td><?php echo e($user->telefone); ?></td>
                        </tr>
                    </tbody>
                </table>

                <!-- Formulário de troca de senha -->
                <form method="POST" action="<?php echo e(route('perfil.update-password')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>">
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
            <?php else: ?>
                <p class="text-danger">Erro: Usuário não encontrado.</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH /var/www/resources/views/dashboard/perfil.blade.php ENDPATH**/ ?>