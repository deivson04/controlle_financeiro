export function updateDespesas() {
  document.addEventListener("click", (e) => {
    // 1. LÓGICA PARA ABRIR O MODAL E BUSCAR DADOS
    const btnEdit = e.target.closest(".btn-edit");
    if (btnEdit) {
      const id = btnEdit.getAttribute("data-id");
      const container = document.getElementById("container-do-modal");

      // Abre o modal com loading
      container.innerHTML =
        '<div class="text-center p-4"><div class="spinner-border text-success"></div></div>';
      const meuModal = new bootstrap.Modal(
        document.getElementById("modalEditar"),
      );
      meuModal.show();

      // Busca o formulário
      fetch("Controller/GetUpdateDespesas.php?idDespesas=" + id)
        .then((res) => res.text())
        .then((html) => {
          // Inserimos o HTML no modal
          container.innerHTML = html;

          // --- AGORA selecionamos os elementos que acabaram de ser criados ---
          const radioAvista = container.querySelector("#radio1");
          const radioParcelado = container.querySelector("#radio2");
          const divParcelas = container.querySelector("#campoParcelas");
          const inputParcelas = container.querySelector("#quantidadeParcelas");

          // Lógica Inicial: Se já vier parcelado do banco, mostra o campo
          if (radioParcelado && radioParcelado.checked) {
            divParcelas.style.display = "block";
          }

          // Eventos de troca (Toggle)
          if (radioParcelado) {
            radioParcelado.addEventListener("change", () => {
              divParcelas.style.display = "block";
            });
          }

          if (radioAvista) {
            radioAvista.addEventListener("change", () => {
              divParcelas.style.display = "none";
              if (inputParcelas) inputParcelas.value = "1"; // Reseta para o padrão
            });
          }
        })
        .catch((err) => console.error("Erro ao carregar modal:", err));
    }

    // 2. LÓGICA PARA SALVAR AS ALTERAÇÕES
    const btnSalvar = e.target.closest("#btn-confirmar-update");
    if (btnSalvar) {
      e.preventDefault();
      //console.log("Iniciando salvamento...");

      const form = document.getElementById("form-edicao-despesa");
      if (!form) {
        //console.error("Formulário não encontrado!");
        return;
      }

      const dados = new FormData(form);

      fetch("Controller/UpdateDespesas.php", {
        method: "POST",
        body: dados,
      })
        .then(async (res) => {
          if (!res.ok) {
            const txt = await res.text();
            throw new Error(`Erro ${res.status}: ${txt.substring(0, 100)}`);
          }
          return res.json();
        })
        .then((data) => {
          if (data.status === "success") {
            alert("Atualizado com sucesso!");
            location.reload();
          } else {
            alert("Erro no Banco: " + (data.message || "Erro desconhecido"));
          }
        })
        .catch((err) => {
          alert("DETALHE DO ERRO: " + err.message);
          alert.error(err);
        });
    }
  });
}
