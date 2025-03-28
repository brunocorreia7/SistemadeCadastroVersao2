<?php
session_start();
require 'conexao.php';
require 'funcoes.php';

$search = '';
if (isset($_GET['search'])) {
    $search = $_GET['search'];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Sistema Loja SB</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <style>
  .input-group {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 15px;
  }

  .input-field {
    width: 40%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-right: 10px;
  }

  .submit-btn {
    padding: 10px 15px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .submit-btn:hover {
    background-color: #0056b3;
  }
</style>
</head>
<body>

<div class="container mt-3">
  <nav class="navbar">
    <div class="logo">
      <h2>Sistema loja SB</h2>
    </div>
    <div class="menu">
      <a id="botao" href="cadastro.php">Cadastrar</a>
    </div>
  </nav>

  <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info" role="alert">
      <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
      ?>
    </div>
  <?php endif; ?>

  <form method="GET" action="">
  <div class="input-group mb-3">
    <input type="text" class="input-field" placeholder="Pesquisar" name="search" value="<?php echo $search; ?>">
    <button class="submit-btn" type="submit">Pesquisar</button>
  </div>
</form>

  <table class="table table-dark">
    <thead>
      <tr>
        <th>ID</th>
        <th>Descricao</th>
        <th>Categoria</th>
        <th>Tamanho</th>
        <th>Cor</th>
        <th>Quantidade</th>
        <th>Preco_custo</th>
        <th>Preco_venda</th>
        <th>Fornecedor</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
    <?php
        $usuarios = buscarDadosTabela($conn, $search);
        if (mysqli_num_rows($usuarios) > 0) {
            foreach($usuarios as $usuario) {
    ?>
    <tr>
      <td><?=$usuario['id']?></td>
      <td><?=$usuario['descricao']?></td>
      <td><?=$usuario['categoria']?></td>
      <td><?=$usuario['tamanho']?></td>
      <td><?=$usuario['cor']?></td>
      <td><?=$usuario['quantidade']?></td>
      <td><?=number_format($usuario['preco_custo'], 2, ',', '.')?></td>
      <td><?=number_format($usuario['preco_venda'], 2, ',', '.')?></td>
      <td><?=$usuario['fornecedor']?></td>
      <td>
        <a href="editar.php?id=<?=$usuario['id']?>" class="btn btn-success btn-sm"><span class="bi-pencil-fill"></span>&nbsp;Editar</a>

        <form action="funcoes.php" method="POST" class="d-inline">
        <button onclick="return confirm('Tem certeza que deseja excluir?')" type="submit" name="delete_usuario" value="<?= $usuario['id'] ?>" class="btn btn-danger btn-sm">
        <span class="bi-trash3-fill"></span>&nbsp;Excluir
        </button></form>
      </td>
    </tr>
    <?php
            }
        } else {
    ?>
    <tr>
      <td colspan="6">Nenhum resultado encontrado.</td>
    </tr>
    <?php
        }
    ?>
    </tbody>
  </table>
</div>

</body>
</html>