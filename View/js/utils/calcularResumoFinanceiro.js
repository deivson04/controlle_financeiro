export function calcularResumoFinanceiro() {
  let totalMes = 0; 
  let saldoDevedor = 0; 
  let temDebitoAtrasado = false;

  const cards = document.querySelectorAll(".despesa-card");
  
  // Captura a data de hoje e zera as horas para comparação
  const dataAtual = new Date();
  dataAtual.setHours(0, 0, 0, 0);

  cards.forEach((card) => {
    const valor = parseFloat(card.getAttribute("data-valor")) || 0;
    const pAtual = parseInt(card.getAttribute("data-p-atual")) || 0; // Volta a ser número
    const pPagas = parseInt(card.getAttribute("data-p-pagas")) || 0;
    
    // Captura a data de vencimento
    const dataVencimento = card.getAttribute("data-vencimento");

    totalMes += valor;

    // Lógica matemática
    if (pAtual > pPagas) {
      saldoDevedor += valor;

      // Se a parcela está pendente, verifica se a data dela já passou
      if (dataVencimento && (dataVencimento.includes("-") || stringVencimento.includes("/"))) {
        const separador = dataVencimento.includes("-") ? "-" : "/";
        const partes = dataVencimento.split(separador);
        
        let ano, mes, dia;
        if (separador === "-") {
          [ano, mes, dia] = partes;
        } else {
          [dia, mes, ano] = partes;
        }

        const vencimento = new Date(ano, mes - 1, dia);
        vencimento.setHours(0, 0, 0, 0);

        // Se a data de hoje passou do vencimento da parcela pendente
        if (dataAtual > vencimento) {
          temDebitoAtrasado = true;
        }
      }
    }
  });

  const formatador = new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  });

  const elTotal = document.getElementById("total-estatico");
  const elSaldo = document.getElementById("saldo-dinamico");
  const elMensagem = document.getElementById("mensagem-debitos"); 

  if (elTotal) elTotal.innerText = formatador.format(totalMes);
  if (elSaldo) elSaldo.innerText = formatador.format(saldoDevedor);

  // Exibe ou limpa o alerta
  if (elMensagem) {
    if (temDebitoAtrasado) {
      elMensagem.innerHTML = `
        <div class="alert alert-danger" style="margin: 15px; padding: 15px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 12px; font-weight: bold;">
          ⚠️ Atenção: Existem débitos atrasados!
        </div>
      `;
    } else {
      elMensagem.innerHTML = "";
    }
  }
}
