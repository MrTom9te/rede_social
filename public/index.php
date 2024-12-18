<?php
require_once __DIR__ . "/../vendor/autoload.php"; ?>

<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Flow Waves - Conecte-se</title>
        <link rel="stylesheet" href="css/homepage.css" />
    </head>
    <body>
        <header class="hero-header">
            <nav class="navbar">
                <div class="logo">
                    <a href="#"
                        ><img
                            src="assets/logo_48x48.svg"
                            alt="Flow Waves Logo"
                    /></a>
                </div>
                <div class="menu">
                    <a href="login.php">Login</a>
                    <a href="cadastro.php">Cadastro</a>
                </div>
            </nav>
            <div class="hero-content">
                <img src="../assets/logo.png" alt="Flow Waves Logo" />
                <h1>Entre na Onda do Futuro</h1>
                <p>
                    O Flow Waves é a plataforma perfeita para conectar,
                    compartilhar e explorar o que é importante para você.
                </p>
                <a href="pages/app.html" class="cta-button">Junte-se a Nós</a>
            </div>
            <div class="scroll-indicator">
                <span>Descubra Mais</span>
                <div class="arrow-down"></div>
            </div>
        </header>
        <section id="about">
            <div class="container">
                <h2>O que é o Flow Waves?</h2>
                <p>
                    Flow Waves é uma rede social que revoluciona a maneira de se
                    conectar com amigos e descobrir novos conteúdos. Com uma
                    interface limpa e recursos inovadores, oferecemos uma
                    experiência social fluida e imersiva.
                </p>
                <p>
                    A nossa missão é permitir que você crie conexões
                    verdadeiras, compartilhe histórias e interaja em tempo real,
                    tudo com um design intuitivo e moderno.
                </p>
            </div>
        </section>
        <footer>
            <div class="footer-links">
                <a href="#">Política de Privacidade</a>
                <a href="#">Termos de Serviço</a>
                <a href="#">Contato</a>
            </div>
            <p>&copy; 2024 Flow Waves. Todos os direitos reservados.</p>
        </footer>
    </body>
</html>
