<?php
session_start();

// Configuração do banco de dados usando variáveis de ambiente
$servername = getenv('DB_HOST');
$username   = getenv('DB_USER');
$password   = getenv('DB_PASSWORD');
$dbname     = getenv('DB_NAME');
$port       = getenv('DB_PORT'); // Adicione esta variável no Render

// Conexão ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificação da conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query para buscar o usuário
    $sql = "SELECT id, username, password FROM usuarios_login WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();
        
        if (password_verify($password, $hashed_password)) {
            // Senha está correta, iniciar sessão
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;

            header("location: visualiza.php");
        } else {
            // Senha incorreta
            echo "<script>alert('Senha incorreta.'); window.location.href='login.php';</script>";
        }
    } else {
        // Usuário não encontrado
        echo "<script>alert('Usuário não encontrado.'); window.location.href='login.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>

