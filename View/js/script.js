document.addEventListener("DOMContentLoaded", () => {
  /* ==========================
       MENU (se existir)
    ========================== */
  const menuToggle = document.querySelector("#menuToggle");
  const sidebar = document.querySelector("#sidebar");
  const backdrop = document.querySelector("#backdrop");

  if (menuToggle && sidebar && backdrop) {
    menuToggle.addEventListener("click", () => {
      sidebar.classList.toggle("open-sidebar");
      backdrop.classList.toggle("show");
    });

    backdrop.addEventListener("click", () => {
      sidebar.classList.remove("open-sidebar");
      backdrop.classList.remove("show");
    });
  }

  /* ==========================
       VALIDAÇÃO DO FORMULÁRIO LD CLIENTE
       BANCO
    ========================== */
  const form = document.querySelector("#form");
  const formCadastro = document.querySelector("#formCadastro");
  const formRecupSenha = document.querySelector("#formRecupSenha");
  const formNovaSenha = document.querySelector("#formNovaSenha");
  const formAddDespesas = document.querySelector("#formAddDespesas");
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

  // VALIDAÇÃO DO CADASTRO

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
  }

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
  }

  //VALIDAÇÃO NOVA SENHA

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

  // VALIDAÇÃO ADICIONAR DESPESAS

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
          body: new FormData(formAddDespesas), // Usamos 'formNovaSenha' que já capturamos acima
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
        mensagemDiv.innerHTML =
          '<div class="alert alert-danger">Erro no servidor! Verifique a conexão com o banco.</div>';
      }
    });
  }

  // MASCARA DO CAMPO VALOR
  const campoValor = document.querySelector("#valorInput");

  if (campoValor) {
    campoValor.addEventListener("input", (e) => {
      let value = e.target.value;

      // Remove tudo que não for número
      value = value.replace(/\D/g, "");

      // Transforma em centavos (divide por 100)
      value = (value / 100).toFixed(2);

      // Formata para o padrão brasileiro (R$)
      if (value === "NaN" || value === "0.00") {
        e.target.value = "";
      } else {
        e.target.value = new Intl.NumberFormat("pt-BR", {
          style: "currency",
          currency: "BRL",
        }).format(value);
      }
    });
  }

  /* ==========================
       PARCELAMENTO
    ========================== */

  const radioAvista = document.querySelector("#flexRadioDefault1");
  const radioParcelado = document.querySelector("#flexRadioDefault2");
  const campoParcelas = document.querySelector("#campoParcelas");
  const quantParcelas = document.querySelector("#quantidadeParcelas");

  if (radioAvista && radioParcelado && campoParcelas && quantParcelas) {
    // Estado inicial
    campoParcelas.style.display = "none";
    quantParcelas.value = "";
    quantParcelas.disabled = true;

    radioParcelado.addEventListener("change", () => {
      campoParcelas.style.display = "block";
      quantParcelas.disabled = false;
      quantParcelas.focus();
    });

    radioAvista.addEventListener("change", () => {
      campoParcelas.style.display = "none";
      quantParcelas.value = "";
      quantParcelas.disabled = true;
    });
  }

  /* ==========================
       DELETE VIA AJAX
    ========================== */

  document.addEventListener("click", (e) => {
    const btn = e.target.closest(".btn-delete");

    if (btn) {
      e.preventDefault();
      const idDespesas = btn.getAttribute("data-id");
      const card = btn.closest(".despesa-card");

      if (confirm("Deseja excluir esta despesa?")) {
        fetch("Controller/DeletarDespesas.php", {
          method: "POST",
          headers: { "Content-Type": "application/x-www-form-urlencoded" },
          body: "idDespesas=" + encodeURIComponent(idDespesas),
        })
          .then((response) => response.text()) // Primeiro lemos como texto puro
          .then((text) => {
            try {
              const data = JSON.parse(text); // Tentamos converter para JSON
              if (data.status === "success") {
                card.style.opacity = "0";
                setTimeout(() => {
                  card.remove();
                  if (typeof calcularResumoFinanceiro === "function") {
                    calcularResumoFinanceiro();
                  }
                }, 400);
              } else {
                alert("Erro do PHP: " + data.message);
              }
            } catch (err) {
              // Se cair aqui, o PHP mandou algo que não é JSON (ex: um erro de SQL)
              alert("O PHP mandou um formato inválido: " + text);
            }
          })
          .catch((error) => alert("Erro na requisição: " + error.message));
      }
    }
  });

  /* ==========================
       UPDATE VIA AJAX
    ========================== */
  document.addEventListener("click", (e) => {
    // 1. LÓGICA PARA ABRIR O MODAL E BUSCAR DADOS
    const btnEdit = e.target.closest(".btn-edit");
    if (btnEdit) {
      const id = btnEdit.getAttribute("data-id");
      const container = document.getElementById("container-do-modal");

      // Abre o modal com loading
      container.innerHTML =
        '<div class="text-center p-4"><div class="spinner-border text-success"></div></div>';
      const meuModal = new bootstrap.Modal(
        document.getElementById("modalEditar"),
      );
      meuModal.show();

      // Busca o formulário
      fetch("Controller/GetUpdateDespesas.php?idDespesas=" + id)
        .then((res) => res.text())
        .then((html) => {
          // Inserimos o HTML no modal
          container.innerHTML = html;

          // --- AGORA selecionamos os elementos que acabaram de ser criados ---
          const radioAvista = container.querySelector("#radio1");
          const radioParcelado = container.querySelector("#radio2");
          const divParcelas = container.querySelector("#campoParcelas");
          const inputParcelas = container.querySelector("#quantidadeParcelas");

          // Lógica Inicial: Se já vier parcelado do banco, mostra o campo
          if (radioParcelado && radioParcelado.checked) {
            divParcelas.style.display = "block";
          }

          // Eventos de troca (Toggle)
          if (radioParcelado) {
            radioParcelado.addEventListener("change", () => {
              divParcelas.style.display = "block";
            });
          }

          if (radioAvista) {
            radioAvista.addEventListener("change", () => {
              divParcelas.style.display = "none";
              if (inputParcelas) inputParcelas.value = "1"; // Reseta para o padrão
            });
          }
        })
        .catch((err) => console.error("Erro ao carregar modal:", err));
    }

    // 2. LÓGICA PARA SALVAR AS ALTERAÇÕES
    const btnSalvar = e.target.closest("#btn-confirmar-update");
    if (btnSalvar) {
      e.preventDefault();
      //console.log("Iniciando salvamento...");

      const form = document.getElementById("form-edicao-despesa");
      if (!form) {
        //console.error("Formulário não encontrado!");
        return;
      }

      const dados = new FormData(form);

      fetch("Controller/UpdateDespesas.php", {
        method: "POST",
        body: dados,
      })
        .then(async (res) => {
          if (!res.ok) {
            const txt = await res.text();
            throw new Error(`Erro ${res.status}: ${txt.substring(0, 100)}`);
          }
          return res.json();
        })
        .then((data) => {
          if (data.status === "success") {
            alert("Atualizado com sucesso!");
            location.reload();
          } else {
            alert("Erro no Banco: " + (data.message || "Erro desconhecido"));
          }
        })
        .catch((err) => {
          alert("DETALHE DO ERRO: " + err.message);
          alert.error(err);
        });
    }
  });

  /* ==========================
       CALCULO DO VALOR E SALDO
    ========================== */

  function calcularResumoFinanceiro() {
    let totalMes = 0; // Vai somar absolutamente tudo
    let saldoDevedor = 0; // Vai somar apenas o que NÃO estiver como "pago"

    // 1. Seleciona todos os cards de despesa que estão na tela
    const cards = document.querySelectorAll(".despesa-card");

    cards.forEach((card) => {
      // 2. Captura os valores dos data-attributes que colocamos no HTML
      const valor = parseFloat(card.getAttribute("data-valor")) || 0;
      const status = card.getAttribute("data-status").trim().toLowerCase();

      // 3. Soma ao total geral (estático)
      totalMes += valor;

      // 4. Lógica do Saldo Dinâmico: só soma se o status não for 'pago'
      if (status !== "pago") {
        saldoDevedor += valor;
      }
    });

    // 5. Formata os números para o padrão de moeda brasileira (R$)
    const formatador = new Intl.NumberFormat("pt-BR", {
      style: "currency",
      currency: "BRL",
    });

    // 6. Atualiza os elementos que criamos no seu layout fora dos cards
    document.getElementById("total-estatico").innerText =
      formatador.format(totalMes);
    document.getElementById("saldo-dinamico").innerText =
      formatador.format(saldoDevedor);
  }

  // Executa a função assim que a página terminar de carregar
  calcularResumoFinanceiro();

  /* ==========================
       LOGICA DO MES E ANO (CALENDÁRIO)
    ========================== */

  let dataCalendario = new Date();

  function atualizarTextoCalendario() {
    const displayMes = document.querySelector("#mes");
    if (!displayMes) return;

    const meses = [
      "Janeiro",
      "Fevereiro",
      "Março",
      "Abril",
      "Maio",
      "Junho",
      "Julho",
      "Agosto",
      "Setembro",
      "Outubro",
      "Novembro",
      "Dezembro",
    ];

    const mesTexto = meses[dataCalendario.getMonth()];
    const anoTexto = dataCalendario.getFullYear();
    displayMes.innerText = `${mesTexto} / ${anoTexto}`;
  }

  async function buscarDadosFiltrados() {
    const container = document.querySelector("#lista-despesas");
    if (!container) return;

    const m = dataCalendario.getMonth() + 1;
    const a = dataCalendario.getFullYear();

    container.style.opacity = "0.5";

    try {
      const response = await fetch(
        `Controller/ListarDespesas.php?mes=${m}&ano=${a}`,
      );
      const html = await response.text();
      container.innerHTML = html;

      // IMPORTANTE: Recalcula o financeiro após carregar novos cards
      if (typeof calcularResumoFinanceiro === "function") {
        calcularResumoFinanceiro();
      }
    } catch (error) {
      console.error("Erro ao buscar despesas:", error);
    } finally {
      container.style.opacity = "1";
    }
  }

  const btnPrev = document.querySelector("#prev");
  const btnNext = document.querySelector("#next");

  if (btnPrev && btnNext) {
    btnPrev.addEventListener("click", () => {
      dataCalendario.setMonth(dataCalendario.getMonth() - 1);
      atualizarTextoCalendario();
      buscarDadosFiltrados();
    });

    btnNext.addEventListener("click", () => {
      dataCalendario.setMonth(dataCalendario.getMonth() + 1);
      atualizarTextoCalendario();
      buscarDadosFiltrados();
    });
  }

  /* ==========================
   DINAMICA DO STATUS (MARCAR PAGO)
========================== */
  document.addEventListener("click", (e) => {
    const badge = e.target.closest(".badge-status-clicavel");
    if (badge) {
      const card = badge.closest(".despesa-card");
      if (!card) return;

      const id = card.getAttribute("data-id");
      const pAtual = parseInt(card.getAttribute("data-p-atual")) || 0;
      const pPagasNoBanco = parseInt(card.getAttribute("data-p-pagas")) || 0;

      let novoStatusNumerico = pAtual <= pPagasNoBanco ? pAtual - 1 : pAtual;

      const dados = new FormData();
      dados.append("idDespesas", id);
      dados.append("status", novoStatusNumerico);

      fetch("Controller/UpdateDespesas.php", {
        method: "POST",
        body: dados,
      })
        .then((res) => res.json())
        .then((data) => {
          if (data.status === "success") {
            card.setAttribute("data-p-pagas", novoStatusNumerico);

            const agoraEstaPago = pAtual <= novoStatusNumerico;

            const texto = agoraEstaPago ? "Pago" : "A Pagar";
            const icone = agoraEstaPago
              ? "bi-check-circle-fill"
              : "bi-clock-history";
            const corBg = agoraEstaPago ? "#d4edda" : "#fff3cd"; // Verde ou Amarelo
            const corTxt = agoraEstaPago ? "#155724" : "#856404";

            // 5. APLICA A MUDANÇA VISUAL (Sem recarregar a página)
            badge.innerHTML = `<i class="bi ${icone} me-1"></i> ${texto}`;
            badge.style.backgroundColor = corBg;
            badge.style.color = corTxt;

            if (typeof calcularResumoFinanceiro === "function") {
              calcularResumoFinanceiro();
            }
            //location.reload();
          } else {
            alert("Erro: " + data.msg);
          }
        })
        .catch((err) => console.error("Erro na requisição status"));
    }
  });

  /* ==========================
       CALCULO FINANCEIRO
    ========================== */
  function calcularResumoFinanceiro() {
    let totalMes = 0;
    let saldoDevedor = 0;
    const cards = document.querySelectorAll(".despesa-card");

    cards.forEach((card) => {
      const valor = parseFloat(card.getAttribute("data-valor")) || 0;
      const pAtual = parseInt(card.getAttribute("data-p-atual")) || 0;
      const pPagas = parseInt(card.getAttribute("data-p-pagas")) || 0;

      totalMes += valor;
      // Lógica baseada nos números das parcelas
      if (pAtual > pPagas) {
        saldoDevedor += valor;
      }
    });

    const formatador = new Intl.NumberFormat("pt-BR", {
      style: "currency",
      currency: "BRL",
    });

    const elTotal = document.getElementById("total-estatico");
    const elSaldo = document.getElementById("saldo-dinamico");

    if (elTotal) elTotal.innerText = formatador.format(totalMes);
    if (elSaldo) elSaldo.innerText = formatador.format(saldoDevedor);
  }

  // Inicialização
  atualizarTextoCalendario();
  calcularResumoFinanceiro();
  buscarDadosFiltrados();

  /* ==========================
BARRA DE SEARCH 
========================== */
  const search = document.querySelector("#searchb");
  const mensagemVazia = document.querySelector("#mensagem-vazia");
  
  if (search) {
    search.addEventListener("input", function () {
      const searchString = this.value.toLowerCase();
      const lista = document.querySelectorAll(".despesa-card");
      let encontrados = 0;

      //filtra os elementos

      lista.forEach((listas) => {
        const descricao = listas
          .querySelector("h6")
          .textContent.toLowerCase()
          .trim();

        //exibir ou ocutar

        if (descricao.includes(searchString)) {
          listas.style.display = "block";
          encontrados++;
        } else {
          listas.style.display = "none";
        }
      });

      if (encontrados === 0 && searchString !== "") {
        mensagemVazia.classList.remove("d-none");
        mensagemVazia.style.display = "block";
        
      } else {
        mensagemVazia.classList.add("d-none");
        mensagemVazia.style.display = "none";
      }
    });
  }

  /* * Melhora a experiência de campos de data no Mobile/Android.
   * Transforma o campo 'text' em 'date' ao focar, abre o calendário nativo
   * automaticamente e mantém o placeholder visível enquanto vazio.
   */
  document.addEventListener("focusin", (e) => {
    if (e.target.classList.contains("input-data-mobile")) {
      const el = e.target;
      el.type = "date";

      // O "pulo do gato" com delay para funcionar de primeira
      setTimeout(() => {
        try {
          el.showPicker();
        } catch (err) {
          el.click();
        }
      }, 150);
    }
  });

  document.addEventListener("focusout", (e) => {
    if (e.target.classList.contains("input-data-mobile")) {
      if (!e.target.value) {
        e.target.type = "text";
      }
    }
  });

  // Calculadora
  const calculadora = document.getElementById("calculadora");

