import { calcularResumoFinanceiro } from "../utils/calcularResumoFinanceiro.js";

export function deleteDespesas() {
  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-delete");

    if (btn) {
      e.preventDefault();
      const idDespesas = btn.getAttribute("data-id");
      const card = btn.closest(".despesa-card");

      if (confirm("Deseja excluir esta despesa?")) {
        fetch("Controller/DeletarDespesas.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "idDespesas=" + encodeURIComponent(idDespesas),
        })
          .then((response) => response.text()) // Primeiro lemos como texto puro
          .then((text) => {
            try {
              const data = JSON.parse(text); // Tentamos converter para JSON
              if (data.status === "success") {
                card.style.opacity = "0";
                setTimeout(() => {
                  card.remove();
                  if (typeof calcularResumoFinanceiro === "function") {
                    calcularResumoFinanceiro();
                  }
                }, 400);
              } else {
                alert("Erro do PHP: " + data.message);
              }
            } catch (err) {
              // Se cair aqui, o PHP mandou algo que não é JSON (ex: um erro de SQL)
              alert("O PHP mandou um formato inválido: " + text);
            }
          })
          .catch((error) => alert("Erro na requisição: " + error.message));
      }
    }
  });
}
