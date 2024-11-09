<!-- resources/views/dashboard/modals/trocar_senha.blade.php -->
<div class="modal fade" id="trocarSenhaModal" tabindex="-1" aria-labelledby="trocarSenhaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trocarSenhaModalLabel">Trocar Senha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/gestaouser/trocar-senha" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" id="trocarSenhaUserId" name="user_id">
                    <div class="mb-3">
                        <label for="novaSenha" class="form-label">Nova Senha</label>
                        <input type="password" id="novaSenha" name="novaSenha" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmarSenha" class="form-label">Confirmar Senha</label>
                        <input type="password" id="confirmarSenha" name="confirmarSenha" class="form-control" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Confirmar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/resources/views/dashboard/modals/trocar_senha.blade.php ENDPATH**/ ?>