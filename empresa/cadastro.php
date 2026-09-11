<?php

$nome         = $_POST['nome'] ?? '';
$matricula    = $_POST['matricula'] ?? '';
$funcao       = $_POST['funcao'] ?? '';
$departamento = $_POST['departamento'] ?? '';
$idade        = $_POST['idade'] ?? '';
$cpf          = $_POST['cpf'] ?? '';
$rg           = $_POST['rg'] ?? '';
$salario      = $_POST['salario'] ?? '';
$endereco     = $_POST['endereco'] ?? '';
$uf           = $_POST['uf'] ?? '';
$pais         = $_POST['pais'] ?? ''; 

$servidor = 'localhost';
$usuario  = 'root';
$senha    = 'Home@spSENAI2025!';
$banco    = 'empresa1';

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die('Falha na conexão: ' . $conexao->connect_error);
}


$sql = "INSERT INTO funcionarios (nome, matricula, funcao, departamento, idade, cpf, rg, salario, endereco, uf, pais) 
        VALUES ('$nome', '$matricula', '$funcao', '$departamento', '$idade', '$cpf', '$rg', '$salario', '$endereco', '$uf', '$pais')";

if ($conexao->query($sql) === TRUE) {
    echo "<h2>Funcionário cadastrado com sucesso!</h2>";
    echo "<p>Dados registrados:</p>";
    echo "Nome: " . $nome . "<br>";
    echo "Matrícula: " . $matricula . "<br>";
    echo "Função: " . $funcao . "<br>";
    echo "Departamento: " . $departamento . "<br>";
    echo "Idade: " . $idade . " anos<br>";
    echo "CPF: " . $cpf . "<br>";
    echo "RG: " . $rg . "<br>";
    echo "Salario: " . $salario . "<br>";
    echo "Endereço: " . $endereco . "<br>";
    echo "UF: " . $uf . "<br>";
    echo "País: " . $pais . "<br>";
} else {
    echo "Erro ao cadastrar: " . $conexao->error;
}