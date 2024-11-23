<?php
// Inicia a sessão PHP - isso permite guardar informações temporárias do usuário
// É como criar uma "gaveta" específica para cada usuário que acessa o site
session_start();

// Importa o arquivo que tem a função de conexão com o banco de dados
// É importante que este arquivo exista no caminho "../Config/conexao.php"
require_once "../Config/conexao.php";

// Verifica se o formulário foi enviado via POST
// POST é um método mais seguro para enviar dados sensíveis (como senhas)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Cria a conexão com o banco de dados
    $conexao = conexao_db();

    // Pega os dados enviados pelo formulário e remove espaços em branco com trim()
    // trim() é tipo passar uma borracha nas beiradas do texto
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // VALIDAÇÃO 1: Verifica se algum campo está vazio
    // empty() verifica se uma variável está vazia
    if (empty($name) || empty($email) || empty($username) || empty($password)) {
        // Guarda a mensagem de erro na sessão para mostrar depois
        $_SESSION["error"] = "Todos os campos são obrigatórios.";
        // Redireciona de volta para a página de cadastro
        header("Location: ../../public/cadastro.php");
        // Interrompe a execução do código aqui
        exit();
    }

    // VALIDAÇÃO 2: Verifica se o e-mail é válido
    // filter_var com FILTER_VALIDATE_EMAIL checa se o formato do email está correto
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "E-mail inválido.";
        header("Location: ../../public/cadastro.php");
        exit();
    }

    // SEGURANÇA: Criptografa a senha
    // Nunca, JAMAIS guarde senhas em texto puro no banco de dados!
    // password_hash cria uma versão embaralhada da senha que não pode ser desembaralhada
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Prepara o comando SQL para inserir o usuário
        // Os :name, :email, etc são marcadores que serão substituídos depois
        // Isso previne SQL Injection (um tipo de ataque)
        $sql = "INSERT INTO users (name, email, username, password)
                VALUES (:name, :email, :username, :password)";

        // Prepara a query para execução
        $stmt = $conexao->prepare($sql);

        // Executa a query, substituindo os marcadores pelos valores reais
        // Isso é como preencher um formulário com os dados
        $stmt->execute([
            ":name" => $name, // Substitui :name pelo nome informado
            ":email" => $email, // Substitui :email pelo email informado
            ":username" => $username, // Substitui :username pelo username informado
            ":password" => $passwordHash, // Substitui :password pela senha criptografada
        ]);

        // Se chegou até aqui, deu tudo certo!
        // Guarda mensagem de sucesso na sessão
        $_SESSION["success"] = "Cadastro realizado com sucesso. Agora faça o login.";
        // Redireciona para a página de login
        header("Location: ../../public/login.php");
        exit();
    } catch (PDOException $e) {
        // Se algo deu errado na operação com o banco...
        // Guarda o erro na sessão
        $_SESSION["error"] = "Erro ao cadastrar usuário: " . $e->getMessage();
        // Volta para a página de cadastro
        header("Location: ../../public/cadastro.php");
        exit();
    }
}

/* ========= DICAS DE SEGURANÇA E BOAS PRÁTICAS =========
 *
 * 1. Validações adicionais que você pode implementar:
 *    - Tamanho mínimo e máximo para senha
 *    - Caracteres especiais obrigatórios na senha
 *    - Verificar se email/username já existe no banco
 *    - Validar caracteres permitidos no username
 *
 * 2. Melhorias possíveis:
 *    - Adicionar proteção contra CSRF (Cross-Site Request Forgery)
 *    - Implementar limite de tentativas de cadastro por IP
 *    - Adicionar validação de força da senha
 *    - Adicionar captcha para prevenir bots
 *
 * 3. Boas práticas implementadas:
 *    - Uso de prepared statements (previne SQL Injection)
 *    - Criptografia de senha
 *    - Validação de dados de entrada
 *    - Mensagens de erro/sucesso em sessão
 *    - Redirecionamentos após operações
 */

?>
