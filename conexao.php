<?php
$servidor = "";
$dbusuario = "";
$dbsenha = "";
$dbname = "";
$conn = mysqli_connect($servidor, $dbusuario, $dbsenha, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
