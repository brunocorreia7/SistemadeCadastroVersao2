<?php
require 'conexao.php';

function buscarDadosTabela($conn, $search = '') {
    $sql = 'SELECT * FROM usuarios WHERE situacao = 1';
    if ($search) {
        $sql .= " AND (descricao LIKE '%$search%' OR categoria LIKE '%$search%' OR tamanho LIKE '%$search%' OR cor LIKE '%$search%' OR fornecedor LIKE '%$search%')";
    }
    return mysqli_query($conn, $sql);
}

function cadastrarUsuario($conn, $descricao, $categoria, $tamanho, $cor, $quantidade, $preco_custo, $preco_venda, $fornecedor) {
    // Remover espaços em branco dos valores dos campos
    $descricao = trim($descricao);
    $categoria = trim($categoria);
    $tamanho = trim($tamanho);
    $cor = trim($cor);
    $quantidade = trim($quantidade);
    $preco_custo = trim($preco_custo);
    $preco_venda = trim($preco_venda);
    $fornecedor = trim($fornecedor);

    $sql = "INSERT INTO usuarios (descricao, categoria, tamanho, cor, quantidade, preco_custo, preco_venda, fornecedor) VALUES ('$descricao', '$categoria', '$tamanho', '$cor', '$quantidade', '$preco_custo', '$preco_venda', '$fornecedor')";
    return mysqli_query($conn, $sql);
}

function buscarUsuarioPorId($conn, $id) {
    $sql = "SELECT * FROM usuarios WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

function editarUsuario($conn, $id, $descricao, $categoria, $tamanho, $cor, $quantidade, $preco_custo, $preco_venda, $fornecedor) {
    $sql = "UPDATE usuarios SET descricao = '$descricao', categoria = '$categoria', tamanho = '$tamanho', cor = '$cor', quantidade = '$quantidade', preco_custo = '$preco_custo', preco_venda = '$preco_venda', fornecedor = '$fornecedor' WHERE id = $id";
    return mysqli_query($conn, $sql);
}

function deletarUsuario($conn, $id) {
    $sql = "UPDATE usuarios SET situacao = 0 WHERE id = $id";
    return mysqli_query($conn, $sql);
}

if (isset($_POST['delete_usuario'])) {
    $id = $_POST['delete_usuario'];
    if (deletarUsuario($conn, $id)) {
        $_SESSION['message'] = "Usuário deletado com sucesso";
    } else {
        $_SESSION['message'] = "Erro ao deletar usuário: " . mysqli_error($conn);
    }
    header("Location: home.php");
    exit();
}
?>