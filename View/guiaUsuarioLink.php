<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guia do usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header-guia {
            background: linear-gradient(135deg, #28a745 0%, #218838 100%);
            color: white;
            padding: 40px 20px;
            border-radius: 0 0 30px 30px;
        }

        .card-passo {
            border: none;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .bg-login {
            background-color: #e7f1ff;
            color: #0d6efd;
        }

        .bg-add {
            background-color: #fff3cd;
            color: #ffc107;
        }

        .bg-status {
            background-color: #d1e7dd;
            color: #198754;
        }
            
    </style>
</head>

<body>

    <div class="header-guia text-center shadow-sm">
        <a href="../index.php" class="text-white position-absolute start-0 ms-4 mt-n2"><i
                class="bi bi-arrow-left fs-3"></i></a>
        <h2 class="fw-bold">Guia do usuário</h2>
        <p class="opacity-75">Tudo o que você precisa saber para dominar seu financeiro</p>
    </div>

    <div class="container mt-4 pb-5">

        <div class="card card-passo shadow-sm">
            <div class="card-body p-4">
                <div class="icon-circle bg-login">
                    <i class="bi bi-shield-lock-fill fs-4"></i>
                </div>
                <h5 class="fw-bold">1. Acessando o Sistema</h5>
                <div class="container my-4">
                    <video controls class="w-100 rounded shadow">
                        <source src="img/cadastro-login.mp4">
                    </video>
                </div>
                <p class="text-muted">Para garantir a segurança dos seus dados, você pode entrar de duas formas:</p>
                <div class="row g-2">
                    <div class="col-6">
                        <div class="p-2 border rounded text-center small">
                            <i class="bi bi-person-circle d-block mb-1"></i> Login Normal
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-2 border rounded text-center small">
                            <i class="bi bi-google d-block mb-1"></i> Conta Google
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-passo shadow-sm">
            <div class="card-body p-4">
                <div class="icon-circle bg-add">
                    <i class="bi bi-plus-lg fs-4"></i>
                </div>
                <h5 class="fw-bold">2. Como Adicionar Despesas</h5>
                <div class="container my-4">
                    <video controls class="w-100 rounded shadow">
                        <source src="img/despesas.mp4">
                    </video>
                </div>
                <p class="text-muted">No menu lateral, clique em <strong>"Adicionar Despesas"</strong>. Lá você define:
                </p>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><i class="bi bi-dot text-warning fs-4"></i> <strong>À Vista:</strong> Cobrança
                        única no mês atual.</li>
                    <li><i class="bi bi-dot text-warning fs-4"></i> <strong>Parcelado:</strong> O sistema gera as
                        parcelas automaticamente para os meses futuros.</li>
                </ul>
            </div>
        </div>

        <div class="card card-passo shadow-sm">
            <div class="card-body p-4">
                <div class="icon-circle bg-status">
                    <i class="bi bi-hand-index-thumb-fill fs-4"></i>
                </div>
                <h5 class="fw-bold">3. Controle de Pagamento</h5>
                <p class="text-muted">Esta é a parte mais poderosa do seu Dashboard. Ao clicar no botão de status:</p>

                <div class="alert alert-success border-0 rounded-4">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-success me-2 p-2">Pago</span>
                        <span class="small text-dark">O valor da conta é **subtraído** do seu Saldo Devedor.</span>
                    </div>
                </div>

                <div class="alert alert-warning border-0 rounded-4">
                    <div class="d-flex align-items-center">
                        <span class="badge bg-warning text-dark me-2 p-2">A Pagar</span>
                        <span class="small text-dark">O valor **volta** para o Saldo Devedor imediatamente.</span>
                    </div>
                </div>

                <p class="small text-muted mt-2 mb-0">
                    <i class="bi bi-lightning-charge-fill text-warning"></i>
                    A atualização é dinâmica e você vê o resultado no topo da tela na mesma hora!
                </p>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>