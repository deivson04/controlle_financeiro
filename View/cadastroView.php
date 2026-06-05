<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controlle Cadastro</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body data-page="cadastro">

  <div class="page">
    <div class="card page-card shadow-lg">

      <div id="mensagem" class="mb-3 text-center text-danger"></div>

      <form id="formCadastro" method="POST">

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
           <div class="position-relative">
          <input
            type="password"
            class="form-control"
            id="senhaCad"
            name="senhaCadastro"
            placeholder="Mínimo 6 caracteres"
            data-required="true">
             <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="toggleIcon" style="cursor: pointer; z-index: 10;"></i></div>

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
  <script>
    // Detecta o caminho atual na barra de endereços
    const currentPath = window.location.pathname;

    // Se a URL contém a pasta do Windows, define a base longa. 
    // Caso contrário (Android/Infinity), fica vazio para usar a raiz.
    const BASE_URL = currentPath.includes('git_controlle_financeiro') ?
      '/git_controlle_financeiro/controlle_financeiro' :
      '';

    console.log("Caminho Base do Projeto:", BASE_URL || "Raiz (/)");
  </script>
  <script src="js/script.js"></script>

</body>

</html>