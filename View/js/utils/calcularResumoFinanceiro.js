export function calcularResumoFinanceiro() {
  let totalMes = 0; // Vai somar absolutamente tudo
  let saldoDevedor = 0; // Vai somar apenas o que NÃO estiver como "pago"

  // 1. Seleciona todos os cards de despesa que estão na tela
  const cards = document.querySelectorAll(".despesa-card");

  cards.forEach((card) => {
    // 2. Captura os valores dos data-attributes que colocamos no HTML
    const valor = parseFloat(card.getAttribute("data-valor")) || 0;
    const status = card.getAttribute("data-status").trim().toLowerCase();

    // 3. Soma ao total geral (estático)
    totalMes += valor;

    // 4. Lógica do Saldo Dinâmico: só soma se o status não for 'pago'
    if (status !== "pago") {
      saldoDevedor += valor;
    }
  });

  // 5. Formata os números para o padrão de moeda brasileira (R$)
  const formatador = new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  });

  // 6. Atualiza os elementos que criamos no seu layout fora dos cards
  document.getElementById("total-estatico").innerText =
    formatador.format(totalMes);
  document.getElementById("saldo-dinamico").innerText =
    formatador.format(saldoDevedor);
    
    // Executa a função assim que a página terminar de carregar
    calcularResumoFinanceiro();
}
