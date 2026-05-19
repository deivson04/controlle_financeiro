export function despesasForm() {
  const formAddDespesas = document.querySelector("#formAddDespesas");
  const mensagemDiv = document.querySelector("#mensagem");

  if (formAddDespesas && mensagemDiv) {
    formAddDespesas.addEventListener("submit", async (e) => {
      // 1. Impede o envio padrão do formulário
      e.preventDefault();

      // --- VALIDAÇÃO LADO CLIENTE (Visual) ---
      const camposObrigatorios = formAddDespesas.querySelectorAll(
        '[data-required="true"]',
      );
      let valido = true;
      mensagemDiv.innerHTML = "";

      camposObrigatorios.forEach((input) => {
        input.classList.remove("is-invalid");
        if (!input.value.trim()) {
          input.classList.add("is-invalid");
          valido = false;
        }
      });

      if (!valido) {
        mensagemDiv.innerHTML =
          '<div class="alert alert-danger">Preencha todos os campos obrigatórios.</div>';
        return; // Para aqui e não faz o fetch
      }

      try {
        mensagemDiv.innerHTML =
          '<div class="alert alert-info">Adicionando...</div>';

        const response = await fetch(`${BASE_URL}/Controller/AddDespesas.php`, {
          method: "POST",
          body: new FormData(formAddDespesas), // Usamos 'formData' que já capturamos acima
          headers: {
            Accept: "application/json",
          },
        });

        // Lê a resposta do PHP
        const data = await response.json();
        //let data;
        //try {
        // data = JSON.parse(textData);
        //} catch (e) {
        // Se cair aqui, o PHP mandou um erro de sintaxe (como aquele do '->')
        //alert("ERRO REAL DO PHP:\n" + textData);
        //  console.error("Conteúdo inválido recebido do PHP:", textData);
        // throw new Error("O servidor retornou um formato inválido. Verifique os logs do PHP.");
        // }
        if (data.status === "success") {
          mensagemDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;

          // Limpa e Redireciona após um pequeno delay para o usuário ver a mensagem
          setTimeout(() => {
            formAddDespesas.reset();
            window.location.href = `${BASE_URL}/` + data.redirect;
          }, 1000);
        } else if (data.status === "error") {
          mensagemDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;

          setTimeout(() => {
            mensagemDiv.innerHTML = "";
          }, 3000);

          // Foca no campo que o PHP indicou (se houver)
          if (data.field) {
            document.getElementById(data.field)?.focus();
            document.getElementById(data.field)?.classList.add("is-invalid");
          }
        }
      } catch (error) {
        console.error("Error:", error);
        // alert("Ocorreu um problema: " + error.message);
        mensagemDiv.innerHTML =
          '<div class="alert alert-danger">Erro no servidor! Verifique a conexão com o banco.</div>';
      }
    });
  }
}
