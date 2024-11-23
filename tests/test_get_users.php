<?php
/**
 * Script de Teste da Aplicação
 * Este script testa a conexão com o banco e as principais funcionalidades
 * relacionadas à tabela de usuários
 */

// Importa os arquivos necessários
require_once "./src/Config/conexao.php";
require_once "./src/Controllers/get_user.php";

// Símbolos para melhor visualização dos resultados
const SUCESSO = "✓";
const ERRO = "✗";
const SEPARADOR = "\n----------------------------------------\n";

/**
 * Função auxiliar para formatar mensagens de teste
 */
function printTestResult($sucesso, $mensagem)
{
    $simbolo = $sucesso ? SUCESSO : ERRO;
    $prefixo = $sucesso ? "Sucesso: " : "Erro: ";
    echo "{$simbolo} {$prefixo}{$mensagem}\n";
}

try {
    echo "INICIANDO SUITE DE TESTES" . SEPARADOR;

    // TESTE 1: Conexão com o Banco
    // ---------------------------
    echo "1. Teste de Conexão\n";
    $conexao = conexao_db();
    printTestResult(true, "Conexão estabelecida com sucesso!");

    // TESTE 2: Função get_users()
    // --------------------------
    echo SEPARADOR . "2. Teste da função get_users()\n";
    $resultado = get_users();

    // Verifica se a função retornou algo
    if ($resultado) {
        printTestResult(true, "Função get_users() executou com sucesso");
        echo "\nResultado obtido:\n";
        print_r($resultado);

        // Análise detalhada do resultado
        if (isset($resultado[0]["table_name"]) && $resultado[0]["table_name"] === "users") {
            printTestResult(true, "Tabela 'users' encontrada no banco");
        } else {
            printTestResult(false, "Tabela 'users' não encontrada no resultado");
        }
    } else {
        printTestResult(false, "A função get_users() não retornou resultados");
    }

    // TESTE 3: Consulta de Registros
    // -----------------------------
    echo SEPARADOR . "3. Teste de consulta de registros\n";

    // Usa prepared statement para maior segurança
    $query = "SELECT id, name, email, username, created_at FROM users LIMIT 5";
    $stmt = $conexao->prepare($query);
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($usuarios) {
        printTestResult(true, "Registros encontrados na tabela users");
        echo "\nPrimeiros 5 registros:\n";
        // Formata a saída para melhor legibilidade
        foreach ($usuarios as $usuario) {
            echo "\nUsuário ID: " . $usuario["id"] . "\n";
            echo "  Nome: " . $usuario["name"] . "\n";
            echo "  Email: " . $usuario["email"] . "\n";
            echo "  Username: " . $usuario["username"] . "\n";
            echo "  Criado em: " . $usuario["created_at"] . "\n";
        }
    } else {
        printTestResult(false, "Nenhum registro encontrado na tabela users");
    }

    // Resumo dos testes
    echo SEPARADOR . "RESUMO DOS TESTES:\n";
    echo SUCESSO . " Conexão com o banco\n";
    echo ($resultado ? SUCESSO : ERRO) . " Verificação da tabela users\n";
    echo ($usuarios ? SUCESSO : ERRO) . " Consulta de registros\n";
} catch (PDOException $e) {
    echo SEPARADOR;
    printTestResult(false, "Erro durante os testes: " . $e->getMessage());

    // Log do erro em um arquivo (em produção)
    error_log("Erro nos testes: " . $e->getMessage());
} finally {
    echo SEPARADOR . "FIM DOS TESTES\n";
}

/* ========= SUGESTÕES DE MELHORIAS =========
 *
 * 1. Adicionar mais testes:
 *    - Testar inserção de usuário
 *    - Testar atualização de usuário
 *    - Testar deleção de usuário
 *    - Verificar estrutura da tabela (colunas)
 *
 * 2. Melhorar o relatório:
 *    - Adicionar timestamps nos testes
 *    - Gerar relatório em HTML ou JSON
 *    - Salvar resultados em arquivo
 *
 * 3. Segurança:
 *    - Adicionar verificação de ambiente (não rodar em produção)
 *    - Limitar informações sensíveis nos logs
 *    - Adicionar timeout nos testes
 */

?>