let expressao = "";

if (!calculadora) return;

const display = document.getElementById("display");

calculadora.addEventListener("click", (e) => {
  const button = e.target;

  if (button.tagName !== "BUTTON") return;

  const value = button.dataset.value;
  const action = button.dataset.action;
  const operadores = ['+', '-', '*', '/', '%'];

  if (value) {
    const ultimoChar = expressao.slice(-1);
    const operadores = ['+', '-', '*', '/', '%'];
    
    if (value === ".") {
        const partes = expressao.split(/[\+\-\*\/]/);
        const ultimoNumero = partes[partes.length - 1];
        if (ultimoNumero.includes(".") || expressao === "") return;
    }
    
  
  if (operadores.includes(value)) {
      
     if (expressao === '') {
         return;
     }
     
     // Se o ultimo caracter ja for um operador, substitui pelo novo
     if (operadores.includes(ultimoChar)) {
         expressao = expressao.slice(0, -1) + value;
     } else {
         expressao += value;
     }
    } else {
        // se for numero adicionar normal
        
        expressao += value;
    }
    
    updateDisplay();
  }

  if (action === "clear") {
    clear();
  }

  if (action === "equals") {
    calculate();
  }
});

function calculate() {
  if (!expressao) return;

  fetch(`https://api.mathjs.org/v4/?expr=${encodeURIComponent(expressao)}`)
    .then(res => res.text())
    .then(resultado => {
      expressao = resultado;
      updateDisplay();
    })
    .catch(() => {
      display.value = "Erro";
    });
}

function clear() {
  expressao = "";
  updateDisplay();
}

function updateDisplay() {
  display.value = expressao || "0";
}
});
