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

// Função para criar um novo post usando o template
function createPost(username, handler, text, imageUrl) {
  const template = document.getElementById("post-template");
  const postClone = template.content.cloneNode(true);

  // Preenche os dados do post
  postClone.querySelector("h3").textContent = username;
  postClone.querySelector(".user-handler").textContent = handler;
  postClone.querySelector(".post-content p").textContent = text;
  postClone.querySelector(".post-image").src = imageUrl;

  // Insere o post clonado na página
  document.getElementById("posts-page").appendChild(postClone);
}

function getFriends(username, text) {
  // Obtém o template
  const template = document.getElementById("friends-groups-template");

  // Clona o conteúdo do template
  const friendClone = template.content.cloneNode(true);

  // Modifica o conteúdo do clone
  friendClone.querySelector("h5").textContent = username; // Atualiza o nome
  friendClone.querySelector("p").textContent = text; // Atualiza a mensagem

  // Adiciona o clone ao DOM dentro da div com id 'friends-groups'
  const friendsGroups = document.getElementById("friends-groups");
  friendsGroups.appendChild(friendClone);
}

// Exemplo de uso:
getFriends("J.Evangelista", "Bom dia!");
getFriends("A. Sousa", "Tudo certo?");
getFriends("J.Evangelista", "Bom dia!");
getFriends("A. Sousa", "Tudo certo?");
getFriends("J.Evangelista", "Bom dia!");
getFriends("A. Sousa", "Tudo certo?");
getFriends("J.Evangelista", "Bom dia!");
getFriends("A. Sousa", "Tudo certo?");

// Exemplo de uso
createPost(
  "Gabriel Santarem",
  "@gabriel",
  "Esse é o meu primeiro post!",
  "https://picsum.photos/250"
);
createPost(
  "Raffi",
  "@maria",
  "Olha essa paisagem incrível!",
  "https://picsum.photos/200"
);
createPost(
  "J.Evangelista",
  "@Evqangelista",
  "Esse é meu primeiro post",
  "https://picsum.photos/300"
);
