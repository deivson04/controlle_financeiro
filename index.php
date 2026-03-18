<?php

//require_once "Config/conexao.php";
//require_once __DIR__ . '/vendor/autoload.php';

use Controller\DashboardDespesas;

//$return = new Conexao();
//$re = $return->conectar();

//if ($re) {
//echo 'conexao ok';
// }else {
// echo 'conexao falhou';
// }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controlle Financeiro</title>
  <link rel="stylesheet" href="View/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="View/css/style.css">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;600;700&display=swap"
    rel="stylesheet">

</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm py-2 ">
      <div class="container d-flex align-items-center">
        <div class="d-flex flex-column flex-lg-row align-items-start align-items-lg-center">
          <a class="navbar-brand p-0 m-0" href="index.php">
            <img class="logo" src="View/img/logo_titulo.png" alt="Logo">
          </a>
        </div>
        <button class="navbar-toggler collapsed ms-auto" type="button" data-bs-toggle="collapse"
          data-bs-target="#navbarNav" aria-expanded="false">
          <span class="toggler-icon top-bar"></span>
          <span class="toggler-icon middle-bar"></span>
          <span class="toggler-icon bottom-bar"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end text-center" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link active" href="index.php">Início</a></li>
            <li class="nav-item"><a class="nav-link" href="View/sobreNos.php">Sobre</a></li>
          </ul>
          <a href="View/loginView.php"
            class="btn btn-outline-success bg-transparent border-1 ms-lg-3 fw-semibold">Login</a>
        </div>
      </div>
    </nav>
  </header>

  <main class="text-center py-5 bg-light">

    <div class="container">
      <div class="row align-items-center justify-content-center">

        <div class="col-md-6 text-md-start text-center mb-4 mb-md-0">
          <h2 class="fw-bold mb-3">Assuma o controlle total das suas despesas</h2>
          <a href="View/loginView.php" class="btn btn-success">
            Começar a controllar agora
          </a>
        </div>

        <div class="col-md-5 text-center">
          <img src="View/img/image_index.jpg" alt="Imagem ilustrativa" class="img-fluid rounded shadow-sm">
        </div>

      </div>
    </div>
    <div class="container my-4">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="p-4 text-center border border-secondary rounded bg-light" style="height: 60px;">

          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center g-4">
        <div class="col-md-4">
          <div class="card border-0 shadow-md p-4 h-100">
            <div class="mb-3">
              <i class="bi bi-shield-check text-success display-4"></i>
            </div>
            <h5 class="fw-bold">Controlle suas despesas</h5>
            <p class="text-muted">Registre, acompanhe e organize seus gastos de forma prática e intuitiva.</p>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card border-0 shadow-md p-4 h-100">
            <div class="mb-3">
              <i class="bi bi-graph-up-arrow text-success display-4"></i>
            </div>
            <h5 class="fw-bold">Controlle seus gastos</h5>
            <p class="text-muted">Acompanhe suas despesas,identifique excessos e mantenha seu orçamento sempre sob
              controlle de forma simples e organizada.</p>
          </div>
        </div>
      </div>
    </div>

  </main>

  <div class="modal fade" id="privacidadeModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
      <div class="modal-content">

        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Política de Privacidade</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
          <h2><strong>Política de Privacidade – Controlle Financeiro</strong></h2>
          <p>Última atualização: 2026</p>
          <p>
            A sua privacidade é importante para nós. Esta Política de Privacidade descreve como o sistema
            <strong>Controlle
              Financeiro</strong> coleta, usa, armazena e protege as informações dos usuários, em conformidade com a Lei
            Geral de
            Proteção de Dados.
          </p>

          <hr class="border-secondary">

          <p><strong>1. Coleta de Dados</strong></p>

          <p>Coletamos as seguintes informações dos usuários:</p>
          <ul>
            <li>Nome</li>
            <li>Endereço de e-mail</li>
            <li>Informações de login (incluindo autenticação via Google)</li>
            <li>Dados financeiros inseridos pelo usuário (receitas, despesas, categorias, etc.)</li>
            <li>Dados de navegação (como endereço IP e cookies)</li>
          </ul>

          <hr class="border-secondary">

          <p><strong>2. Uso das Informações</strong></p>

          <p>As informações coletadas são utilizadas para:</p>

          <ul>
            <li>Criar e gerenciar a conta do usuário</li>
            <li>Permitir acesso ao sistema</li>
            <li>Armazenar e organizar dados financeiros pessoais</li>
            <li>Melhorar a experiência do usuário</li>
            <li>Garantir a segurança da aplicação</li>
          </ul>


          <hr class="border-secondary">

          <p><strong>3. Login com Google</strong></p> 

          <p>O usuário pode optar por se cadastrar ou acessar o sistema utilizando sua conta Google.</p>

          <p>Nesse caso:</p>
          <ul>
            <li>Apenas informações básicas (como nome e e-mail) são coletadas</li> 
            <li>Não temos acesso à senha da conta Google</li> 
            <li>A autenticação é realizada de forma segura pela própria plataforma Google</li> 
          </ul>

          <hr class="border-secondary">

          <p><strong>4. Compartilhamento de Dados</strong></p>

          <p><strong>O Controlle Financeiro NÃO vende, aluga ou compartilha dados pessoais com terceiros, exceto:</strong></p>
          
          <ul>
            <li>Quando necessário para funcionamento do sistema (ex: autenticação com Google)</li> 
            <li>Quando exigido por lei</li> 
          </ul>

          <hr class="border-secondary">

          <p><strong>5. Armazenamento e Segurança</strong></p>

          <p>Adotamos medidas de segurança para proteger os dados dos usuários, incluindo:</p>
          
          <ul>
            <li>Proteção de acesso ao sistema</li> 
            <li>Uso de boas práticas de desenvolvimento</li> 
            <li>Armazenamento seguro das informações</li> 
          </ul>

          <p>Apesar disso, nenhum sistema é 100% seguro, e recomendamos que o usuário também proteja suas credenciais.</p>

          <hr class="border-secondary">

          <p><strong>6. Dados Financeiros</strong></p>

          <p>Os dados financeiros inseridos no sistema são de total responsabilidade do usuário e são utilizados
          exclusivamente para fins de organização pessoal dentro da plataforma.</p>

          <p>Esses dados não são compartilhados com terceiros sem consentimento.</p>

          <hr class="border-secondary">

          <p><strong>7. Direitos do Usuário</strong></p>

          <p>O usuário tem o direito de:</p>
          <ul>
            <li>Acessar seus dados</li> 
            <li>Corrigir informações incorretas</li> 
            <li>Solicitar a exclusão da conta e dos dados</li> 
            <li>Revogar o consentimento de uso dos dados</li> 
          </ul>

          <hr class="border-secondary">

          <p><strong>8. Uso de Cookies</strong></p>

          <p>Utilizamos cookies para:</p>
          <ul>
            <li>Manter o usuário logado</li> 
            <li>Melhorar a experiência de navegação</li> 
          </ul>

          <p>O usuário pode desativar os cookies nas configurações do navegador, mas isso pode afetar o funcionamento do
          sistema.</p>

          <hr class="border-secondary">

          <p><strong>9. Alterações nesta Política</strong></p>

          <p>Esta Política de Privacidade pode ser atualizada a qualquer momento. Recomendamos que o usuário revise esta
          página periodicamente.</p>

          <hr class="border-secondary">

          <p><strong>10. Contato</strong></p>

          <p>Em caso de dúvidas sobre esta Política de Privacidade, o usuário pode entrar em contato através de:</p>

          <ul>
            <li>E-mail: [suporte@controllefinanceiro.com](mailto:suporte@controllefinanceiro.com)</li> 
          </ul>

          <hr class="border-secondary">

          <p>Ao utilizar o sistema <strong>Controlle Financeiro</strong>, o usuário concorda com os termos desta Política de
          Privacidade.</p>

        </div>

        <div class="modal-footer">
          <input type="button" value="Concordo" class="btn btn-success" data-bs-dismiss="modal">
        </div>

      </div>
    </div>
  </div>


  <footer class="bg-dark text-light pt-5 pb-3">
    <div class="container">

      <div class="row">

        <div class="col-md-6 mb-4 text-center text-md-start">
          <h5 class="text-success">Links úteis</h5>

          <ul class="list-unstyled">
            <li><a href="View/sobreNos.php" class="text-decoration-none text-light">› Sobre nós</a></li>
            <li><a href="View/guiaUsuario.php" class="text-decoration-none text-light">› Guia do usuário</a></li>
            <li><a href="#" class="text-decoration-none text-light" data-bs-toggle="modal"
                data-bs-target="#privacidadeModal">› Política de privacidade</a></li>
          </ul>
        </div>

        <div class="col-md-6 mb-4">
          <div class="d-flex align-items-center">
            <img src="View/img/logo.svg" width="85" class="me-3">
            <div>
              <h4 class="text-white mb-1">Controlle Financeiro</h4>
              <p class="text-secondary mb-0">
                Sistema para gerenciar suas despesas.
              </p>
            </div>
          </div>
        </div>
      </div>

      <hr class="border-secondary">

      <!-- Copyright -->
      <div class="text-center">
        <p class="mb-0">
          © 2026 <span class="text-success">Controle Financeiro</span> — Todos os direitos reservados.
        </p>
      </div>

    </div>
  </footer>

  <script src="View/js/bootstrap.min.js"></script>
  <script src="View/js/script.js"></script>

</body>

</html>