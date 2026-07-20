export function calcularResumoFinanceiro() {
  let totalMes = 0; 
  let saldoDevedor = 0; 
  let temDebitoAtrasado = false;

  const cards = document.querySelectorAll(".despesa-card");

  const dataAtual = new Date();
  dataAtual.setHours(0, 0, 0, 0);

  cards.forEach((card) => {
    const valor = parseFloat(card.getAttribute("data-valor")) || 0;
    const pAtual = parseInt(card.getAttribute("data-p-atual")) || 0; 
    const pPagas = parseInt(card.getAttribute("data-p-pagas")) || 0;
    const dataVencimento = card.getAttribute("data-vencimento");

    totalMes += valor;

    if (pAtual > pPagas) {
      saldoDevedor += valor;

      if (dataVencimento && (dataVencimento.includes("-") || dataVencimento.includes("/"))) {
        const separador = dataVencimento.includes("-") ? "-" : "/";
        const partes = dataVencimento.split(separador);

        let ano, mes, dia;
        if (separador === "-") {
          [ano, mes, dia] = partes;
        } else {
          [dia, mes, ano] = partes;
        }

        // 1. Cria a data base do cadastro da despesa
        const vencimento = new Date(ano, mes - 1, dia);
        
        // 🌟 A MÁGICA AQUI: Se for a 2ª ou 3ª parcela, o JS soma os meses dinamicamente!
        // Se pAtual for 2, ele soma (2 - 1) = 1 mês na data original. O dia 14/07 vira 14/08 automaticamente!
        if (pAtual > 1) {
          vencimento.setMonth(vencimento.getMonth() + (pAtual - 1));
        }
        
        vencimento.setHours(0, 0, 0, 0);

        // Agora sim a comparação com o mês futuro vai dar certinho!
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