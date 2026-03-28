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

    <div class="page">

        <div class="page-card shadow-lg">

            <div id="mensagem" class="mb-3 text-center"></div>

            <form id="formRecupSenha" method="POST" class="custom-width">

                <h1 class="text-center mb-4">Recuperar Senha</h1>

                <div class="form-group">

                    <label>Email:</label>

                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" data-required="true"><br>

                    <button type="submit" class="btn btn-primary btn-success w-100">Enviar</button><br><br>

                    <p class="form-text mt-3 link">Já tem uma conta? <a href="loginView.php">Faça login aqui</a></p>
                    <p class="form-text mt-3 link">Deseja voltar ao inicio? <a href="../index.php">Clique aqui</a></p>

                </div>
            </form>
        </div>
    </div>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>