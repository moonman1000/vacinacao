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
    <title>Administradores Cadastrados</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
        }

        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            min-width: 400px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            white-space: nowrap;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .centered {
            text-align: center;
        }

        /* Oculta botões e colunas de ação na impressão */
        @media print {
            .no-print, .no-print * {
                display: none !important;
            }
            .actions-col {
                display: none !important;
            }
            body {
                background: #fff !important;
            }
            .container, .table-responsive, table {
                box-shadow: none !important;
                background: #fff !important;
            }
        }

        @media (max-width: 600px) {
            .container {
                width: 98%;
                margin: 5px auto;
                padding: 0 2px;
            }
            .table-responsive {
                width: 100%;
                overflow-x: auto;
            }
            table {
                min-width: 400px;
            }
        }
    </style>
</head>
<body>
<div class="container py-3">
    <a href="logout.php" class="btn btn-danger w-100 mb-2 no-print">Logout</a>
    <?php
    // Configuração do banco de dados usando variáveis de ambiente
    $servername = getenv('DB_HOST');
    $username   = getenv('DB_USER');
    $password   = getenv('DB_PASSWORD');
    $dbname     = getenv('DB_NAME');
    $port       = getenv('DB_PORT');

    // Conexão ao banco de dados (incluindo a porta)
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Verificação da conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Query para selecionar todos os administradores
    $sql_select = "SELECT * FROM administradores ORDER BY nome ASC";
    $result = $conn->query($sql_select);

    echo "<div class='container px-0'>";
    if ($result && $result->num_rows > 0) {
        echo "<h2>Administradores Cadastrados</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table align-middle'>";
        echo "<thead><tr>
                <th>Nome</th>
                <th>Email</th>
                <th class='actions-col no-print'>Ações</th>
              </tr></thead><tbody>";
        // Loop pelos resultados para exibição
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
            echo "<td class='actions-col no-print'>";
            echo "<a href='edita_administrador.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm me-1 mb-1'>Editar</a>";
            echo "<a href='deleta_administrador.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm mb-1' onclick='return confirm(\"Tem certeza que deseja deletar este administrador?\")'>Deletar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</div>"; // fecha .table-responsive
        echo "<a href='visualiza.php' class='btn btn-secondary w-100 mb-2 no-print'>Voltar</a>";
        echo "<a href='cadastro_administrador.php' class='btn btn-primary w-100 mb-2 no-print'>Cadastrar Administrador</a>";
        echo "<button onclick='window.print()' class='btn btn-success w-100 mb-2 no-print'>Imprimir</button>";
    } else {
        echo "<h2>Administradores Cadastrados</h2>";
        echo "<p>Nenhum administrador cadastrado.</p>";
        echo "<a href='index.php' class='btn btn-secondary w-100 mb-2 no-print'>Voltar</a>";
        echo "<a href='cadastro_administrador.php' class='btn btn-primary w-100 mb-2 no-print'>Cadastrar Administrador</a>";
    }
    echo "</div>";

    // Fechamento da conexão com o banco de dados
    $conn->close();
    ?>
</div>
</body>
</html>