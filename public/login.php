<?php
session_start();
if (isset($_SESSION["success"])) {
    echo '<div class="success">' . $_SESSION["success"] . "</div>";
    unset($_SESSION["success"]);
}
?>
<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="style.css" />
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/login.css" />

        <!-- fonte da pagina  -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400&display=swap"
            rel="stylesheet"
        />
        <title>Cadastro</title>
    </head>
    <body>
        <main alt="pagina de login">
            <div class="login-container">
                <form class="login-form" action="/login" method="get">
                    <div class="input-group">
                        <label for="username">Usuario:</label>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Nome de usuário.."
                            required
                        />
                    </div>

                    <div class="input-group">
                        <label for="password">Senha:</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Senha"
                            required
                        />
                    </div>
                    <div class="input-group">
                        <button type="submit">Entar</button>
                    </div>
                    <div class="extras-options">
                        <a href="#">Esqueci minha senha </a>
                    </div>
                </form>
            </div>
        </main>
    </body>
    <script src="../js/login.js"></script>
</html>
