<?php
session_start();

require 'conexao.php'; // Aqui esperamos que a conexão esteja na variável $conn (mysqli)

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {

        // Prepara a consulta com MySQLi
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $user = mysqli_fetch_assoc($result);

            if ($user) {
                // Verifica a senha com password_verify
                if (password_verify($password, $user['password'])) {

                    $_SESSION['username'] = $user['username'];
                    $_SESSION['user_id'] = $user['id'];

                    header("Location: home.php");
                    exit();
                } else {
                    echo "Senha incorreta!";
                }
            } else {
                echo "Usuário não encontrado!";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da consulta.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}
?>
