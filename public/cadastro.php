<?php
session_start();
if (isset($_SESSION["user_id"])) {
    header("Location: app.php");
    exit();
}
?>

<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Cadastro - Rede Social</title>
        <link rel="stylesheet" href="css/cadastro.css" />
    </head>
    <body>
        <header>
            <h1>Cadastro de Usuário</h1>
        </header>
        <main>
            <section class="container">

                <?php if (isset($_SESSION["error"])) {
                    echo '<div class="error"' . $_SESSION["error"] . "</div>";
                    unset($_SESSION["error"]);
                } ?>
                <form id="cadastroForm" action="../src/Controllers/cadastro_process.php" method="POST">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="name" required />
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" id="email" name="email" required />
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required />
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha:</label>
                        <input type="password" id="senha" name="password" required />
                    </div>
                    <button type="submit">Cadastrar</button>
                </form>
                <p>
                    Já possui uma conta?
                    <a href="login.html">Login</a>
                </p>
            </section>
        </main>
        <footer>
            <p>&copy; 2024 Flow Waves. Todos os direitos reservados.</p>
        </footer>
    </body>

</html>
