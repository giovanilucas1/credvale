<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/login.css'); ?>
</head>
<body>
    <div class="login-container">
        <h1 class="login-header">Login</h1>
        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="email" name="email" placeholder="E-mail Corporativo" class="input-field" required>
            <input type="password" name="password" placeholder="Senha" class="input-field" required>
            <button type="submit" class="button">Entrar</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH C:\Users\Giovani\credvale\resources\views/login.blade.php ENDPATH**/ ?>