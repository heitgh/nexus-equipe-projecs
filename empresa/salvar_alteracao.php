<?php
$conexao = new mysqli('localhost', 'root', 'Home@spSENAI2025!', 'empresa1');

$cpf = $_POST['cpf'];
$novo_nome = $_POST['nome'];

$sql_update = "UPDATE funcionarios SET nome = '$novo_nome' WHERE cpf = '$cpf'";

if ($conexao->query($sql_update) === TRUE) {
    echo "<h2 style='color:#16a34a;'>Dados Atualizados com Sucesso!</h2>";
    echo "<p><strong>Cadastro Final no Banco:</strong></p>";
    echo "CPF: " . $cpf . "<br>";
    echo "Nome: " . $novo_nome . "<br>";
} else {
    echo "Erro ao atualizar: " . $conexao->error;
}
$conexao->close();
?>