<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Excluir Funcionário</title>
</head>
<body>
  <footer class="rodape-fogo"></footer>
</body>
</html>

<?php
$conexao = new mysqli('localhost', 'root', '', 'nexus_db');

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$cpf = $_POST['cpf'] ?? '';

if (!empty($cpf)) {
    $stmt = $conexao->prepare("SELECT * FROM funcionarios WHERE cpf = ?");
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $cliente = $resultado->fetch_assoc();
?>

<h2>Confirma exclusão</h2>
<p>Tem certeza que deseja excluir o funcionário abaixo?</p>
<p><strong>Nome:</strong> <?php echo htmlspecialchars($cliente['nome']); ?></p>
<p><strong>CPF:</strong> <?php echo htmlspecialchars($cliente['cpf']); ?></p>

<form action="salexc_func.php" method="POST">
  <input type="hidden" name="cpf" value="<?php echo htmlspecialchars($cliente['cpf']); ?>">
  <button type="submit">Sim, Excluir Definitivamente</button>
</form>
<br>
<a href="exc_func.php" class="button">Cancelar</a>

<?php 
    } else { 
        echo "Funcionário não localizado.<br><br>";
        echo '<a href="exc_func.php">Voltar para a busca</a>';
    } 
    $stmt->close();
} else {
?>

<h2>Excluir Funcionário</h2>
<form action="exc_func.php" method="POST">
  <label>Digite o CPF do funcionário que deseja deletar:</label>
  <input type="text" name="cpf" required> <br><br>
  <button type="submit">Buscar</button>
</form>

<?php
}
$conexao->close();
?>