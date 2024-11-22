<?php
function conexao_db()
{
    //caso esteja rodadno dentro do docker o host sera no nome do serviço que no caso é db
    // caso contrario mude para localhost
    $dsn = "pgsql:host=localhost;port=5432;dbname=rede_social";
    $username = "postgres";
    $password = "postgres";

    try {
        $conexao = new PDO($dsn, $username, $password);
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    } catch (PDOException $e) {
        die("Erro ao conectar com o banco de dados: " . $e->getMessage());
    }
}
?>
