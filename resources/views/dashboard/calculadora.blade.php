<!-- resources/views/dashboard/calculadora.blade.php -->
<div class="modal fade" id="calculadoraModal" tabindex="-1" aria-labelledby="calculadoraModalLabel" aria-hidden="true">
    @vite('resources/css/calculadora.css') <!-- Carrega o CSS personalizado da calculadora -->
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="calculadoraModalLabel">Nova Simulação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Adicione o CAMPO DESEJADO para realizar a simulação e abrir a ficha de oportunidades do cliente</p>
                <form>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf" name="cpf" class="form-control" placeholder="Informe o número do CPF" required>
                    </div>
                    <div class="mb-3">
                        <label for="beneficio" class="form-label">Benefício</label>
                        <input type="text" id="beneficio" name="beneficio" class="form-control" placeholder="Informe o número do Benefício" required>
                    </div>
                    <div class="mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Informe o número do Código" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Informe o número do Telefone" required>
                    </div>
                    <div class="button-container d-flex justify-content-end">
                        <button type="button" class="cancel-btn me-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="simulate-btn">Simular</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
