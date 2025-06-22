<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Cadastrados</title>
    <style>
        /* Estilos CSS omitidos para brevidade */
    </style>
</head>
<body>
<div class="container">
    <?php
    // Configuração do banco de dados
    $servername = "localhost"; // ou o endereço do seu servidor MySQL
    $username = "root";
    $password = "";
    $dbname = "cadastro_vacinacao";

    // Conexão ao banco de dados
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificação da conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Query para selecionar todos os usuários
    $sql_select = "SELECT * FROM usuarios";
    $result = $conn->query($sql_select);

    // Verificação se há resultados a exibir
    echo "<div class='container'>";
    if ($result->num_rows > 0) {
        echo "<h2>Membros Cadastrados</h2>";
        echo "<table>";
        echo "<tr><th>Nome</th><th>Idade</th><th>Telefone</th><th>Vacinado contra Gripe</th><th>Vacinado contra Covid-19</th><th class='actions-col'>Ações</th></tr>";
        // Loop pelos resultados para exibição
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['idade']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
            echo "<td>" . htmlspecialchars($row['vacinado_gripe']) . "</td>";
            echo "<td>" . htmlspecialchars($row['vacinado_covid']) . "</td>";
            echo "<td class='actions-col'>";
            echo "<a href='editar.php?id=" . $row['id'] . "' class='edit-btn'>Editar</a> ";
            echo "<a href='deletar.php?id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Tem certeza que deseja deletar este registro?\")'>Deletar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='logout.php' class='return-btn'>Sair</a>"; // Adicionando o link de logout
        echo "<button onclick='window.print()' class='print-btn'>Imprimir</button>";
    } else {
        echo "<p>Nenhum usuário cadastrado.</p>";
    }
    echo "</div>";

    // Fechamento da conexão com o banco de dados
    $conn->close();
    ?>
</div>
<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
