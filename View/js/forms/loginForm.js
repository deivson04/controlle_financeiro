export function loginForm() {
  const form = document.querySelector("#form");
  const senha = document.querySelector("#senhaCadastro");
  const mensagemDiv = document.querySelector("#mensagem");

  if (form && mensagemDiv) {
    form.addEventListener("submit", async (e) => {
      // 1. Impede o envio padrão do formulário
      e.preventDefault();

      // --- VALIDAÇÃO LADO CLIENTE (Visual) ---
      const camposObrigatorios = form.querySelectorAll(
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

      if (senha && senha.value.trim().length < 6) {
        mensagemDiv.innerHTML =
          '<div class="alert alert-danger">A senha deve ter pelo menos 6 caracteres.</div>';
        senha.classList.add("is-invalid");
        return; // Para aqui e não faz o fetch
      }

      // --- VALIDAÇÃO LADO SERVIDOR (Fetch/PHP) ---
      // Se chegou aqui, os campos estão preenchidos corretamente
      try {
        mensagemDiv.innerHTML =
          '<div class="alert alert-info">Verificando dados...</div>';

        const response = await fetch(`${BASE_URL}/Controller/Dashboard.php`, {
          method: "POST",
          body: new FormData(form), // Usamos 'form' que já capturamos acima
          headers: {
            Accept: "application/json",
          },
        });

        // Lê a resposta do PHP
        const data = await response.json();

        if (data.status === "success") {
          mensagemDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;

          // Limpa e Redireciona após um pequeno delay para o usuário ver a mensagem
          setTimeout(() => {
            form.reset();
            window.location.href = `${BASE_URL}/` + data.redirect;
          }, 1000);
        } else if (data.status === "error") {
          mensagemDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;

          // Foca no campo que o PHP indicou (se houver)
          if (data.field) {
            document.getElementById(data.field)?.focus();
            document.getElementById(data.field)?.classList.add("is-invalid");
          }
        }
      } catch (error) {
        console.error("Error:", error);
        mensagemDiv.innerHTML =
          '<div class="alert alert-danger">Erro no servidor! Verifique a conexão com o banco.</div>';
      }
    });
  }
}
