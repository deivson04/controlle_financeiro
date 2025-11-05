document.addEventListener('DOMContentLoaded', () => {

    // Lógica do Menu Lateral (Sidebar)
    const open_btn = document.querySelector('#open_btn');
    const sidebar = document.querySelector('#sidebar');

    if (open_btn && sidebar) {

        open_btn.addEventListener('click', () => {
            sidebar.classList.toggle('open-sidebar');
        });
    }

    // Lógica de Validação do Formulário de Cadastro
    const form = document.querySelector('#form');
    const mensagemDiv = document.querySelector('#mensagem');

    if (!form || !mensagemDiv) return;

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const camposObrigatorios = form.querySelectorAll('input[data-required="true"]');
        let todosPreenchidos = true;

        mensagemDiv.innerHTML = ''; // Limpa mensagens anteriores

        // --- 1. VALIDAÇÃO DE CAMPOS VAZIOS ---
        for (const input of camposObrigatorios) {
            input.classList.remove('is-invalid');
            if (input.value.trim() === '') {
                todosPreenchidos = false;
                input.classList.add('is-invalid');
            }
        }

        if (!todosPreenchidos) {
            mensagemDiv.innerHTML = '<div class="alert alert-danger">Por favor, preencha todos os campos obrigatórios! *</div>';
            return;
        }

        // --- 2. VALIDAÇÃO ESPECÍFICA DA SENHA (Mínimo 6 caracteres) ---
        const senhaInput = document.querySelector('#senhaCadastro');

        if (senhaInput) {
            const senhaValor = senhaInput.value.trim();

            if (senhaValor.length < 6) {

                // Adiciona classe de erro na senha e exibe a mensagem específica
                senhaInput.classList.add('is-invalid');
                mensagemDiv.innerHTML = '<div class="alert alert-danger">A senha deve ter no mínimo 6 caracteres.</div>';
                return; // Interrompe o envio
            }
        }

        mensagemDiv.innerHTML = `<div class="alert alert-success"> validado...</div>`;

        setTimeout(() => {
            form.submit(); // Envia o formulário
        }, 800);
    });
});