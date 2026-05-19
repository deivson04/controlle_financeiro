export function novaSenhaForm() {
  const formNovaSenha = document.querySelector("#formNovaSenha");
  const senha = document.querySelector("#senhaCadastro");
  const mensagemDiv = document.querySelector("#mensagem");

  if (formNovaSenha && mensagemDiv) {
    formNovaSenha.addEventListener("submit", async (e) => {
      // 1. Impede o envio padrão do formulário
      e.preventDefault();

      // --- VALIDAÇÃO LADO CLIENTE (Visual) ---
      const camposObrigatorios = formNovaSenha.querySelectorAll(
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
          '<div class="alert alert-danger">Preencha o campo obrigatórios.</div>';
        return; // Para aqui e não faz o fetch
      }

      if (senha && senha.value.trim().length < 6) {
        mensagemDiv.innerHTML =
          '<div class="alert alert-danger">A senha deve ter pelo menos 6 caracteres.</div>';
        senha.classList.add("is-invalid");
        return; // Para aqui e não faz o fetch
      }

      try {
        mensagemDiv.innerHTML =
          '<div class="alert alert-info">Validando...</div>';

        const response = await fetch(`${BASE_URL}/Controller/NovaSenha.php`, {
          method: "POST",
          body: new FormData(formNovaSenha), // Usamos 'formNovaSenha' que já capturamos acima
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
            formNovaSenha.reset();
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
        mensagemDiv.innerHTML =
          '<div class="alert alert-danger">Erro no servidor! Verifique a conexão com o banco.</div>';
      }
    });
  }
}
