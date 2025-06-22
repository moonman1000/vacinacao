<?php
session_start();



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

// Obtém os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Criptografa a senha

// Query para inserir um novo administrador
$sql_insert = "INSERT INTO administradores (nome, email, senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("sss", $nome, $email, $senha);

if ($stmt->execute()) {
    echo "Administrador cadastrado com sucesso.";
} else {
    echo "Erro ao cadastrar administrador: " . $stmt->error;
}

// Fecha a conexão com o banco de dados
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Administrador</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card card-login mx-auto text-center bg-dark mt-5">
            <div class="card-body">
                <a href="cadastro_administrador.php" class="btn btn-outline-primary btn-custom">Voltar</a>
                <a href="index.php" class="btn btn-outline-primary btn-custom">Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
