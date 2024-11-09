<!-- resources/views/dashboard/home.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cred Vale</title>
    <link rel="icon" type="image/png" href="{{ Vite::asset('resources/img/fvicon.png') }}">
    @vite(['resources/css/menulateral.css', 'resources/css/home.css'])
</head>
<body>
    @include('commons.nav.menulateral') <!-- Inclui o menu lateral -->

    <div class="main-content" id="main-content">
        <div class="content-container">
            <h1 class="title">Sistema em Desenvolvimento</h1>
            <p class="description">Estamos trabalhando duro para trazer o melhor sistema para você!</p>
            <div class="progress-bar">
                <div class="progress"></div>
            </div>
        </div>
    </div>

    @include('dashboard.calculadora') <!-- Inclui o modal da calculadora -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openCalculadora() {
            const calculadoraModal = new bootstrap.Modal(document.getElementById("calculadoraModal"));
            calculadoraModal.show();
        }
    </script>
</body>
</html>
