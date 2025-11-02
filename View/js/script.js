
document.getElementById('open_btn').addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('open-sidebar');
});


//validacao dos inputs de login e cadastro

    const nomeInput = document.querySelector('#nome');
    const emailInput = document.querySelector('#email');
    const senhaInput = document.querySelector('#senha');
    const mensagemDiv = document.querySelector('#email');
    const botao = document.querySelector('#btnEnviar');
    const form = document.querySelector('#form');

    botao.addEventListener('click', (e) => {
    e.preventDefault();
    let nome = nomeInput.value;
    let email = emailInput.value;
    let senha = senhaInput.value;
    
    if (nome === '' || email === '' || senha === '') {
        
        mensagemDiv.innerHTML = '<div class="alert alert-danger">Por favor, preencha todos os campos!</div>';
         return;
    }
    
    mensagemDiv.innerHTML = '<div class="alert alert-success">Login validado, entrando...</div>';
      setTimeout(() => {
        form.submit();
    }, 800);
});


