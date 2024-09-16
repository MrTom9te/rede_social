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

// Fechar todas as janelas quando clicar fora delas
document.addEventListener("click", (event) => {
  if (!event.target.closest(".options-bar")) {
    document
      .querySelectorAll(".message-window, .notify-window, .config-window")
      .forEach((window) => {
        window.style.visibility = "hidden";
      });
  }
});
