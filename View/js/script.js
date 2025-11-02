
document.getElementById('open_btn').addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('open-sidebar');
});


//validacao dos inputs de login e cadastro

    document.addEventListener('DOMContentLoaded', () => {
  
    const form = document.querySelector('#form');
    const mensagemDiv = document.querySelector('#mensagem');
  
   if (!form || !mensagemDiv) return;
   
   form.addEventListener('submit', (e) => {
       e.preventDefault();
       
       const camposObrigatorios = form.querySelectorAll('input[data-required="true"]');
       
       let todosPreenchidos = true;

        // Limpa mensagens e validação antiga
        mensagemDiv.innerHTML = '';
        
    
        for (const input of camposObrigatorios) {
            if (input.value.trim() === '') {
                todosPreenchidos = false;
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }
        }
        
        // 3. Feedback e Envio
        if (!todosPreenchidos) {
            mensagemDiv.innerHTML = '<div class="alert alert-danger">Por favor, preencha todos os campos obrigatórios!</div>';
            return; // Interrompe a execução
        }
        
        const senhaInput = form.querySelector('#senha');
    const senha = senhaInput.value.trim();

    if (senha.length < 6) {
      senhaInput.classList.add('is-invalid');
      mensagemDiv.innerHTML = `
        <div class="alert alert-danger text-center" role="alert">
          A senha deve ter no mínimo 6 caracteres.
        </div>`;
      return;
    }
        mensagemDiv.innerHTML = `<div class="alert alert-success">validando...</div>`;
        
        setTimeout(() => {
            form.submit(); // Envia o formulário após o delay
        }, 800);
   });

});


