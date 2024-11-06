// Validação do username
function validarUsername() {
  const username = document.getElementById("username").value.trim();

  if (username.length < 3) {
    mostrarErro("username", "O nome de usuário deve ter pelo menos 3 caracteres");
    return false;
  }

  removerErro("username");
  return true;
}

// Validação da senha
function validarSenha() {
  const senha = document.getElementById("password").value;

  if (senha.length < 8) {
    mostrarErro("password", "A senha deve ter pelo menos 8 caracteres");
    return false;
  }

  removerErro("password");
  return true;
}

// Função para mostrar mensagens de erro
function mostrarErro(inputId, mensagem) {
  const input = document.getElementById(inputId);
  const erroExistente = input.parentElement.querySelector(".erro-mensagem");

  if (!erroExistente) {
    const erro = document.createElement("div");
    erro.className = "erro-mensagem";
    erro.textContent = mensagem;
    input.parentElement.appendChild(erro);
  }

  input.classList.add("input-erro");
}

// Função para remover mensagens de erro
function removerErro(inputId) {
  const input = document.getElementById(inputId);
  const erro = input.parentElement.querySelector(".erro-mensagem");

  if (erro) {
    erro.remove();
  }
  input.classList.remove("input-erro");
}

// Função principal para validar o formulário
function validarFormulario(event) {
  event.preventDefault();

  const usernameValido = validarUsername();
  const senhaValida = validarSenha();

  if (usernameValido && senhaValida) {
    // Aqui você pode adicionar a lógica de autenticação
    const formData = {
      username: document.getElementById("username").value.trim(),
      password: document.getElementById("password").value,
    };

    // Simulação de login (substitua por sua lógica de autenticação real)
    console.log("Tentativa de login:", formData);
    alert("Login realizado com sucesso!");
    // Redirecionar para página principal após login
    // window.location.href = '/pagina-principal';
  }
}

// Inicialização quando o DOM estiver carregado
document.addEventListener("DOMContentLoaded", function () {
  const form = document.querySelector(".login-form");

  // Adiciona validação ao enviar o formulário
  form.addEventListener("submit", validarFormulario);

  // Validação em tempo real
  const username = document.getElementById("username");
  const password = document.getElementById("password");

  username.addEventListener("blur", validarUsername);
  password.addEventListener("blur", validarSenha);

  // Limpar erros quando o usuário começa a digitar
  username.addEventListener("input", () => removerErro("username"));
  password.addEventListener("input", () => removerErro("password"));
});
