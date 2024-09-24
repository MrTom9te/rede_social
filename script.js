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

// Configurar os eventos para cada botão
setupToggle("message-button", ".message-window");
setupToggle("notify-button", ".notify-window");
setupToggle("config-button", ".config-window");

// tentadno usar uma api
const apiKey = "1bf24020d57f4e60ad1dfdee34d16ee9";
const url =
  "https://newsapi.org/v2/everything?" +
  "q=Apple&" +
  "from=2024-09-24&" +
  "sortBy=popularity&" +
  "apiKey=1bf24020d57f4e60ad1dfdee34d16ee9";
const req = new Request(url);

function prinJson(response) {
  console.log(response.json);
}

fetch(req).then(prinJson(response));
