<?php
echo "<h2>Consultar Funcionários</h2>";
echo "<form method='GET' action='consultar.php'>";
echo "  <label>Digite o Nome:</label> ";
echo "  <input type='text' name='nome' placeholder='Ex: Maria'> ";
echo "  <input type='submit' value='Buscar'>";
echo "</form><hr>";

$servidor = 'localhost';
$usuario  = 'root';
$senha    = 'Home@spSENAI2025!';
$banco    = 'empresa1';

$conexao = new mysqli($servidor, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die('Falha na conexão: ' . $conexao->connect_error);
}

if (isset($_GET['nome']) && $_GET['nome'] !== '') {
    $busca = $_GET['nome'];
    $sql = "SELECT * FROM funcionarios WHERE nome LIKE '%$busca%'";
    $resultado = $conexao->query($sql);

    echo "<h3>Resultados Encontrados:</h3>";
    if ($resultado && $resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            echo "ID: " . $linha['idfunc'] . 
                 " - Nome: " . $linha['nome'] . 
                 " - Função: " . $linha['funcao'] . 
                 " - CPF: " . $linha['cpf'] . "<br>";
        }
    } else {
        echo "Nenhum funcionário encontrado.";
    }
}

$conexao->close();
?>