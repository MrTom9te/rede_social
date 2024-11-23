<?php
// Importa o arquivo que contém a função de conexão com o banco
// É como importar ingredientes antes de começar uma receita
include_once "./src/Controllers/get_user.php";

/**
 * Função que verifica se a tabela 'users' existe no banco de dados
 * É como um detetive que procura se uma pasta específica existe num arquivo
 */
function get_users()
{
    try {
        // Cria uma conexão com o banco de dados
        // É como "abrir a porta" do banco de dados
        $conexao = conexao_db();

        // Essa query é especial! Ela procura nas "informações do sistema" (information_schema)
        // se existe uma tabela chamada 'users' no esquema 'public'
        //
        // Explicando cada parte da query:
        // - information_schema.tables: é como um "índice" que lista todas as tabelas
        // - table_schema = 'public': procura apenas no esquema público (pasta principal)
        // - table_name = 'users': procura especificamente a tabela 'users'
        $query = "SELECT table_name
                 FROM information_schema.tables
                 WHERE table_schema = 'public'
                 AND table_name = 'users'";

        // Executa a query no banco
        // É como fazer uma pergunta ao banco: "Ei, você tem uma tabela users?"
        $stmt = $conexao->query($query);

        // Pega todos os resultados e guarda em $users
        // PDO::FETCH_ASSOC faz retornar um array associativo (com nomes das colunas)
        // É como guardar a resposta do banco numa variável que podemos usar
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Imprime o resultado (geralmente usado para debug)
        // DICA: Em produção, você provavelmente vai querer remover ou comentar esse echo
        echo $users;

        // Retorna os resultados para quem chamou a função
        return $users;
    } catch (PDOException $e) {
        // Se algo der errado, captura o erro e mostra uma mensagem
        // PDOException são erros específicos de banco de dados
        print_r("Error get user : " . $e->getMessage());
    }
}

// ========= EXEMPLO DE COMO USAR =========
//
// $resultado = get_users();
//
// // Se a tabela existir, $resultado terá algo assim:
// // Array ( [0] => Array ( [table_name] => users ) )
//
// // Se a tabela não existir:
// // Array ( )
//
// // Para verificar se a tabela existe:
// if (count($resultado) > 0) {
//     echo "A tabela users existe!";
// } else {
//     echo "A tabela users não existe!";
// }

?>
