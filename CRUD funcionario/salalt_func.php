<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Alterar Funcionário</title>
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
$novo_nome = $_POST['nome'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($cpf) && !empty($novo_nome)) {
    $stmt = $conexao->prepare("UPDATE funcionarios SET nome = ? WHERE cpf = ?");
    $stmt->bind_param("ss", $novo_nome, $cpf);

    if ($stmt->execute()) {
        echo "<h2>Dados Atualizados com Sucesso!</h2>";
        echo "<p><strong>Cadastro Final no Banco:</strong></p>";
        echo "CPF: " . htmlspecialchars($cpf) . "<br>";
        echo "Nome: " . htmlspecialchars($novo_nome) . "<br><br>";
        echo '<a href="alt_func.php">Voltar para a busca</a>';
    } else {
        echo "Erro ao atualizar: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Requisição inválida ou dados ausentes.";
}
$conexao->close();
?>
