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

    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center full-height custom-bg">

        <div class="border p-4 rounded shadow-sm custom-width">


            <form action="../Controller/NovaSenha.php" method="POST" class="custom-width">

                <h1 class="text-center mb-4">Recuperar Senha</h1>

                <div class="form-group">

                    <label>Nova Senha:</label>

                    <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($id_usuario_recuperacao); ?>">
                    <input type="password" class="form-control" id="novaSenha" name="novaSenha" required><br>

                    <button type="submit" class="btn btn-primary  w-100">Validar</button><br><br>