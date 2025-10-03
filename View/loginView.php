<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

use Google\Client;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

        $client = new Google_Client();

        $idClient = $_ENV['GOOGLE_CLIENT_ID'];
$secretClient = $_ENV['GOOGLE_CLIENT_SECRET'];
        $client->setClientId($idClient);
        $client->setClientSecret($secretClient);

        // URL de Redirecionamento
        $redirectUri = 'https://lindsay-pierre-wider-oral.trycloudflare.com/View/dashboardView.php';
        $client->setRedirectUri($redirectUri);

        // Define os escopos de acesso
        $client->addScope('email');
        $client->addScope('profile');

        $authUrl = $client->createAuthUrl();

    


?>


<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controller Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">

</head>

<body>

     <div class="container-fluid d-flex justify-content-center align-items-center full-height custom-bg">

        <div class="border p-4 rounded shadow-sm custom-width">


            <form action="../Controller/dashboard.php" method="POST" class="custom-width">

                <h1 class="text-center mb-4">Controlle Login</h1>

                <div class="form-group">

                    <label>Email:</label>

                    <input type="email" class="form-control" id="email" name="email" required>

                </div>


                <div class="form-group">

                    <label>senha:</label>

                    <input type="text" class="form-control" id="senha" name="senha" required>

                </div><br>


                <button type="submit" class="btn btn-primary  w-100">Entrar</button><br><br>

                <div class="text-center mt-3 mb-3">
                <hr>
                <p>ou</p>
            </div>
            <div class="text-center mt-3 mb-3">
    <a href="<?= $authUrl ?>" 
       type="button" 
       class="btn btn-outline-secondary w-100 d-flex align-items-center justify-content-center">
        Acessar com o Google
    </a>
</div>
            <p class="form-text mt-3">Ainda não tem uma conta? <a href="cadastroView.php">Cadastre-se aqui</a></p>
            <p class="form-text mt-3">Deseja voltar ao inicio? <a href="../index.php">Clique aqui</a></p>
        </div>
    </div>


            


   <script src="js/bootstrap.min.js"></script>

   <script src="js/script.js"></script>

</body>

</html>
