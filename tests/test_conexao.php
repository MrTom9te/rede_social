<?php
require_once "./src/Config/conexao.php";

try {
    // Conecta ao banco
    $conexao = conexao_db();
    echo "Conexão estabelecida com sucesso!\n";

    // Verificar se a tabela `users` existe
    $query =
        "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'users'";
    $stmt = $conexao->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "Tabela 'users' encontrada no banco de dados.\n";

        // Inserir um registro teste
        $sql =
            "INSERT INTO users (name, email, username, password) VALUES ('Teste', 'teste@exemplo.com', 'teste_user', 'senha_teste')";
        $conexao->exec($sql);
        echo "Registro inserido com sucesso!\n";

        // Consultar os registros
        $stmt = $conexao->query("SELECT * FROM users");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "Registros encontrados na tabela 'users':\n";
        print_r($users);
    } else {
        echo "Tabela 'users' não encontrada. Verifique se a tabela foi criada corretamente.\n";
    }
} catch (PDOException $e) {
    die("Erro: " . $e->getMessage());
}
?>
