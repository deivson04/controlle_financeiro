export function recuperarSenhaForm() {
  const formRecupSenha = document.querySelector("#formRecupSenha");
  const mensagemDiv = document.querySelector("#mensagem");
  const senhaInput = document.querySelector("#senha");
  const toggle = document.querySelector("#toggleIcon");

  // VALIDAÇÃO DO RECUPERAR SENHA

  if (formRecupSenha && mensagemDiv) {
    formRecupSenha.addEventListener("submit", async (e) => {
      // 1. Impede o envio padrão do formulário
      e.preventDefault();

      // --- VALIDAÇÃO LADO CLIENTE (Visual) ---
      const camposObrigatorios = formRecupSenha.querySelectorAll(
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

      try {
        mensagemDiv.innerHTML =
          '<div class="alert alert-info">Validando...</div>';

        const response = await fetch(
          `${BASE_URL}/Controller/RecuperarSenha.php`,
          {
            method: "POST",
            body: new FormData(formRecupSenha), // Usamos 'formRecupSenha' que já capturamos acima
            headers: {
              Accept: "application/json",
            },
          },
        );

        // Lê a resposta do PHP
        const data = await response.json();

        if (data.status === "success") {
          mensagemDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;

          // Limpa e Redireciona após um pequeno delay para o usuário ver a mensagem
          setTimeout(() => {
            formRecupSenha.reset();
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
        // logica do olho da senha
    toggle.addEventListener('click', () => {
    
    const tipoAtual = senhaInput.getAttribute('type');
    const novoTipo = tipoAtual === 'password' ? 'text' : 'password';
    senhaInput.setAttribute('type', novoTipo);
    
    // 2. Alterna as classes do Bootstrap Icons (olho aberto / olho fechado)
    if (senhaInput.getAttribute('type') === 'text') {
    // Mantém as classes do Bootstrap para o ícone continuar centralizado na direita
    toggle.className = 'bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3';
} else {
    
    toggle.className = 'bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3';
 }

  });
 
  }
}
