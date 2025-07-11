<?php
session_start();

// Configuração do banco de dados usando variáveis de ambiente
$servername = getenv('DB_HOST');
$username   = getenv('DB_USER');
$password   = getenv('DB_PASSWORD');
$dbname     = getenv('DB_NAME');
$port       = getenv('DB_PORT'); // Adicione esta variável no Render

// Conexão ao banco de dados (incluindo a porta)
$conn = new mysqli($servername, $username, $password, $dbname, $port);

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

        // Redireciona para a página de visualização
        header("location: visualiza.php");
        exit;
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
