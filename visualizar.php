
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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <style>
        .table-responsive {
            margin-top: 20px;
        }

        .table td, .table th {
            color: white;
            text-align: left; /* Alinha o texto à esquerda */
        }

        .table .centered {
            text-align: center; /* Alinha o texto ao centro */
        }

        .btn-custom {
            display: block;
            width: 150px;
            margin: 10px auto;
            padding: 10px;
            text-align: center;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn-custom:hover {
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

        .card-header img {
            max-width: 50%;
        }

        .card-header .logo_title {
            color: #fff;
            font-size: 1.5rem;
            margin-top: 10px;
        }

        @media print {
            .actions-col, .btn-custom {
                display: none;
            }

            .table td, .table th {
                color: black !important;
            }
        }
        
        .text-left {
            text-align: left; /* Alinha o texto à esquerda */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card card-login mx-auto text-center bg-dark">
            <div class="card-header mx-auto bg-dark">
                <span class="logo_title mt-5">PARÔQUIA NOSSA SENHORA DE FÁTIMA<br>Membros Cadastrados<br>Vacinação</span>
            </div>
            <div class="card-body">
                <a href="logout.php" class="btn btn-outline-danger btn-custom">Sair</a>
                <div class="table-responsive">
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

                    // Query para selecionar todos os usuários em ordem alfabética
                    $sql_select = "SELECT * FROM usuarios ORDER BY nome ASC";
                    $result = $conn->query($sql_select);

                    // Contagem de registros
                    $total_registros = $result->num_rows;

                    // Verificação se há resultados a exibir
                    if ($total_registros > 0) {
                        echo "<h5 class='text-white text-left'>Total de registros: $total_registros</h5>";
                        echo "<table class='table table-striped bg-dark'>";
                        echo "<thead class='thead-dark'><tr><th>Nome</th><th>Idade</th><th>Telefone</th><th class='centered'>Vacinado contra Gripe</th><th class='centered'>Vacinado contra Covid-19</th><th class='actions-col'>Ações</th></tr></thead>";
                        echo "<tbody>";
                        // Loop pelos resultados para exibição
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['nome']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['idade']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['telefone']) . "</td>";
                            echo "<td class='centered'>" . htmlspecialchars($row['vacinado_gripe']) . "</td>";
                            echo "<td class='centered'>" . htmlspecialchars($row['vacinado_covid']) . "</td>";
                            echo "<td class='actions-col'>";
                            echo "<a href='editar.php?id=" . $row['id'] . "' class='edit-btn'>Editar</a> ";
                            echo "<a href='deletar.php?id=" . $row['id'] . "' class='delete-btn' onclick='return confirm(\"Tem certeza que deseja deletar este registro?\")'>Deletar</a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        echo "<a href='dashboard.php' class='btn btn-outline-primary btn-custom'>Voltar</a>";
                        echo "<button onclick='window.print()' class='btn btn-outline-info btn-custom'>Gerar Relatório</button>";
                    } else {
                        echo "<p class='text-white'>Nenhum usuário cadastrado.</p>";
                        echo "<a href='index.php' class='btn btn-outline-primary btn-custom'>Voltar</a>";
                    }

                    // Fechamento da conexão com o banco de dados
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


