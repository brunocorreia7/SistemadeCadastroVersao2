<?php
session_start();
require 'conexao.php';
require 'funcoes.php';

$id = $_GET['id'];

if (deletarUsuario($conn, $id)) {
    $_SESSION['message'] = "Usuário deletado com sucesso";
} else {
    $_SESSION['message'] = "Erro ao deletar usuário: " . mysqli_error($conn);
}

mysqli_close($conn);

header("Location: home.php");
exit();
?>