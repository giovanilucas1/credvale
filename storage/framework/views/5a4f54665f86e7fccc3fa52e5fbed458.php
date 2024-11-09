<!-- resources/views/dashboard/modals/novo_usuario.blade.php -->
<div class="modal fade" id="novoUsuarioModal" tabindex="-1" aria-labelledby="novoUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="novoUsuarioModalLabel">Registrar Novo Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/gestaouser/novo" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="mb-3">
                        <label for="nomeCompleto" class="form-label">Nome Completo</label>
                        <input type="text" id="nomeCompleto" name="nomeCompleto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Corporativo</label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="setor" class="form-label">Setor</label>
                        <input type="text" id="setor" name="setor" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="cargo" class="form-label">Cargo</label>
                        <select id="cargo" name="cargo" class="form-select" required>
                            <option value="Vendas">Vendas</option>
                            <option value="Operacional">Operacional</option>
                            <option value="Diretoria e Gerência">Diretoria e Gerência</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="permissao" class="form-label">Permissão de Acesso</label>
                        <select id="permissao" name="permissao" class="form-select" required>
                            <option value="Administrador">Administrador</option>
                            <option value="Vendedor">Vendedor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" id="senha" name="senha" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/resources/views/dashboard/modals/novo_usuario.blade.php ENDPATH**/ ?>