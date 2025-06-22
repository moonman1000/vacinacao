<?php
// Configuração do banco de dados usando variáveis de ambiente
$servername = getenv('DB_HOST');
$username   = getenv('DB_USER');
$password   = getenv('DB_PASSWORD');
$dbname     = getenv('DB_NAME');
$port       = getenv('DB_PORT');
$conn = new mysqli($servername, $username, $password, $dbname, $port);

// Verificação da conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar se o usuário já existe
    $sql_check = "SELECT id FROM usuarios_login WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        echo "<script>alert('Nome de usuário já existe.'); window.location.href='register.php';</script>";
        $stmt_check->close();
        $conn->close();
        exit;
    }

    $stmt_check->close();

    // Hash da senha
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inserir o novo usuário
    $sql_insert = "INSERT INTO usuarios_login (username, password) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ss", $username, $hashed_password);

    if ($stmt_insert->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
        exit;
    } else {
        echo "Erro: " . $sql_insert . "<br>" . $conn->error;
    }

    $stmt_insert->close();
}

$conn->close();
?>