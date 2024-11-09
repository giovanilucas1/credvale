<!-- resources/views/commons/nav/menulateral.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Lateral</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    @vite('resources/css/menulateral.css')
</head>
<body>
    <div class="sidebar d-flex flex-column justify-content-between" id="sidebar">
        <div>
            <div class="sidebar-header">
                <img src="{{ Vite::asset('resources/img/coracaob.png') }}" alt="Logo" class="sidebar-logo">
                <button class="toggle-btn" onclick="toggleMenu()">&#9776;</button>
            </div>
            <nav class="nav flex-column mt-3">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home icon"></i><span>Home</span></a>
                <a href="javascript:void(0);" class="nav-link" onclick="openCalculadora()"><i class="fas fa-calculator icon"></i><span>Calculadora</span></a>
                <a href="{{ route('perfil') }}" class="nav-link"><i class="fas fa-user icon"></i><span>Ver Perfil</span></a>

                @php
                    $usuario = session('usuario');
                @endphp

                <!-- Verifica se o usuário logado é um administrador -->
                @if($usuario && $usuario->permissao_acesso === 'Administrador')
                    <a href="{{ route('gestao.usuarios') }}" class="btn btn-danger mt-2">Gestão de Usuários</a>
                    <a href="{{ route('gestao.bancos') }}" class="btn btn-info mt-2">Gestão de Bancos</a>
                @endif

                <a href="/ajuda" class="nav-link"><i class="fas fa-question-circle icon"></i><span>Ajuda</span></a>
            </nav>
        </div>
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="btn btn-link text-white p-0" style="text-decoration: none;">
                <i class="fas fa-sign-out-alt icon"></i> <span>Sair</span>
            </button>
        </form>
    </div>
    <script>
        function toggleMenu() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('collapsed');
        }

        function openCalculadora() {
            alert("Abrindo calculadora...");
        }
    </script>
</body>
</html>
