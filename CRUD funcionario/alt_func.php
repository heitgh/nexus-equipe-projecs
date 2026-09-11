<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Alterar Funcionário</title>
</head>

<?php
$conexao = new mysqli('localhost', 'root', 'oi', 'nexus_db');

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

<h2>Alterar Dados</h2>
<form action="salalt_func.php" method="POST">
    <label>CPF:</label>
    <input type="hidden" name="cpf" value="<?php echo htmlspecialchars($cliente['cpf']); ?>"> <br><br>

    <label>Nome Atual:</label>
    <input type="text" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required> <br><br>
    <label>Função Atual:</label>
    <input type="text" name="funcao" value="<?php echo htmlspecialchars($cliente['funcao']); ?>" required> <br><br>
    <label>Departamento Atual:</label>
    <input type="text" name="departamento" value="<?php echo htmlspecialchars($cliente['departamento']); ?>" required> <br><br>
    <label>Idade Atual:</label>
    <input type="text" name="idade" value="<?php echo htmlspecialchars($cliente['idade']); ?>" required> <br><br>
    <label>Salário Atual:</label>
    <input type="text" name="salario" value="<?php echo htmlspecialchars($cliente['salario']); ?>" required> <br><br>
    <label>Endereço Atual:</label>
    <input type="text" name="endereco" value="<?php echo htmlspecialchars($cliente['endereco']); ?>" required> <br><br>

  <button type="submit">Gravar Alterações</button>
</form>

<?php 
    } else { 
        echo "Funcionário não localizado.<br><br>";
        echo '<a href="alt_func.php">Voltar para a busca</a>';
    } 
    $stmt->close();
} else {
?>

<h2>Buscar Funcionário</h2>
<form action="alt_func.php" method="POST">
  <label>Digite o CPF:</label>
  <input type="text" name="cpf" required> <br><br>
  <button type="submit">Buscar</button>
</form>

<footer class="rodape-fogo"></footer>

<?php
}
$conexao->close();
?>
