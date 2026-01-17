document.addEventListener('DOMContentLoaded', () => {

    /* ==========================
       MENU (se existir)
    ========================== */
    const menuToggle = document.querySelector('#menuToggle');
    const sidebar = document.querySelector('#sidebar');
    const backdrop = document.querySelector('#backdrop');

    if (menuToggle && sidebar && backdrop) {
        menuToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open-sidebar');
            backdrop.classList.toggle('show');
        });

        backdrop.addEventListener('click', () => {
            sidebar.classList.remove('open-sidebar');
            backdrop.classList.remove('show');
        });
    }

    /* ==========================
       VALIDAÇÃO DO FORMULÁRIO
    ========================== */
    const form = document.querySelector('#form');
    const senha = document.querySelector('#senhaCadastro');
    const mensagemDiv = document.querySelector('#mensagem');

    if (form && mensagemDiv) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            const camposObrigatorios = form.querySelectorAll('[data-required="true"]');
            let valido = true;
            mensagemDiv.innerHTML = '';

            camposObrigatorios.forEach(input => {
                input.classList.remove('is-invalid');

                if (!input.value.trim()) {
                    input.classList.add('is-invalid');
                    valido = false;
                }
            });

            if (!valido) {
                mensagemDiv.innerHTML =
                    '<div class="alert alert-danger">Preencha todos os campos obrigatórios.</div>';
                return;
            }

            if (senha && senha.value.trim().length < 6) {
                mensagemDiv.innerHTML =
                    '<div class="alert alert-danger">A senha deve ter pelo menos 6 caracteres.</div>';
                senha.classList.add('is-invalid');
                valido = false;
                return;
            }

            mensagemDiv.innerHTML =
                '<div class="alert alert-success">Formulário validado.</div>';

            setTimeout(() => form.submit(), 600);
        });
    }

    /* ==========================
       PARCELAMENTO
    ========================== */
    const radioAvista = document.querySelector('#flexRadioDefault1');
    const radioParcelado = document.querySelector('#flexRadioDefault2');
    const campoParcelas = document.querySelector('#campoParcelas');
    const quantParcelas = document.querySelector('#quantidadeParcelas');

    if (radioAvista && radioParcelado && campoParcelas && quantParcelas) {

        // Estado inicial
        campoParcelas.style.display = 'none';
        quantParcelas.value = '';
        quantParcelas.disabled = true;

        radioParcelado.addEventListener('change', () => {
            campoParcelas.style.display = 'block';
            quantParcelas.disabled = false;
            quantParcelas.focus();
        });

        radioAvista.addEventListener('change', () => {
            campoParcelas.style.display = 'none';
            quantParcelas.value = '';
            quantParcelas.disabled = true;
        });
    }
});
