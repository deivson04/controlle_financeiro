import { calcularResumoFinanceiro } from "../utils/calcularResumoFinanceiro.js";

export function calendario() {
  let dataCalendario = new Date();

  function atualizarTextoCalendario() {
    const displayMes = document.querySelector("#mes");
    if (!displayMes) return;

    const meses = [
      "Janeiro",
      "Fevereiro",
      "Março",
      "Abril",
      "Maio",
      "Junho",
      "Julho",
      "Agosto",
      "Setembro",
      "Outubro",
      "Novembro",
      "Dezembro",
    ];

    const mesTexto = meses[dataCalendario.getMonth()];
    const anoTexto = dataCalendario.getFullYear();
    displayMes.innerText = `${mesTexto} / ${anoTexto}`;
  }

  async function buscarDadosFiltrados() {
    const container = document.querySelector("#lista-despesas");
    if (!container) return;

    const m = dataCalendario.getMonth() + 1;
    const a = dataCalendario.getFullYear();

    container.style.opacity = "0.5";

    try {
      const response = await fetch(
        `Controller/ListarDespesas.php?mes=${m}&ano=${a}`,
      );
      const html = await response.text();
      container.innerHTML = html;

      // IMPORTANTE: Recalcula o financeiro após carregar novos cards
      if (typeof calcularResumoFinanceiro === "function") {
        calcularResumoFinanceiro();
      }
    } catch (error) {
      console.error("Erro ao buscar despesas:", error);
    } finally {
      container.style.opacity = "1";
    }
  }

  const btnPrev = document.querySelector("#prev");
  const btnNext = document.querySelector("#next");

  if (btnPrev && btnNext) {
    btnPrev.addEventListener("click", () => {
      dataCalendario.setMonth(dataCalendario.getMonth() - 1);
      atualizarTextoCalendario();
      buscarDadosFiltrados();
    });

    btnNext.addEventListener("click", () => {
      dataCalendario.setMonth(dataCalendario.getMonth() + 1);
      atualizarTextoCalendario();
      buscarDadosFiltrados();
    });
  }
  atualizarTextoCalendario();
  buscarDadosFiltrados();
}
