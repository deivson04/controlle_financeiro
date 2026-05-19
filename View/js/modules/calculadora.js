export function calculadora() {
  const calculadora = document.getElementById("calculadora");

  let expressao = "";

  if (!calculadora) return;

  const display = document.getElementById("display");

  calculadora.addEventListener("click", (e) => {
    const button = e.target;

    if (button.tagName !== "BUTTON") return;

    const value = button.dataset.value;
    const action = button.dataset.action;
    const operadores = ["+", "-", "*", "/", "%"];

    if (value) {
      const ultimoChar = expressao.slice(-1);
      const operadores = ["+", "-", "*", "/", "%"];

      if (value === ".") {
        const partes = expressao.split(/[\+\-\*\/]/);
        const ultimoNumero = partes[partes.length - 1];
        if (ultimoNumero.includes(".") || expressao === "") return;
      }

      if (operadores.includes(value)) {
        if (expressao === "") {
          return;
        }

        // Se o ultimo caracter ja for um operador, substitui pelo novo
        if (operadores.includes(ultimoChar)) {
          expressao = expressao.slice(0, -1) + value;
        } else {
          expressao += value;
        }
      } else {
        // se for numero adicionar normal

        expressao += value;
      }

      updateDisplay();
    }

    if (action === "clear") {
      clear();
    }

    if (action === "equals") {
      calculate();
    }
  });

  function calculate() {
    if (!expressao) return;

    fetch(`https://api.mathjs.org/v4/?expr=${encodeURIComponent(expressao)}`)
      .then((res) => res.text())
      .then((resultado) => {
        expressao = resultado;
        updateDisplay();
      })
      .catch(() => {
        display.value = "Erro";
      });
  }

  function clear() {
    expressao = "";
    updateDisplay();
  }

  function updateDisplay() {
    display.value = expressao || "0";
  }
}
