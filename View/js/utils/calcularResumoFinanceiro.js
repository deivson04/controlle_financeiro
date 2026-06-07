export function calcularResumoFinanceiro() {
  let totalMes = 0; 
  let saldoDevedor = 0; 

  const cards = document.querySelectorAll(".despesa-card");

  cards.forEach((card) => {
    const valor = parseFloat(card.getAttribute("data-valor")) || 0;
    const pAtual = parseInt(card.getAttribute("data-p-atual")) || 0;
    const pPagas = parseInt(card.getAttribute("data-p-pagas")) || 0;

    totalMes += valor;

    // Lógica matemática idêntica à do seu PHP
    if (pAtual > pPagas) {
      saldoDevedor += valor;
    }
  });

  const formatador = new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  });

  const elTotal = document.getElementById("total-estatico");
  const elSaldo = document.getElementById("saldo-dinamico");

  if (elTotal) elTotal.innerText = formatador.format(totalMes);
  if (elSaldo) elSaldo.innerText = formatador.format(saldoDevedor);
}