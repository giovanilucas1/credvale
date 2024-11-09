<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" type="image/png" href="<?php echo e(Vite::asset('resources/img/fvicon.png')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/login.css'); ?>
</head>
<body>
    <div class="login-container">
        <!-- Exibe a logo no lugar do título "Login" -->
        <img src="<?php echo e(Vite::asset('resources/img/logo.png')); ?>" alt="Logo" class="login-logo">

        <!-- Exibe a mensagem de erro de login, se houver -->
        <?php if($errors->has('login')): ?>
            <div class="error-message">
                <?php echo e($errors->first('login')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('login')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="email" name="email" placeholder="E-mail Corporativo" class="input-field" required>
            <input type="password" name="password" placeholder="Senha" class="input-field" required>
            <button type="submit" class="button">Entrar</button>
        </form>
    </div>
</body>
</html>
<?php /**PATH /var/www/resources/views/login.blade.php ENDPATH**/ ?>