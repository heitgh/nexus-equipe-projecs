<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>cadastrar Funcionário</title>
</head>
<body>
    <footer class="rodape-fogo"></footer>
</body>
</html>

<?php

$conexao = new mysqli("localhost", "root", "", "nexus_db");

if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

$nome = $_POST['nome'];
$matricula = $_POST['matricula'];
$funcao = $_POST['funcao'];
$departamento = $_POST['departamento'];
$idade = $_POST['idade'];
$cpf = $_POST['cpf'];
$rg = $_POST['rg'];
$salario  = $_POST['salario'] ?? 0.00;
$endereco = $_POST['endereco'] ?? '';
$uf = $_POST['uf'];
$pais = $_POST['pais'];

$sql = "INSERT INTO funcionarios (nome, matricula, funcao, departamento, idade, cpf, rg, salario, endereco, uf, pais) 
        VALUES ('$nome', '$matricula', '$funcao', '$departamento', '$idade', '$cpf', '$rg', '$salario', '$endereco', '$uf', '$pais')";

if ($conexao->query($sql) === TRUE) {
    echo "Funcionário cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar funcionário.";
};

$conexao->close();

?>