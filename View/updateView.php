<?php
// Lógica para marcar os radios baseada no array que o Controller buscou
$checkAvista = ($despesa['avista'] == 1) ? 'checked' : '';
$checkParcelado = ($despesa['parcelado'] == 1) ? 'checked' : '';
?>

<form id="form-edicao-despesa" class="p-2">
    <input type="hidden" name="idDespesas" value="<?= $despesa['idDespesas']; ?>">

    <div class="mb-3">
        <label class="form-label text-secondary small">Nome do titular</label>
        <input type="text" class="form-control bg-dark text-white border-secondary" 
               name="nomeTitu" value="<?= $despesa['nome_titular']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label text-secondary small">Data da compra</label>
        <input type="date" class="form-control bg-dark text-white border-secondary" 
               name="data" value="<?= $despesa['data_da_compra']; ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label text-secondary small">Descrição</label>
        <textarea class="form-control bg-dark text-white border-secondary" 
                  name="descricao" rows="3" required><?= $despesa['descricao']; ?></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label d-block text-secondary small">Tipo de pagamento</label>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipoPagamento" id="radio1" value="avista" <?= $checkAvista ?>>
            <label class="form-check-label text-white" for="radio1">À vista</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="tipoPagamento" id="radio2" value="parcelado" <?= $checkParcelado ?>>
            <label class="form-check-label text-white" for="radio2">Parcelado</label>
        </div>
    </div>
                    <!-- Campo parcelas -->
        <div class="mb-3" id="campoParcelas" style="display: none;">
          <label class="form-label">Quantidade de parcelas</label>
          <input type="number" id="quantidadeParcelas" value="<?= $despesa['quantidade_parcelas']; ?>" class="form-control" name="quantidadeParcelas" min="1">
        </div>

    <div class="mb-3">
        <label class="form-label text-secondary small">Valor (R$)</label>
        <input type="text" class="form-control bg-dark text-white border-secondary" 
               name="valor" value="<?= $despesa['valor']; ?>" required>
    </div>

    <div class="mt-4">
        <button type="button" id="btn-confirmar-update" class="btn btn-success w-100 fw-bold py-2">
            SALVAR ALTERAÇÕES
        </button>
    </div>
</form>