<?php
include_once "./src/Controllers/get_user.php";
function get_users()
{
    try {
        $conexao = conexao_db();
        $query =
            "SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' AND table_name = 'users'";
        $stmt = $conexao->query($query);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo $users;
        return $users;
    } catch (PDOException $e) {
        print_r("Error get user : " . $e->getMessage());
    }
}

?>
