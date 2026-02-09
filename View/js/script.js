document.addEventListener('DOMContentLoaded', () => {

    /* ==========================
       MENU (se existir)
    ========================== */
    const menuToggle = document.querySelector('#menuToggle');
    const sidebar = document.querySelector('#sidebar');
    const backdrop = document.querySelector('#backdrop');

    if (menuToggle && sidebar && backdrop) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open-sidebar');
            backdrop.classList.toggle('show');
        });

        backdrop.addEventListener('click', () => {
            sidebar.classList.remove('open-sidebar');
            backdrop.classList.remove('show');
        });
    }

    /* ==========================
       VALIDAÇÃO DO FORMULÁRIO
    ========================== */
    const form = document.querySelector('#form');
    const senha = document.querySelector('#senhaCadastro');
    const mensagemDiv = document.querySelector('#mensagem');

    if (form && mensagemDiv) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const camposObrigatorios = form.querySelectorAll('[data-required="true"]');
            let valido = true;
            mensagemDiv.innerHTML = '';

            camposObrigatorios.forEach(input => {
                input.classList.remove('is-invalid');

                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    valido = false;
                }
            });

            if (!valido) {
                mensagemDiv.innerHTML =
                    '<div class="alert alert-danger">Preencha todos os campos obrigatórios.</div>';
                return;
            }

            if (senha && senha.value.trim().length < 6) {
                mensagemDiv.innerHTML =
                    '<div class="alert alert-danger">A senha deve ter pelo menos 6 caracteres.</div>';
                senha.classList.add('is-invalid');
                valido = false;
                return;
            }

            mensagemDiv.innerHTML =
                '<div class="alert alert-success">Formulário validado.</div>';

            setTimeout(() => form.submit(), 600);
        });
    }

    /* ==========================
       PARCELAMENTO
    ========================== */
    
      const radioAvista = document.querySelector('#flexRadioDefault1');
    const radioParcelado = document.querySelector('#flexRadioDefault2');
    const campoParcelas = document.querySelector('#campoParcelas');
    const quantParcelas = document.querySelector('#quantidadeParcelas');

    if (radioAvista && radioParcelado && campoParcelas && quantParcelas) {

        // Estado inicial
        campoParcelas.style.display = 'none';
        quantParcelas.value = '';
        quantParcelas.disabled = true;

        radioParcelado.addEventListener('change', () => {
            campoParcelas.style.display = 'block';
            quantParcelas.disabled = false;
            quantParcelas.focus();
        });

        radioAvista.addEventListener('change', () => {
            campoParcelas.style.display = 'none';
            quantParcelas.value = '';
            quantParcelas.disabled = true;
        });
    }
  
    
    /* ==========================
       DELETE VIA AJAX
    ========================== */
    
    document.addEventListener('click', (e) => {
    const btn = e.target.closest('.btn-delete');
    
    if (btn) {
        e.preventDefault();
        const idDespesas = btn.getAttribute('data-id');
        const card = btn.closest('.despesa-card');

        if (confirm('Deseja excluir esta despesa?')) {
            fetch('Controller/DeletarDespesas.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'idDespesas=' + encodeURIComponent(idDespesas)
            })
            .then(response => response.text()) // Primeiro lemos como texto puro
            .then(text => {
                try {
                    const data = JSON.parse(text); // Tentamos converter para JSON
                    if (data.status === 'success') {
                        card.style.opacity = '0';
                        setTimeout(() => {card.remove(); 
                        if (typeof calcularResumoFinanceiro === 'function') {
                      calcularResumoFinanceiro();  
                        }
                      },  400);
                    } else {
                        alert("Erro do PHP: " + data.message);
                    }
                } catch (err) {
                    // Se cair aqui, o PHP mandou algo que não é JSON (ex: um erro de SQL)
                    alert("O PHP mandou um formato inválido: " + text);
                }
            })
            .catch(error => alert("Erro na requisição: " + error.message));
        }
    }
});


    /* ==========================
       UPDATE VIA AJAX
    ========================== */
    document.addEventListener('click', (e) => {
    
    // 1. LÓGICA PARA ABRIR O MODAL E BUSCAR DADOS
    const btnEdit = e.target.closest('.btn-edit');
    if (btnEdit) {
        const id = btnEdit.getAttribute('data-id');
        const container = document.getElementById('container-do-modal');
        
        // Abre o modal com loading
        container.innerHTML = '<div class="text-center p-4"><div class="spinner-border text-success"></div></div>';
        const meuModal = new bootstrap.Modal(document.getElementById('modalEditar'));
        meuModal.show();

        // Busca o formulário
        fetch('Controller/GetUpdateDespesas.php?idDespesas=' + id)
            .then(res => res.text())
            .then(html => { 
                // Inserimos o HTML no modal
                container.innerHTML = html; 

                // --- AGORA selecionamos os elementos que acabaram de ser criados ---
                const radioAvista = container.querySelector('#radio1');
                const radioParcelado = container.querySelector('#radio2');
                const divParcelas = container.querySelector('#campoParcelas');
                const inputParcelas = container.querySelector('#quantidadeParcelas');

                // Lógica Inicial: Se já vier parcelado do banco, mostra o campo
                if (radioParcelado && radioParcelado.checked) {
                    divParcelas.style.display = 'block';
                }

                // Eventos de troca (Toggle)
                if (radioParcelado) {
                    radioParcelado.addEventListener('change', () => {
                        divParcelas.style.display = 'block';
                    });
                }

                if (radioAvista) {
                    radioAvista.addEventListener('change', () => {
                        divParcelas.style.display = 'none';
                        if (inputParcelas) inputParcelas.value = '1'; // Reseta para o padrão
                    });
                }
            })
            .catch(err => console.error("Erro ao carregar modal:", err));
    }

    // 2. LÓGICA PARA SALVAR AS ALTERAÇÕES
    const btnSalvar = e.target.closest('#btn-confirmar-update');
    if (btnSalvar) {
        e.preventDefault();
        //console.log("Iniciando salvamento...");

        const form = document.getElementById('form-edicao-despesa');
        if (!form) {
            //console.error("Formulário não encontrado!");
            return;
        }
        
        const dados = new FormData(form);

        fetch('Controller/UpdateDespesas.php', {
            method: 'POST',
            body: dados
        })
        .then(async res => {
            if (!res.ok) {
                const txt = await res.text();
                throw new Error(`Erro ${res.status}: ${txt.substring(0, 100)}`);
            }
            return res.json();
        })
        .then(data => {
            if (data.status === 'success') {
                alert('Atualizado com sucesso!');
                location.reload();
            } else {
                alert('Erro no Banco: ' + (data.message || 'Erro desconhecido'));
            }
        })
        .catch(err => {
            alert("DETALHE DO ERRO: " + err.message);
            console.error(err);
        });
    }
});

    /* ==========================
       CALCULO DO VALOR E SALDO
    ========================== */
    
     function calcularResumoFinanceiro() {
        let totalMes = 0;   // Vai somar absolutamente tudo
        let saldoDevedor = 0; // Vai somar apenas o que NÃO estiver como "pago"

    // 1. Seleciona todos os cards de despesa que estão na tela
    const cards = document.querySelectorAll('.despesa-card');

    cards.forEach(card => {
        // 2. Captura os valores dos data-attributes que colocamos no HTML
        const valor = parseFloat(card.getAttribute('data-valor')) || 0;
        const status = card.getAttribute('data-status').trim().toLowerCase();

        // 3. Soma ao total geral (estático)
        totalMes += valor;

        // 4. Lógica do Saldo Dinâmico: só soma se o status não for 'pago'
        if (status !== 'pago') {
            saldoDevedor += valor;
        }
    });

    // 5. Formata os números para o padrão de moeda brasileira (R$)
    const formatador = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    });

    // 6. Atualiza os elementos que criamos no seu layout fora dos cards
    document.getElementById('total-estatico').innerText = formatador.format(totalMes);
    document.getElementById('saldo-dinamico').innerText = formatador.format(saldoDevedor);
}

