<?php
session_start();
require 'conexao.php';
require 'funcoes.php';

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = trim($_POST['descricao']);
    $categoria = trim($_POST['categoria']);
    $tamanho = trim($_POST['tamanho']);
    $cor = trim($_POST['cor']);
    $quantidade = trim($_POST['quantidade']);
    $preco_custo = trim($_POST['preco_custo']);
    $preco_venda = trim($_POST['preco_venda']);
    $fornecedor = trim($_POST['fornecedor']);

    if (cadastrarUsuario($conn, $descricao, $categoria, $tamanho, $cor, $quantidade, $preco_custo, $preco_venda, $fornecedor)) {
        $message = "Novo usuário cadastrado com sucesso";
    } else {
        $message = "Erro: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Cadastro</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <nav class="navbar d-flex justify-content-between">
    <h2>Cadastro de roupas</h2>
    <a id="botao" href="home.php" class="btn btn-secondary">Voltar</a>
  </nav>

  <?php if ($message): ?>
    <div class="alert alert-info" role="alert">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <form action="" method="post" class="row g-3">
    <div class="col-md-6">
      <label for="descricao" class="form-label">Descrição:</label>
      <input type="text" class="form-control" id="descricao" name="descricao" required>
    </div>
    <div class="col-md-6">
      <label for="categoria" class="form-label">Categoria:</label>
      <input type="text" class="form-control" id="categoria" name="categoria" required>
    </div>
    <div class="col-md-4">
      <label for="tamanho" class="form-label">Tamanho:</label>
      <select class="form-control" id="tamanho" name="tamanho" required>
        <option value="PP">PP</option>
        <option value="P">P</option>
        <option value="M">M</option>
        <option value="G">G</option>
        <option value="GG">GG</option>
      </select>
    </div>
    <div class="col-md-4">
      <label for="cor" class="form-label">Cor:</label>
      <input type="text" class="form-control" id="cor" name="cor" required>
    </div>
    <div class="col-md-4">
      <label for="quantidade" class="form-label">Quantidade:</label>
      <input type="number" class="form-control" id="quantidade" name="quantidade" required>
    </div>
    <div class="col-md-6">
      <label for="preco_custo" class="form-label">Preço de custo:</label>
      <input type="number" step="0.01" class="form-control" id="preco_custo" name="preco_custo" required>
    </div>
    <div class="col-md-6">
      <label for="preco_venda" class="form-label">Preço de venda:</label>
      <input type="number" step="0.01" class="form-control" id="preco_venda" name="preco_venda" required>
    </div>
    <div class="col-12">
      <label for="fornecedor" class="form-label">Fornecedor:</label>
      <input type="text" class="form-control" id="fornecedor" name="fornecedor" required>
    </div>
    <div class="col-12 text-center">
      <button type="submit" class="btn btn-primary">Confirmar</button>
    </div>
  </form>
</div>

<script src="js/validacoes.js"></script>
</body>
</html>
