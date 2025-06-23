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

// Verificação se o ID foi passado como parâmetro
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Query para selecionar o membro com o ID especificado (usando prepared statement)
    $sql_select = "SELECT * FROM membros WHERE id = ?";
    $stmt = $conn->prepare($sql_select);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificação se o membro existe
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Membro não encontrado.";
        $stmt->close();
        $conn->close();
        exit;
    }
    $stmt->close();
} else {
    echo "ID inválido.";
    $conn->close();
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Membro</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .card-edit {
            max-width: 600px;
            width: 100%;
            margin: auto;
            border: none;
        }
        .card-header {
            text-align: center;
        }
        .logo_title {
            color: #fff;
            font-size: 1.5rem;
            margin-top: 20px;
        }
        .input-group-prepend .input-group-text {
            background-color: #fff;
        }
        .edit_btn {
            background-color: #dc3545;
            color: #fff;
        }
        .edit_btn:hover {
            background-color: #c82333;
        }
        .form-label {
            font-weight: bold;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-custom {
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
        .btn-outline-custom {
            color: #4CAF50;
            border-color: #4CAF50;
        }
        .btn-outline-custom:hover {
            color: white;
            background-color: #4CAF50;
            border-color: #4CAF50;
        }
        .label-white {
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card card-edit mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span class="logo_title mt-5">Editar Membro</span>
        </div>
        <div class="card-body">
            <form action="atualiza.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $id; ?>">

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-birthday-cake"></i></span>
                    </div>
                    <input type="number" id="idade" name="idade" class="form-control" placeholder="Idade" value="<?php echo htmlspecialchars($row['idade']); ?>" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" id="telefone" name="telefone" class="form-control" placeholder="Telefone" value="<?php echo htmlspecialchars($row['telefone']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="vacinado_gripe" class="form-label label-white">Vacinado contra Gripe:</label>
                    <input type="checkbox" id="vacinado_gripe" name="vacinado_gripe" value="Sim" <?php echo ($row['vacinado_gripe'] == 'Sim') ? 'checked' : ''; ?>>
                </div>

                <div class="form-group">
                    <label for="vacinado_covid" class="form-label label-white">Vacinado contra Covid-19:</label>
                    <input type="checkbox" id="vacinado_covid" name="vacinado_covid" value="Sim" <?php echo ($row['vacinado_covid'] == 'Sim') ? 'checked' : ''; ?>>
                </div>

                <div class="form-group">
                    <input type="submit" name="btn" value="Atualizar" class="btn btn-outline-danger float-right edit_btn">
                </div>

                <div class="form-group">
                    <a href="visualiza.php" class="btn btn-outline-light float-left">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>


