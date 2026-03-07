<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controlle Cadastro</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <div class="page">
    <div class="card page-card shadow-sm">

      <div id="mensagem" class="mb-3 text-center text-danger"></div>

      <form id="form" action="../Controller/Cadastro.php" method="POST">

        <h1 class="text-center mb-4">Controlle Cadastro</h1>

        <div class="mb-3">
          <label class="form-label">
            Nome <span class="text-danger">*</span>
          </label>
          <input 
            type="text" 
            class="form-control" 
            id="nome" 
            name="nome" 
            placeholder="Digite seu nome"
            data-required="true">
        </div>

        <div class="mb-3">
          <label class="form-label">
            Email <span class="text-danger">*</span>
          </label>
          <input 
            type="email" 
            class="form-control" 
            id="email" 
            name="email" 
            placeholder="Digite seu email"
            data-required="true">
        </div>

        <div class="mb-3">
          <label class="form-label">
            Senha <span class="text-danger">*</span>
          </label>
          <input 
            type="password" 
            class="form-control" 
            id="senhaCadastro" 
            name="senhaCadastro" 
            placeholder="Mínimo 6 caracteres"
            data-required="true">
        </div>

        <button 
          type="submit" 
          class="btn btn-success w-100 mb-3" 
          id="btnCadastrar">
          Cadastrar
        </button>

        <div class="links">
          <p>Já tem uma conta? <a href="loginView.php">Entrar</a></p>
          <p>Deseja voltar ao início? <a href="../index.php">Clique aqui</a></p>
        </div>

      </form>
    </div>
  </div>

  <script src="js/bootstrap.min.js"></script>
  <script src="js/script.js"></script>

</body>
</html>
