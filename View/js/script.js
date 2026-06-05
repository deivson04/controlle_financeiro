const page = document.body.dataset.page;

switch (page) {
  case "index": 
    import("./pages/index.js")
    break;

  case "login":
    import("./pages/login.js");
    break;

  case "cadastro":
    import("./pages/cadastro.js");
    break;

  case "recuperarSenha":
    import("./pages/recuperarSenha.js");
    break;
  
  case "novaSenha":
    import("./pages/novaSenha.js");
    break;

  case "dashboard":
    import("./pages/dashboard.js");
    break;

  case "despesas":
    import("./pages/despesas.js");
    break;
}