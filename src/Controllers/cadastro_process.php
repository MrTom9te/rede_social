<?php
session_start(); // Inicie a sessão

require_once "../Config/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conexao = conexao_db();

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($name) || empty($email) || empty($username) || empty($password)) {
        $_SESSION["error"] = "Todos os campos são obrigatórios.";
        header("Location: ../../public/cadastro.php");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "E-mail inválido.";
        header("Location: ../../public/cadastro.php");
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql =
            "INSERT INTO users (name, email, username, password) VALUES (:name, :email, :username, :password)";
        $stmt = $conexao->prepare($sql);
        $stmt->execute([
            ":name" => $name,
            ":email" => $email,
            ":username" => $username,
            ":password" => $passwordHash,
        ]);

        $_SESSION["success"] = "Cadastro realizado com sucesso. Agora faça o login.";
        header("Location: ../../public/login.php");
        exit();
    } catch (PDOException $e) {
        $_SESSION["error"] = "Erro ao cadastrar usuário: " . $e->getMessage();
        header("Location: ../../public/cadastro.php");
        exit();
    }
}
?>
