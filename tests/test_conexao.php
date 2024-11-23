<?php
// Importa o arquivo com as configurações de conexão do banco
// Certifique-se que o caminho está correto!
require_once "./src/Config/conexao.php";

try {
    // ETAPA 1: TESTE DE CONEXÃO
    // -------------------------
    // Tenta estabelecer conexão com o banco de dados
    // Se der erro aqui, pode ser problema de:
    // - Credenciais erradas
    // - Banco não está rodando
    // - Nome do banco errado
    $conexao = conexao_db();
    echo "Conexão estabelecida com sucesso!\n";

    // ETAPA 2: VERIFICAÇÃO DA TABELA
    // -----------------------------
    // Essa query especial consulta o "catálogo" do banco (information_schema)
    // para ver se nossa tabela exists
    // É como olhar o índice de um livro procurando por um capítulo específico
    $query = "SELECT table_name
             FROM information_schema.tables
             WHERE table_schema = 'public'
             AND table_name = 'users'";

    // Executa a query e pega o resultado
    $stmt = $conexao->query($query);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // ETAPA 3: PROCESSAMENTO DO RESULTADO
    // ---------------------------------
    if ($result) {
        // A tabela existe! Vamos fazer alguns testes nela
        echo "Tabela 'users' encontrada no banco de dados.\n";

        // ETAPA 4: INSERÇÃO DE DADOS DE TESTE
        // ---------------------------------
        // ATENÇÃO: Em produção, NUNCA salve senhas em texto puro como 'senha_teste'
        // Use password_hash() para criptografar senhas!
        $sql = "INSERT INTO users (name, email, username, password)
                VALUES ('Teste', 'teste@exemplo.com', 'teste_user', 'senha_teste')";

        // exec() é usado para comandos que não retornam dados (INSERT, UPDATE, DELETE)
        $conexao->exec($sql);
        echo "Registro inserido com sucesso!\n";

        // ETAPA 5: CONSULTA DOS DADOS
        // --------------------------
        // Vamos verificar se os dados foram realmente salvos
        $stmt = $conexao->query("SELECT * FROM users");
        // fetchAll pega todos os registros de uma vez
        // FETCH_ASSOC faz retornar um array com nome das colunas como chaves
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "Registros encontrados na tabela 'users':\n";
        print_r($users);
    } else {
        // A tabela não existe!
        echo "Tabela 'users' não encontrada. Verifique se a tabela foi criada corretamente.\n";
    }
} catch (PDOException $e) {
    // Se qualquer erro acontecer no processo, ele será capturado aqui
    // die() mata a execução do script e mostra uma mensagem
    die("Erro: " . $e->getMessage());
}

/* ========= SUGESTÕES DE MELHORIAS =========
 *
 * 1. Segurança:
 *    - Usar prepared statements para inserções
 *    - Criptografar senhas
 *    - Não expor detalhes de erro em produção
 *
 * 2. Boas Práticas:
 *    - Separar as operações em funções
 *    - Usar constantes para strings repetidas
 *    - Implementar logs adequados
 *
 * 3. Validações:
 *    - Verificar duplicidade antes de inserir
 *    - Validar formato de email
 *    - Validar tamanho dos campos
 */

?>
