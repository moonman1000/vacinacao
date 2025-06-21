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
$email = $_POST['email'];
$senha = $_POST['senha'];

// Query para verificar se o administrador existe
$sql_select = "SELECT * FROM administradores WHERE email = ?";
$stmt = $conn->prepare($sql_select);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    // Verifica a senha
    if (password_verify($senha, $row['senha'])) {
        // Inicia a sessão e define variáveis de sessão
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_role'] = 'admin';

        // Redireciona para o dashboard
        header("location: dashboard.php");
    } else {
        // Senha incorreta
        echo "Senha incorreta.";
    }
} else {
    // Usuário não encontrado
    echo "Usuário não encontrado.";
}

// Fecha a conexão com o banco de dados
$stmt->close();
$conn->close();
?>
