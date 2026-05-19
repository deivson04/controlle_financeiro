export function parcelamentoForm() {
  const radioAvista = document.querySelector("#flexRadioDefault1");
  const radioFixo = document.querySelector("#flexRadioDefault3");
  const radioParcelado = document.querySelector("#flexRadioDefault2");
  const campoParcelas = document.querySelector("#campoParcelas");
  const quantParcelas = document.querySelector("#quantidadeParcelas");

  if (
    radioAvista &&
    radioFixo &&
    radioParcelado &&
    campoParcelas &&
    quantParcelas
  ) {
    // Estado inicial
    campoParcelas.style.display = "none";
    quantParcelas.value = "";
    quantParcelas.disabled = true;

    radioParcelado.addEventListener("change", () => {
      campoParcelas.style.display = "block";
      quantParcelas.disabled = false;
      quantParcelas.focus();
    });

    radioAvista.addEventListener("change", () => {
      campoParcelas.style.display = "none";
      quantParcelas.value = "";
      quantParcelas.disabled = true;
    });

    radioFixo.addEventListener("change", () => {
      campoParcelas.style.display = "none";
      quantParcelas.value = "";
      quantParcelas.disabled = true;
    });
  }
}
