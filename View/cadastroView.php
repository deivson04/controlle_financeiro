<?php

session_start();
$erros = $_SESSION['erros'] ?? [];

// Limpa as variáveis de sessão para que não apareçam novamente
unset($_SESSION['erros']['senha']);
?>
<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controller Cadastro</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

</head>

<body>

    <div class="container-fluid d-flex justify-content-center align-items-center full-height custom-bg">

        <div class="border p-4 rounded shadow-sm custom-width">
            
        <div id="mensagem" class="mb-3 text-center"></div>


            <form id="form" action="../Controller/cadastro.php" method="POST" class="custom-width">

                <h1 class="text-center mb-4">Controlle Cadastro</h1>

                <div class="form-group">

                    <label>Nome:</label>

                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome">

                </div>

                <div class="form-group">

                    <label>Email:</label>

                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email">

                </div>


                <div class="form-group">

                    <label>senha:</label>

                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Mínimo 6 caracteres">
                    <?php if (!empty($erros['senha'])): ?>
                        <p class="text-danger"><?php echo $erros['senha']; ?></p>
                    <?php endif; ?>

                </div><br>


                <button type="submit" class="btn btn-primary  w-100"id="btnCadastrar">Cadastrar</button><br><br>

                <div class="text-center mt-3 mb-3">
                    <hr>

                    <p class="form-text mt-3"> Tem uma conta? <a href="loginView.php">Entrar</a></p>
                    <p class="form-text mt-3">Deseja voltar ao inicio? <a href="../index.php">Clique aqui</a></p>
                </div>
        </div>
<script>
const nomeInput = document.querySelector('#nome');
const emailInput = document.querySelector('#email');
    const senhaInput = document.querySelector('#senha');
    const mensagemDiv = document.querySelector('#mensagem');
    const botao = document.querySelector('#btnCadastrar');
    const form = document.querySelector('#form');

    botao.addEventListener('click', (e) => {
    e.preventDefault();
    let nome = nomeInput.value;
    let email = emailInput.value;
    let senha = senhaInput.value;
    
    if (nome === '' || email === '' || senha === '') {
        
        mensagemDiv.innerHTML = '<div class="alert alert-danger">Por favor, preencha todos os campos!</div>';
         return;
    }
    
    mensagemDiv.innerHTML = '<div class="alert alert-success">Cadastro validado, cadastrando...</div>';
      setTimeout(() => {
        form.submit();
    }, 800);
});
</script>




        <script src="js/bootstrap.min.js"></script>

        <script src="js/script.js"></script>

</body>

</html>