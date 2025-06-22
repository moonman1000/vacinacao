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

// Verifica se o ID foi enviado via GET e é numérico
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Query para deletar o membro com o ID fornecido
    $sql_delete = "DELETE FROM membros WHERE id = ?";
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Membro deletado com sucesso.'); window.location.href='visualiza.php';</script>";
    } else {
        echo "Erro ao deletar membro: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID não fornecido ou inválido.";
}

// Fechamento da conexão com o banco de dados
$conn->close();
?>

