// Função para alternar a visibilidade de uma janela
function toggleWindow(window) {
  window.style.visibility =
    window.style.visibility === "visible" ? "hidden" : "visible";
}

// Função para configurar o evento de clique
function setupToggle(buttonId, windowClass) {
  const button = document.getElementById(buttonId);
  const window = document.querySelector(windowClass);

  if (button && window) {
    button.addEventListener("click", () => toggleWindow(window));
  }
}

// Seleciona os elementos relevantes
const userIcon = document.querySelector(".user-icon");
const menu = document.querySelector(".menu");
const menuOptions = document.querySelector(".menu-options");

// Variável para controlar o estado do menu
let isMenuVisible = false;

// Função para mostrar ou esconder o menu
function toggleMenu() {
  if (isMenuVisible) {
    // Esconder o menu
    menu.style.left = "-100%"; // Move o menu para fora da tela
    isMenuVisible = false;
  } else {
    // Mostrar o menu
    menu.style.left = "0"; // Traz o menu de volta para a tela
    isMenuVisible = true;
  }
}

// Adiciona o evento de clique ao ícone de usuário
userIcon.addEventListener("click", toggleMenu);

// Detecta o clique fora do menu para fechá-lo
document.addEventListener("click", function (event) {
  if (
    isMenuVisible &&
    !menu.contains(event.target) &&
    !userIcon.contains(event.target)
  ) {
    // Fecha o menu se clicar fora dele
    toggleMenu();
  }
});

// Configurar os eventos para cada botão
setupToggle("message-button", ".message-window");
setupToggle("notify-button", ".notify-window");
setupToggle("config-button", ".config-window");

// Fetch de API para buscar dados
const apiKey = "1bf24020d57f4e60ad1dfdee34d16ee9";
const url =
  "https://newsapi.org/v2/everything?" +
  "q=Apple&" +
  "from=2024-09-24&" +
  "sortBy=popularity&" +
  "apiKey=" +
  apiKey;
const req = new Request(url);

function prinJson(response) {
  response.json().then((data) => {
    console.log(data);
  });
}

// Faz a requisição e chama a função para exibir o JSON no console
fetch(req).then(prinJson);
