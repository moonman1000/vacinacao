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
    <!-- ... (restante do head igual ao seu) ... -->
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

                    // Query para selecionar todos os usuários em ordem alfabética
                    $sql_select = "SELECT * FROM usuarios ORDER BY nome ASC";
                    $result = $conn->query($sql_select);

                    // Contagem de registros
                    $total_registros = $result ? $result->num_rows : 0;

                    // Verificação se há resultados a exibir
                    if ($total_registros > 0) {
                        echo "<h5 class='text-white text-left'>Total de registros: $total_registros</h5>";
                        echo "<table class='table table-striped bg-dark'>";
                        echo "<thead class='thead-dark'><tr><th>Nome</th><th>Idade</th><th>Telefone</th><th class='centered'>Vacinado contra Gripe</th><th class='centered'>Vacinado contra Covid-19</th><th class='actions-col'>Ações</th></tr></thead>";
                        echo "<tbody>";
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

                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


