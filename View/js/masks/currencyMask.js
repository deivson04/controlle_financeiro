export function currencyMask() {
  // Escutamos o evento de digitação no DOCUMENT inteiro
  document.addEventListener("input", (e) => {
    // Verifica se o elemento que disparou a digitação é o nosso input de valor
    if (e.target && e.target.id === "valorInput") {
      let value = e.target.value;

      // 1. Remove tudo que não for número
      value = value.replace(/\D/g, "");

      // Se o usuário apagar tudo, deixa o campo limpo
      if (!value) {
        e.target.value = "";
        return;
      }

      // 2. Transforma em centavos (divide por 100)
      value = (value / 100).toFixed(2);

      // 3. Formata para o padrão brasileiro (R$)
      e.target.value = new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
      }).format(value);
    }
  });
}