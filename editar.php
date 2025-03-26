<?php
session_start();
require 'conexao.php';
require 'funcoes.php';

$message = '';
$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $tamanho = $_POST['tamanho'];
    $cor = $_POST['cor'];
    $quantidade = $_POST['quantidade'];
    $preco_custo = $_POST['preco_custo'];
    $preco_venda = $_POST['preco_venda'];
    $fornecedor = $_POST['fornecedor'];

    if (editarUsuario($conn, $id, $descricao, $categoria, $tamanho, $cor, $quantidade, $preco_custo, $preco_venda, $fornecedor)) {
        $message = "Usuário atualizado com sucesso";
    } else {
        $message = "Erro: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    $usuario = buscarUsuarioPorId($conn, $id);
    if ($usuario) {
        $descricao = $usuario['descricao'];
        $categoria = $usuario['categoria'];
        $tamanho = $usuario['tamanho'];
        $cor = $usuario['cor'];
        $quantidade = $usuario['quantidade'];
        $preco_custo = number_format($usuario['preco_custo'], 2, ',', ''); // Formata com 2 casas decimais
        $preco_venda = number_format($usuario['preco_venda'], 2, ',', ''); // Formata com 2 casas decimais
        $fornecedor = $usuario['fornecedor'];
    } else {
        $message = "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Editar Informações</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <nav class="navbar">
    <div class="logo">
      <h2>Editar</h2>
    </div>
    <div class="menu">
      <a id="botao" href="home.php">Voltar</a>
    </div>
  </nav>

  <?php if ($message): ?>
    <div class="alert alert-info" role="alert">
      <?php echo $message; ?>
    </div>
  <?php endif; ?>

  <form action="" method="post">
    <input type="hidden" name="id" value="<?=$id?>">
    <div class="mb-3 mt-3">
      <label for="descricao" class="form-label">Descrição:</label>
      <input type="text" class="form-control" id="descricao" name="descricao" value="<?=$descricao?>" required>
    </div>
    <div class="mb-3">
      <label for="categoria" class="form-label">Categoria:</label>
      <input type="text" class="form-control" id="categoria" name="categoria" value="<?=$categoria?>" required>
    </div>
    <div class="mb-3">
      <label for="tamanho" class="form-label">Tamanho:</label>
      <input type="text" class="form-control" id="tamanho" name="tamanho" value="<?=$tamanho?>" required>
    </div>
    <div class="mb-3">
      <label for="cor" class="form-label">Cor:</label>
      <input type="text" class="form-control" id="cor" name="cor" value="<?=$cor?>" required>
    </div>
    <div class="mb-3">
      <label for="quantidade" class="form-label">Quantidade:</label>
      <input type="number" class="form-control" id="quantidade" name="quantidade" value="<?=$quantidade?>" required>
    </div>
    <div class="mb-3">
      <label for="preco_custo" class="form-label">Preço de custo:</label>
      <input type="text" class="form-control" id="preco_custo" name="preco_custo" value="<?=$preco_custo?>" required>
    </div>
    <div class="mb-3">
      <label for="preco_venda" class="form-label">Preço de venda:</label>
      <input type="text" class="form-control" id="preco_venda" name="preco_venda" value="<?=$preco_venda?>" required>
    </div>
    <div class="mb-3">
      <label for="fornecedor" class="form-label">Fornecedor:</label>
      <input type="text" class="form-control" id="fornecedor" name="fornecedor" value="<?=$fornecedor?>">
    </div>
    <button type="submit" class="btn btn-primary">Confirmar</button>
  </form>
</div>

</body>
</html>
