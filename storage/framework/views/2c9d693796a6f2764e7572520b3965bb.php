<!-- resources/views/dashboard/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cred Vale</title>
    <link rel="icon" type="image/png" href="<?php echo e(Vite::asset('resources/img/fvicon.png')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/menulateral.css', 'resources/css/home.css']); ?>
</head>
<body>
    <?php echo $__env->make('commons.nav.menulateral', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Inclui o menu lateral -->

    <div class="main-content" id="main-content">
        <div class="content-container">
            <h1 class="title">Sistema em Desenvolvimento</h1>
            <p class="description">Estamos trabalhando duro para trazer o melhor sistema para você!</p>
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('dashboard.calculadora', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> <!-- Inclui o modal da calculadora -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openCalculadora() {
            const calculadoraModal = new bootstrap.Modal(document.getElementById("calculadoraModal"));
            calculadoraModal.show();
        }
    </script>
</body>
</html>
<?php /**PATH /var/www/resources/views/dashboard/home.blade.php ENDPATH**/ ?>