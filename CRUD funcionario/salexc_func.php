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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($cpf)) {
    $stmt = $conexao->prepare("DELETE FROM funcionarios WHERE cpf = ?");
    $stmt->bind_param("s", $cpf);

    if ($stmt->execute()) {
        echo "<h2>Funcionário Excluído com Sucesso!</h2>";
        echo '<a href="exc_func.php">Voltar para a página de exclusão</a>';
    } else {
        echo "Erro ao excluir: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Requisição inválida ou dados ausentes.";
}
$conexao->close();
?>
