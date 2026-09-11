<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/style.css">
  <title>Consultar Funcionários</title>
</head>

<body>
  <footer class="rodape-fogo"></footer>
</body>
</html>

<?php
echo "<h2>Consultar Funcionários</h2>";
echo "<form method='GET' action='con_func.php'>";
echo "  <label>Digite o Nome:</label> ";
echo "  <input type='text' name='nome' placeholder='Digite o nome'> <br><br>";
echo "  <input type='submit' value='Buscar'>";
echo "</form>";

if (isset($_GET['nome'])) {
    $nome = $_GET['nome'] ?? '';

    $conexao = new mysqli("localhost", "root", "", "nexus_db");

    if ($conexao->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }

    $sql = "SELECT * FROM funcionarios WHERE nome LIKE '%$nome%'";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        echo "<h3>Resultados da Busca:</h3>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nome</th><th>Matrícula</th><th>Função</th><th>Departamento</th><th>Idade</th><th>CPF</th><th>RG</th><th>Salário</th><th>Endereço</th><th>UF</th><th>País</th></tr>";

        while ($row = $resultado->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['id_func'] . "</td>"; 
            echo "<td>" . $row['nome'] . "</td>";
            echo "<td>" . $row['matricula'] . "</td>";
            echo "<td>" . $row['funcao'] . "</td>";
            echo "<td>" . $row['departamento'] . "</td>";
            echo "<td>" . $row['idade'] . "</td>";
            echo "<td>" . $row['cpf'] . "</td>";
            echo "<td>" . $row['rg'] . "</td>";
            echo "<td>" . $row['salario'] . "</td>";
            echo "<td>" . $row['endereco'] . "</td>";
            echo "<td>" . $row['uf'] . "</td>";
            echo "<td>" . $row['pais'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhum funcionário encontrado com o nome '$nome'.";
    }

    $conexao->close();
}
?>