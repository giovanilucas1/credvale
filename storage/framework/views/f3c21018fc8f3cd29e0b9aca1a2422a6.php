<?php

use Illuminate\Support\Facades\DB;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_banco'])) {
        // Lógica para adicionar um novo banco
        $banco = $_POST['banco'];
        $produto = $_POST['produto'];
        $oQuePode = $_POST['o_que_pode'];
        $oQueNaoPode = $_POST['o_que_nao_pode'];
        $acao = $_POST['acao'];
        $calc = $_POST['calc'];
        $ordem = DB::table('bancos')->max('ordem') + 1; // Incrementa a ordem automaticamente

        DB::insert('INSERT INTO bancos (ordem, banco, produto, o_que_pode, o_que_nao_pode, acao, calc) VALUES (?, ?, ?, ?, ?, ?, ?)', [$ordem, $banco, $produto, $oQuePode, $oQueNaoPode, $acao, $calc]);

        echo "<div class='alert alert-success'>Banco adicionado com sucesso!</div>";
    }

    if (isset($_POST['move_up']) || isset($_POST['move_down'])) {
        $id = $_POST['banco_id'];
        $direction = isset($_POST['move_up']) ? 'up' : 'down';

        // Lógica para mover o banco para cima ou para baixo na ordem
        $currentBanco = DB::table('bancos')->where('id', $id)->first();
        if ($direction === 'up') {
            $swapBanco = DB::table('bancos')->where('ordem', '<', $currentBanco->ordem)->orderBy('ordem', 'desc')->first();
        } else {
            $swapBanco = DB::table('bancos')->where('ordem', '>', $currentBanco->ordem)->orderBy('ordem', 'asc')->first();
        }

        if ($swapBanco) {
            DB::table('bancos')->where('id', $id)->update(['ordem' => $swapBanco->ordem]);
            DB::table('bancos')->where('id', $swapBanco->id)->update(['ordem' => $currentBanco->ordem]);
            echo "<div class='alert alert-success'>Banco movido com sucesso!</div>";
        } else {
            echo "<div class='alert alert-warning'>Movimento não permitido!</div>";
        }
    }
}

$bancos = DB::select('SELECT * FROM bancos ORDER BY ordem');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Bancos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/gestaobancos.css'); ?>
</head>
<body>
    <?php echo $__env->make('commons.nav.menulateral', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestão de Bancos</h1>

        <!-- Formulário para adicionar novo banco -->
        <div class="mb-4 text-end">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#novoBancoModal">Novo Banco</button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Ordem</th>
                        <th>Banco</th>
                        <th>Produto</th>
                        <th>O que pode</th>
                        <th>O que não pode</th>
                        <th>Ação</th>
                        <th>Calc</th>
                        <th>Movimentar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bancos as $banco): ?>
                        <tr>
                            <td><?= $banco->ordem ?></td>
                            <td><?= $banco->banco ?></td>
                            <td><?= $banco->produto ?></td>
                            <td><?= $banco->o_que_pode ?></td>
                            <td><?= $banco->o_que_nao_pode ?></td>
                            <td><?= $banco->acao ?></td>
                            <td><?= $banco->calc ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="banco_id" value="<?= $banco->id ?>">
                                    <button type="submit" name="move_up" class="btn btn-primary btn-sm">↑</button>
                                    <button type="submit" name="move_down" class="btn btn-primary btn-sm">↓</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Adicionar Novo Banco -->
    <div class="modal fade" id="novoBancoModal" tabindex="-1" aria-labelledby="novoBancoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="novoBancoModalLabel">Cadastrar Novo Banco</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="banco" class="form-label">Banco</label>
                            <input type="text" name="banco" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="produto" class="form-label">Produto</label>
                            <input type="text" name="produto" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="o_que_pode" class="form-label">O que pode</label>
                            <textarea name="o_que_pode" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="o_que_nao_pode" class="form-label">O que não pode</label>
                            <textarea name="o_que_nao_pode" class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="acao" class="form-label">Ação</label>
                            <input type="text" name="acao" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="calc" class="form-label">Calc</label>
                            <input type="number" step="0.01" name="calc" class="form-control">
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" name="add_banco" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH /var/www/resources/views/dashboard/gestaobancos.blade.php ENDPATH**/ ?>