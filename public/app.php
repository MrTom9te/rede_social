<?php

//agora funciona mais ou menos :{
if (!isset($_SESSION["usuario_id"])) {
    // Redireciona para login se não estiver logado
    header("Location: login.php");
    exit();
} ?>

<!doctype html>
<html lang="pt-BR">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap"
            rel="stylesheet"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        />

        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Flow Waves</title>
        <link rel="stylesheet" href="/css/app.css" />
        <script src="/js/script.js"></script>
    </head>
    <body>
        <div id="mobile-header">
            <button class="user-icon" id="user-icon">
                <img
                    src="/assets/icons/account_circle_24dp_E0000_FILL0_wght400_GRAD0_opsz24.svg"
                    alt="Usuário"
                />
            </button>
        </div>
        <div class="container">
            <header style="border: dashed red" class="menu">
                <div class="logo">
                    <a href="index.html">
                        <img src="/assets/logo_48x48.svg" alt="Logo" />
                    </a>
                </div>
                <div class="menu-options">
                    <nav class="nav-options">
                        <ul>
                            <li>
                                <a href="#">
                                    <img
                                        src="/assets/icons/home_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                        alt="Página Inicial"
                                    />
                                    Página Inicial
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img
                                        src="/assets/icons/search_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                        alt="Explorar"
                                    />
                                    Explorar
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img
                                        src="/assets/icons/bell-regular.svg"
                                        alt="Notificações"
                                    />
                                    Notificações
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img
                                        src="/assets/icons/envelope-solid.svg"
                                        alt="Mensagens"
                                    />
                                    Mensagens
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img
                                        src="/assets/icons/bookmark_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                        alt="Itens salvos"
                                    />
                                    Itens salvos
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img
                                        src="/assets/icons/list_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                        alt="Listas"
                                    />
                                    Listas
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img
                                        src="/assets/icons/person_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                        alt="Perfil"
                                    />
                                    Perfil
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <img
                                        src="/assets/icons/more_horiz_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                        alt="Mais"
                                    />
                                    Mais
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>

            <main id="app-page">
                <div id="posts-page">
                    <div class="post-box">
                        <img
                            src="https://picsum.photos/40"
                            alt="Avatar"
                            class="chat-avatar"
                        />
                        <div class="post-input">
                            <textarea
                                placeholder="O que está acontecendo?"
                            ></textarea>
                            <div class="post-actions">
                                <div class="post-attachments">
                                    <button>
                                        <img
                                            src="/assets/icons/image_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                            alt="Imagem"
                                        />
                                    </button>
                                    <button>
                                        <img
                                            src="/assets/icons/gif_box_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                            alt="GIF"
                                        />
                                    </button>
                                    <button>
                                        <img
                                            src="/assets/icons/how_to_vote_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                            alt="Enquete"
                                        />
                                    </button>
                                    <button>
                                        <img
                                            src="/assets/icons/sentiment_satisfied_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                            alt="Emoji"
                                        />
                                    </button>
                                    <button>
                                        <img
                                            src="/assets/icons/event_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                            alt="Agendar"
                                        />
                                    </button>
                                </div>
                                <button class="msg-submit">Flow</button>
                            </div>
                        </div>
                    </div>
                    <div id="posts">
                        <!-- Posts serão inseridos aqui dinamicamente -->
                    </div>
                </div>
                <div id="trending">
                    <div class="search-container">
                        <form action="" method="get">
                            <input
                                type="text"
                                id="search-bar"
                                placeholder="Buscar no Flow Waves"
                            />
                            <button class="search-button" type="submit">
                                <img
                                    src="/assets/icons/search_24dp_E8EAED_FILL0_wght400_GRAD0_opsz24.svg"
                                    alt="Buscar"
                                />
                            </button>
                        </form>
                    </div>
                    <div class="trends">
                        <h3>O que está acontecendo</h3>
                        <!-- Trending topics serão inseridos aqui -->
                    </div>
                    <div id="main-cg">
                        <h3>Quem seguir</h3>
                        <div id="cg-area">
                            <!-- Sugestões de quem seguir serão inseridas aqui -->
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <template id="post-template">
            <article class="post">
                <div id="user-data">
                    <h3>Nome do Usuário</h3>
                    <p class="user-handler">@fulano</p>
                </div>
                <div class="post-content">
                    <p>Texto da postagem...</p>
                    <img
                        src="https://picsum.photos/200"
                        alt="imagem do post"
                        class="post-image"
                    />
                </div>
                <div class="action-bar">
                    <button class="like-btn">
                        <img
                            src="/assets/icons/heart-regular.svg"
                            alt="Curtir"
                        />
                    </button>
                    <button class="comment-btn">
                        <img
                            src="/assets/icons/comment-solid.svg"
                            alt="Comentar"
                        />
                    </button>
                    <button class="share-btn">
                        <img
                            src="/assets/icons/share-solid.svg"
                            alt="Compartilhar"
                        />
                    </button>
                </div>
            </article>
        </template>
        <script src="/js/script.js"></script>
    </body>
</html>
