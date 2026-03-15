<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Adicionar Despesas</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <div class="page">
    <div class="card page-card shadow-sm">

      <div id="mensagem" class="mb-3 text-center text-danger"></div>

      <form id="form" action="../Controller/AddDispesas.php" method="POST">

        <h1 class="text-center mb-4">Adicionar Despesas</h1>

        <div class="mb-3">
          <label class="form-label">Nome do titular <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="nomeTitu" data-required="true">
        </div>

        <div class="mb-3">
          <label class="form-label">Data da compra <span class="text-danger">*</span></label>
          <input type="date" class="form-control" name="data" data-required="true">
        </div>

        <div class="mb-3">
          <label class="form-label">Descrição <span class="text-danger">*</span></label>
          <textarea class="form-control" name="descricao" rows="3" data-required="true"></textarea>
        </div>

        <div class="mb-3">
          <label class="form-label d-block">Tipo de parcelamento <span class="text-danger">*</span></label>

          <div class="form-check">
            <input class="form-check-input" type="radio" id="flexRadioDefault1" name="tipoPagamento" value="avista" checked>
            <label class="form-check-label">À vista</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" id="flexRadioDefault2" name="tipoPagamento" value="parcelado">
            <label class="form-check-label">Parcelado</label>
          </div>
          </div>

        <!-- Campo parcelas -->
        <div class="mb-3" id="campoParcelas" style="display: none;">
          <label class="form-label">Quantidade de parcelas</label>
          <input type="number" id="quantidadeParcelas" class="form-control" name="quantidade_parcelas" min="1">
        </div>
        

        <div class="mb-3">
          <label class="form-label">Valor <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="valor" data-required="true">
        </div>

        <button type="submit" class="btn btn-success w-100 mb-3">Salvar</button>

        <div class="links">
          <p>Deseja voltar ao dashboard? <a href="../DashboardRota.php">Clique aqui</a></p>
        </div>

      </form>
    </div>
  </div>
   <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>
</body>
</html>
