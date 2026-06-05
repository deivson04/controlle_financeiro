/* ==========================
BARRA DE SEARCH 
========================== */
export function search() {
  const search = document.querySelector("#searchb");
  const mensagemVazia = document.querySelector("#mensagem-vazia");

  if (search) {
    search.addEventListener("input", function () {
      const searchString = this.value.toLowerCase();
      const lista = document.querySelectorAll(".despesa-card");
      let encontrados = 0;

      //filtra os elementos

      lista.forEach((listas) => {
        const descricao = listas
          .querySelector("h6")
          .textContent.toLowerCase()
          .trim();

        //exibir ou ocutar

        if (descricao.includes(searchString)) {
          listas.style.display = "block";
          encontrados++;
        } else {
          listas.style.display = "none";
        }
      });

      if (encontrados === 0 && searchString !== "") {
        mensagemVazia.classList.remove("d-none");
        mensagemVazia.style.display = "block";
      } else {
        mensagemVazia.classList.add("d-none");
        mensagemVazia.style.display = "none";
      }
    });
  }

  /* * Melhora a experiência de campos de data no Mobile/Android.
   * Transforma o campo 'text' em 'date' ao focar, abre o calendário nativo
   * automaticamente e mantém o placeholder visível enquanto vazio.
   */
  document.addEventListener("focusin", (e) => {
    if (e.target.classList.contains("input-data-mobile")) {
      const el = e.target;
      el.type = "date";

      // O "pulo do gato" com delay para funcionar de primeira
      setTimeout(() => {
        try {
          el.showPicker();
        } catch (err) {
          el.click();
        }
      }, 150);
    }
  });

  document.addEventListener("focusout", (e) => {
    if (e.target.classList.contains("input-data-mobile")) {
      if (!e.target.value) {
        e.target.type = "text";
      }
    }
  });
}
