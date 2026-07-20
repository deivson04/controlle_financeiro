import { calcularResumoFinanceiro } from "../utils/calcularResumoFinanceiro.js";

export function statusDespesas() {
  // ESCUTADOR ORIGINAL DO STATUS (Mudar para Pago/A Pagar)
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
            const icone = agoraEstaPago ? "bi-check-circle-fill" : "bi-clock-history";
            const corBg = agoraEstaPago ? "#d4edda" : "#fff3cd"; 
            const corTxt = agoraEstaPago ? "#155724" : "#856404";

            badge.innerHTML = `<i class="bi ${icone} me-1"></i> ${texto}`;
            badge.style.backgroundColor = corBg;
            badge.style.color = corTxt;

            if (typeof calcularResumoFinanceiro === "function") {
              calcularResumoFinanceiro();
            }
          } else {
            alert("Erro: " + data.msg);
          }
        })
        .catch((err) => console.error("Erro na requisição status"));
    }

  });

  calcularResumoFinanceiro();
}