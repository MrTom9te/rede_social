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

fetch("https://jsonplaceholder.typicode.com/users")
  .then((response) => response.json())
  .then((data) => {
    console.log("Usuários:", data); // Mostra os dados no console
    const cgArea = document.getElementById("cg-area");
    data.forEach((user) => {
      const template = document
        .getElementById("friends-template")
        .content.cloneNode(true);
      template.querySelector("h5").textContent = user.username;
      template.querySelector("p").textContent = "Online"; // ou outra mensagem fictícia
      cgArea.appendChild(template);
    });
  })
  .catch((error) => console.error("Erro ao buscar usuários:", error));

fetch("https://jsonplaceholder.typicode.com/posts")
  .then((response) => response.json())
  .then((data) => {
    console.log("Postagens:", data); // Mostra os dados no console
    const postsPage = document.getElementById("posts-page");
    data.forEach((post) => {
      const template = document
        .getElementById("post-template")
        .content.cloneNode(true);
      template.querySelector("h3").textContent = "Usuário " + post.userId; // Substitua conforme necessário
      template.querySelector(".post-content p").textContent = post.body;
      postsPage.appendChild(template);
    });
  })
  .catch((error) => console.error("Erro ao buscar postagens:", error));

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
  document.getElementById("main-post").appendChild(postClone);
}

function getFriends(username, text) {
  // Obtém o template
  const template = document.getElementById("friends-template");

  // Clona o conteúdo do template
  const friendClone = template.content.cloneNode(true);

  // Modifica o conteúdo do clone
  friendClone.querySelector("h5").textContent = username; // Atualiza o nome
  friendClone.querySelector("p").textContent = text; // Atualiza a mensagem

  // Adiciona o clone ao DOM dentro da div com id 'friends-groups'
  const friendsGroups = document.getElementById("cg-area");
  friendsGroups.appendChild(friendClone);
}
