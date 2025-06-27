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
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #343a40; /* cinza escuro */
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            background: rgba(255,255,255,0.04);
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.2);
            padding-bottom: 30px;
        }

        h2 {
            color: #fff;
            text-align: center;
            margin: 30px 0 30px 0;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .table-responsive {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.08);
            min-width: 600px;
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            padding: 14px 18px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
            white-space: nowrap;
        }

        th {
            background-color: #495057;
            color: #fff;
            font-weight: 600;
            border-bottom: 2px solid #343a40;
        }

        tr:nth-child(even) {
            background-color: #f5f8fa;
        }

        tr:last-child td {
            border-bottom: none;
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
            h2 {
                color: #000 !important;
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
                min-width: 600px;
            }
        }
    </style>
</head>
<body>
<div class="container py-3">
    <a href="logout.php" class="btn btn-light w-100 mb-2 no-print">Logout</a>
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

    // Query para selecionar todos os membros
    $sql_select = "SELECT * FROM membros ORDER BY nome ASC";
    $result = $conn->query($sql_select);

    // Verificação se há resultados a exibir
    echo "<div class='container px-0'>";
    if ($result->num_rows > 0) {
        echo "<h2>PARÔQUIA NOSSA SENHORA DE FÁTIMA<br>Membros Cadastrados<br>Vacinação</h2>";
        echo "<div class='table-responsive'>";
        echo "<table class='table align-middle'>";
        echo "<thead><tr>
                <th>Nome</th>
                <th>Idade</th>
                <th>Telefone</th>
                <th class='centered'>Vacinado contra Gripe</th>
                <th class='centered'>Vacinado contra Covid-19</th>
                <th class='actions-col no-print'>Ações</th>
              </tr></thead><tbody>";
        // Loop pelos resultados para exibição
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
            echo "<td class='centered'>" . htmlspecialchars($row['idade']) . "</td>";
            echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
            echo "<td class='centered'>" . htmlspecialchars($row['vacinado_gripe']) . "</td>";
            echo "<td class='centered'>" . htmlspecialchars($row['vacinado_covid']) . "</td>";
            echo "<td class='actions-col no-print'>";
            echo "<a href='edita.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm me-1 mb-1'>Editar</a>";
            echo "<a href='deleta.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm mb-1' onclick='return confirm(\"Tem certeza que deseja deletar este registro?\")'>Deletar</a>";
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</div>"; // fecha .table-responsive
        echo "<a href='index.php' class='btn btn-outline-light w-100 mb-2 no-print'>Voltar</a>";
        echo "<a href='cadastro_administrador.php' class='btn btn-primary w-100 mb-2 no-print'>Cadastrar Administrador</a>";
        echo "<a href='administradores.php' class='btn btn-primary w-100 mb-2 no-print'>Administradores Cadastrados</a>";
        echo "<button onclick='window.print()' class='btn btn-success w-100 mb-2 no-print'>Imprimir</button>";
    } else {
        echo "<p class='text-white'>Nenhum usuário cadastrado.</p>";
        echo "<a href='index.php' class='btn btn-outline-light w-100 mb-2 no-print'>Voltar</a>";
    }
    echo "</div>";

    // Fechamento da conexão com o banco de dados
    $conn->close();
    ?>
</div>
</body>
</html>
