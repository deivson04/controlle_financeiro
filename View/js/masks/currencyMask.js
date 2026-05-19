export function currencyMask() {
  const campoValor = document.querySelector("#valorInput");

  if (campoValor) {
    campoValor.addEventListener("input", (e) => {
      let value = e.target.value;

      // Remove tudo que não for número
      value = value.replace(/\D/g, "");

      // Transforma em centavos (divide por 100)
      value = (value / 100).toFixed(2);

      // Formata para o padrão brasileiro (R$)
      if (value === "NaN" || value === "0.00") {
        e.target.value = "";
      } else {
        e.target.value = new Intl.NumberFormat("pt-BR", {
          style: "currency",
          currency: "BRL",
        }).format(value);
      }
    });
  }
}
