import { calcularResumoFinanceiro } from "../utils/calcularResumoFinanceiro.js";

export function statusDespesas() {
  document.addEventListener("click", (e) => {
    const badge = e.target.closest(".badge-status-clicavel");
    if (badge) {
      const card = badge.closest(".despesa-card");
      if (!card) return;

      const id = card.getAttribute("data-id");
      const pAtual = parseInt(card.getAttribute("data-p-atual")) || 0;
      const pPagasNoBanco = parseInt(card.getAttribute("data-p-pagas")) || 0;

      let novoStatusNumerico = pAtual <= pPagasNoBanco ? pAtual - 1 : pAtual;

      const dados = new FormData();
      dados.append("idDespesas", id);
      dados.append("status", novoStatusNumerico);

      fetch("Controller/UpdateDespesas.php", {
        method: "POST",
        body: dados,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status === "success") {
            card.setAttribute("data-p-pagas", novoStatusNumerico);

            const agoraEstaPago = pAtual <= novoStatusNumerico;

            const texto = agoraEstaPago ? "Pago" : "A Pagar";
            const icone = agoraEstaPago
              ? "bi-check-circle-fill"
              : "bi-clock-history";
            const corBg = agoraEstaPago ? "#d4edda" : "#fff3cd"; // Verde ou Amarelo
            const corTxt = agoraEstaPago ? "#155724" : "#856404";

            // 5. APLICA A MUDANÇA VISUAL (Sem recarregar a página)
            badge.innerHTML = `<i class="bi ${icone} me-1"></i> ${texto}`;
            badge.style.backgroundColor = corBg;
            badge.style.color = corTxt;

            if (typeof calcularResumoFinanceiro === "function") {
              calcularResumoFinanceiro();
            }
            //location.reload();
          } else {
            alert("Erro: " + data.msg);
          }
        })
        .catch((err) => console.error("Erro na requisição status"));
    }
  });

  function calcularResumoFinanceiro() {
    let totalMes = 0;
    let saldoDevedor = 0;
    const cards = document.querySelectorAll(".despesa-card");

    cards.forEach((card) => {
      const valor = parseFloat(card.getAttribute("data-valor")) || 0;
      const pAtual = parseInt(card.getAttribute("data-p-atual")) || 0;
      const pPagas = parseInt(card.getAttribute("data-p-pagas")) || 0;

      totalMes += valor;
      // Lógica baseada nos números das parcelas
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
  
  calcularResumoFinanceiro();


}
