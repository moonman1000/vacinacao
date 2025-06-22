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
    <title>PARÔQUIA NOSSA SENHORA DE FÁTIVA<<br>Membros Cadastrados</br></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            width: 80%;
            margin: 20px auto;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .return-btn, .print-btn, .logout-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .return-btn:hover, .print-btn:hover, .logout-btn:hover {
            background-color: #45a049;
        }

        .edit-btn {
            background-color: #FFA500;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            padding: 6px 12px;
            text-decoration: none;
        }

        .edit-btn:hover {
            background-color: #FF8C00;
        }

        .delete-btn {
            background-color: #FF0000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            padding: 6px 12px;
            text-decoration: none;
        }

        .delete-btn:hover {
            background-color: #CC0000;
        }

        @media print {
            .actions-col {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <a href="logout.php" class="logout-btn">Sair</a>
    <?php
    // Configuração do banco de dados usando variáveis de ambiente
                    $servername = getenv('DB_HOST');
                    $username   = getenv('DB_USER');
                    $password   = getenv('DB_PASSWORD');
                    $dbname     = getenv('DB_NAME');
                    $port       = getenv('DB_PORT');

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
        echo "<h2>PARÔQUIA NOSSA SENHORA DE FÁTIMA<br>Membros Cadastrados</br></h2>";
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
        echo "<a href='dashboard.php' class='return-btn'>Voltar</a>";
        echo "<button onclick='window.print()' class='print-btn'>Imprimir</button>";
    } else {
        echo "<p>Nenhum usuário cadastrado.</p>";
        echo "<a href='dashboard.php' class='return-btn'>Voltar</a>";
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
