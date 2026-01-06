<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Adicionar Despesas</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

</head>

<body>

  <div class="container-fluid d-flex justify-content-center align-items-center full-height custom-bg">

    <div class="border p-4 rounded shadow-sm custom-width">

      <div id="mensagem" class="mb-3 text-center"></div>


      <form id="form" action="../Controller/AddDispesas.php" method="POST" class="custom-width">

        <h1 class="text-center mb-4">Adicionar Despesas</h1>

        <div class="form-group">

          <label>*Nome titular do cartão (obrigatório)</label>

          <input type="text" class="form-control" id="nomeTitu" name="nomeTitu" data-required="true">

        </div><br>

        <div class="form-group">

          <label>*Data da Compra (obrigatório)</label>

          <input type="date" class="form-control" id="data" name="data" data-required="true">

        </div><br>


        <div class="form-group">

          <label>*Descrição (obrigatório)</label>

          <textarea type="text" class="form-control" id="descricao" name="descricao" data-required="true"></textarea>


        </div><br>

        <label>*Tipo de Parcelamento (obrigatório)</label><br><br>

        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1"
            value="avista" checked>
          <label class="form-check-label" for="flexRadioDefault1">
            Avista
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2"
            value="parcelado">
          <label class="form-check-label" for="flexRadioDefault2">
            Parcelado
          </label>
          <div id="campoParcelas">
            <label for="quantidadeParcelas">Quantidade de parcelas:</label>
            <input type="number" id="quantidadeParcelas" name="quantidadeParcelas"
              value="">
          </div>
        </div><br>

        <div class="form-group">

          <label>*Valor (obrigatório)</label>

          <input type="text" class="form-control" id="valor" name="valor" data-required="true"><br><br>


          <button type="submit" class="btn btn-primary btn-success w-100" id="btnCadastrar">Salvar</button><br><br>

          <div class="text-center mt-3 mb-3">
            <hr>

            <p class="form-text mt-3 link">Deseja voltar ao dashboard? <a href="./DashboardView.php">Clique aqui</a></p>
          </div>
        </div>


        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>

</body>

</html>