// Executa a função assim que a página terminar de carregar
calcularResumoFinanceiro();

        /* ==========================
       DINAMICA DO STATUS
    ========================== */
document.addEventListener('click', (e) => {
    const badge = e.target.closest('.badge');
    if (badge) {
        const card = badge.closest('.despesa-card');
        const id = card.getAttribute('data-id');
        
        // Normalizamos para minúsculo para a lógica não quebrar
        const statusAtual = card.getAttribute('data-status').trim().toLowerCase();
        
        // Alterna a lógica (sempre em minúsculo para o banco/lógica)
        const novoStatus = (statusAtual === 'pago') ? 'A pagar' : 'pago';

        const dados = new FormData();
        dados.append('idDespesas', id);
        dados.append('status', novoStatus); 

        fetch('Controller/UpdateDespesas.php', {
            method: 'POST',
            body: dados
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                // 1. Atualiza o atributo para o próximo clique
                card.setAttribute('data-status', novoStatus);
                
                // 2. Define o ícone e o texto formatado
                const e_pago = (novoStatus === 'pago');
                const iconeClasse = e_pago ? 'bi-check-circle-fill' : 'bi-clock-history';
                const textoExibicao = e_pago ? 'Pago' : 'A Pagar';
                
                // 3. ATENÇÃO: Usei CRASE ( ` ) aqui para o ícone funcionar
                badge.innerHTML = `<i class="bi ${iconeClasse} me-1"></i> ${textoExibicao}`;
                
                // 4. Atualiza as cores dinamicamente
                if (e_pago) {
                    badge.style.backgroundColor = '#d4edda';
                    badge.style.color = '#155724';
                } else {
                    badge.style.backgroundColor = '#fff3cd';
                    badge.style.color = '#856404';
                }

                if (typeof calcularResumoFinanceiro === 'function') {
                    calcularResumoFinanceiro();
                }
            }
        })
        .catch(err => {
            console.error("Erro no Fetch:", err);
            alert("Erro ao salvar no banco!");
        });
    }
});

    /* ==========================
       LOGICA DO MES E ANO
    ========================== */
    
    
        
});
