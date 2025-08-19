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


            <form action="../Controller/cadastro.php" method="POST" class="custom-width">

                <h1 class="text-center mb-4">Controlle Cadastro</h1>

                <div class="form-group">

                    <label>Nome:</label>

                    <input type="text" class="form-control" id="nome" name="nome" required>

                </div>

                <div class="form-group">

                    <label>Email:</label>

                    <input type="email" class="form-control" id="email" name="email" required>

                </div>


                <div class="form-group">

                    <label>senha:</label>

                    <input type="text" class="form-control" id="senha" name="senha" required>

                </div><br>


                <button type="submit" class="btn btn-primary  w-100">Cadastrar</button><br><br>

                <div class="text-center mt-3 mb-3">
                <hr>
                
            <p class="form-text mt-3"> Tem uma conta? <a href="loginView.php">Entrar</a></p>
            <p class="form-text mt-3">Deseja voltar ao inicio? <a href="../index.php">Clique aqui</a></p>
        </div>
    </div>


            


   <script src="js/bootstrap.min.js"></script>

   <script src="js/script.js"></script>

</body>

</html>
