<?php
require_once "./src/Config/conexao.php";
require_once "./src/Controllers/get_user.php";

try {
    // Testa a conexão primeiro
    $conexao = conexao_db();
    echo "Conexão estabelecida com sucesso!\n";

    // Testa a função get_users()
    echo "\nTestando função get_users():\n";
    $resultado = get_users();

    if ($resultado) {
        echo "✓ Função get_users() executada com sucesso\n";
        echo "✓ Resultado obtido:\n";
        print_r($resultado);

        // Verifica se retornou a tabela users
        if (isset($resultado[0]["table_name"]) && $resultado[0]["table_name"] === "users") {
            echo "✓ Tabela 'users' encontrada corretamente\n";
        } else {
            echo "✗ Erro: Tabela 'users' não encontrada no resultado\n";
        }
    } else {
        echo "✗ Erro: A função get_users() não retornou resultados\n";
    }

    // Teste adicional: Verifica se consegue buscar registros da tabela
    $query = "SELECT * FROM users ";
    $stmt = $conexao->query($query);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($usuarios) {
        echo "\n✓ Conseguiu buscar registros da tabela users:\n";
        print_r($usuarios);
    } else {
        echo "\n✗ Aviso: Nenhum registro encontrado na tabela users\n";
    }
} catch (PDOException $e) {
    echo "✗ Erro durante o teste: " . $e->getMessage() . "\n";
}
?>
