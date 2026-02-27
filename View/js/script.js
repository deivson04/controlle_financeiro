document.addEventListener('DOMContentLoaded', () => {

    /* ==========================
       MENU
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
       DINAMICA DO STATUS (MARCAR PAGO)
    ========================== */
    document.addEventListener('click', (e) => {
        const badge = e.target.closest('.badge-status-clicavel');
        if (badge) {
            const card = badge.closest('.despesa-card');
            if (!card) return;

            const id = card.getAttribute('data-id');
            const pAtual = parseInt(card.getAttribute('data-p-atual')) || 0;
            const pPagasNoBanco = parseInt(card.getAttribute('data-p-pagas')) || 0;

            let novoStatusNumerico = (pAtual <= pPagasNoBanco) ? pAtual - 1 : pAtual;

            const dados = new FormData();
            dados.append('idDespesas', id);
            dados.append('status', novoStatusNumerico);

            fetch('Controller/UpdateDespesas.php', {
                method: 'POST',
                body: dados
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    location.reload(); 
                } else {
                    alert("Erro: " + data.msg);
                }
            })
            .catch(err => console.error("Erro na requisição status"));
        }
    });

    /* ==========================
       LOGICA DO MES E ANO (CALENDÁRIO)
    ========================== */
    let dataCalendario = new Date();

    function atualizarTextoCalendario() {
        const displayMes = document.querySelector('#mes');
        if (!displayMes) return;

        const meses = [
            "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
            "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
        ];

        const mesTexto = meses[dataCalendario.getMonth()];
        const anoTexto = dataCalendario.getFullYear();
        displayMes.innerText = `${mesTexto} / ${anoTexto}`;
    }

    async function buscarDadosFiltrados() {
        const container = document.querySelector('#lista-despesas');
        if (!container) return;

        const m = dataCalendario.getMonth() + 1;
        const a = dataCalendario.getFullYear();

        container.style.opacity = '0.5';

        try {
            const response = await fetch(`Controller/ListarDespesas.php?mes=${m}&ano=${a}`);
            const html = await response.text();
            container.innerHTML = html;
            
            // IMPORTANTE: Recalcula o financeiro após carregar novos cards
            if (typeof calcularResumoFinanceiro === 'function') {
                calcularResumoFinanceiro();
            }
        } catch (error) {
            console.error("Erro ao buscar despesas:", error);
        } finally {
            container.style.opacity = '1';
        }
    }

    const btnPrev = document.querySelector('#prev');
    const btnNext = document.querySelector('#next');

    if (btnPrev && btnNext) {
        btnPrev.addEventListener('click', () => {
            dataCalendario.setMonth(dataCalendario.getMonth() - 1);
            atualizarTextoCalendario();
            buscarDadosFiltrados();
        });

        btnNext.addEventListener('click', () => {
            dataCalendario.setMonth(dataCalendario.getMonth() + 1);
            atualizarTextoCalendario();
            buscarDadosFiltrados();
        });
    }

    /* ==========================
       CALCULO FINANCEIRO
    ========================== */
    function calcularResumoFinanceiro() {
        let totalMes = 0;
        let saldoDevedor = 0;
        const cards = document.querySelectorAll('.despesa-card');

        cards.forEach(card => {
            const valor = parseFloat(card.getAttribute('data-valor')) || 0;
            const pAtual = parseInt(card.getAttribute('data-p-atual')) || 0;
            const pPagas = parseInt(card.getAttribute('data-p-pagas')) || 0;

            totalMes += valor;
            // Lógica baseada nos números das parcelas
            if (pAtual > pPagas) {
                saldoDevedor += valor;
            }
        });

        const formatador = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' });
        
        const elTotal = document.getElementById('total-estatico');
        const elSaldo = document.getElementById('saldo-dinamico');
        
        if (elTotal) elTotal.innerText = formatador.format(totalMes);
        if (elSaldo) elSaldo.innerText = formatador.format(saldoDevedor);
    }

    // Inicialização
    atualizarTextoCalendario();
    calcularResumoFinanceiro();

    /* Mantive suas outras lógicas de Form e Delete abaixo... */
    // [Aqui continuam as funções de Delete e Update que você já tem]

});