<?php
session_start();

// O ID deve vir da sessão, que foi populada pelo Controller que validou o e-mail.
// Se o ID não existir, o acesso é barrado.
$id_usuario_recuperacao = $_SESSION['idUsuario_recuperacao'] ?? null;

// 

if (!$id_usuario_recuperacao) {
    // Se o ID não está na sessão, impede o acesso direto ou repetição de processo.
    // Redireciona para o login (ou para o formulário de recuperação de e-mail).
    header('Location: loginView.php');
    exit;
}
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Recuperar Senha</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

</head>

<body data-page="novaSenha">

    <div class="page">

        <div class="page-card shadow-lg">
            <div id="mensagem" class="mb-3 text-center"></div>

            <form id="formNovaSenha" method="POST" class="custom-width">

                <h1 class="text-center mb-4">Recuperar Senha</h1>

                <div class="form-group">

                    <label>Nova Senha:</label>
                     <div class="position-relative mb-3">
                    <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($id_usuario_recuperacao); ?>">
                     
                    <input type="password" class="form-control" id="senhaCadastro" name="novaSenha" placeholder="Mínimo 6 caracteres" data-required="true">
                    
                    <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3" id="toggleIcon" style="cursor: pointer; z-index: 10;"></i></div>


                    <button type="submit" class="btn btn-primary btn-success w-100">Validar</button><br><br>
                    <p class="form-text mt-3 link">Lembre-se da sua senha? <a href="loginView.php">Faça login aqui</a></p>
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