export function cadastroForm() {
  const formCadastro = document.querySelector("#formCadastro");
  const senha = document.querySelector("#senhaCadastro");
  const mensagemDiv = document.querySelector("#mensagem");
  const senhaInput = document.querySelector("#senhaCad");
  const toggle = document.querySelector("#toggleIcon");

  if (formCadastro && mensagemDiv) {
    formCadastro.addEventListener("submit", async (e) => {
      // 1. Impede o envio padrão do formulário
      e.preventDefault();

      // --- VALIDAÇÃO LADO CLIENTE (Visual) ---
      const camposObrigatorios = formCadastro.querySelectorAll(
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
          '<div class="alert alert-info">Cadastrando...</div>';

        const response = await fetch(`${BASE_URL}/Controller/Cadastro.php`, {
          method: "POST",
          body: new FormData(formCadastro), // Usamos 'formCadastro' que já capturamos acima
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
            formCadastro.reset();
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
