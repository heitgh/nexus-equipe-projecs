<?php
$conexao = new mysqli('localhost', 'root', 'Home@spSENAI2025!', 'empresa1');
$cpf = $_POST['cpf'];

$sql = "SELECT * FROM funcionarios WHERE cpf = '$cpf'";
$resultado = $conexao->query($sql);

if ($resultado->num_rows > 0) {
    $cliente = $resultado->fetch_assoc();
?>

<form action="salvar_alteracao.php" method="POST">
  <input type="hidden" name="cpf" value="<?php echo $cliente['cpf']; ?>">

  <label>Nome Atual:</label>
  <input type="text" name="nome" value="<?php echo $cliente['nome']; ?>" required>

  <button type="submit">Gravar Alterações</button>
</form>
<?php } else { echo "funcionarios não localizado."; } ?>