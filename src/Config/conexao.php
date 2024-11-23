<?php
/**
 * Função que cria uma conexão com o banco de dados PostgreSQL
 * Pense nela como um "ponte" entre seu PHP e o banco de dados
 */
function conexao_db()
{
    // ========= CONFIGURAÇÕES DO BANCO DE DADOS =========

    // O DSN (Data Source Name) é como se fosse o endereço completo do banco de dados
    // É tipo um endereço de casa: tem a rua (host), número (porta) e complemento (nome do banco)

    // host = onde o banco está rodando
    // - localhost: quando roda direto no seu computador
    // - db: quando roda usando Docker (que é tipo uma caixinha isolada com o banco)
    // port = a porta que o PostgreSQL usa (5432 é a porta padrão, igual TV aberta é canal 2-13)
    // dbname = o nome do banco que você quer conectar
    $dsn = "pgsql:host=localhost;port=5432;dbname=rede_social";

    // Usuário do banco de dados (por padrão no Postgres é 'postgres')
    $username = "postgres";

    // Senha do banco de dados
    // DICA DE SEGURANÇA: Em projetos reais, nunca deixe a senha direto no código!
    // Use arquivos de configuração ou variáveis de ambiente
    $password = "postgres";

    try {
        // Tenta criar a conexão com o banco
        // É como fazer uma ligação: você disca (informações acima) e aguarda conectar
        $conexao = new PDO($dsn, $username, $password);

        // Configura o modo de erro do PDO para lançar exceções
        // Isso é bom porque se algo der errado, seu código vai saber e pode tratar o erro
        // É tipo configurar seu telefone para avisar quando está sem sinal
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Se chegou até aqui, deu tudo certo! Retorna a conexão
        return $conexao;
    } catch (PDOException $e) {
        // Se algo deu errado, esse bloco catch pega o erro
        // PDOException é um tipo especial de erro relacionado à conexão com banco

        // Interrompe o programa e mostra uma mensagem de erro
        // É tipo um "PARE TUDO e me diga o que aconteceu de errado"
        die("Erro ao conectar com o banco de dados: " . $e->getMessage());
    }
}

// ========= COMO USAR ESSA FUNÇÃO =========
//
// // 1. Chame a função para criar a conexão
// $minhaConexao = conexao_db();
//
// // 2. Use a conexão para fazer operações no banco
// // Exemplo de consulta:
// // $resultado = $minhaConexao->query("SELECT * FROM usuarios");
//
// // 3. Lembre-se de tratar possíveis erros!
// // try {
// //     $minhaConexao = conexao_db();
// //     // seu código aqui
// // } catch (Exception $e) {
// //     echo "Ops, algo deu errado: " . $e->getMessage();
// // }

?>
