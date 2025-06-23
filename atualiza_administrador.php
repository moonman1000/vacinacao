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

// Recebendo os dados do formulário
$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';

// Validação básica
if ($id && $nome && $email) {
    // Query para atualizar o administrador
    $sql_update = "UPDATE administradores SET nome=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ssi", $nome, $email, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dados do administrador atualizados com sucesso'); window.location.href='listar_administradores.php';</script>";
    } else {
        echo "Erro ao atualizar dados: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Dados inválidos.";
}

// Fechamento da conexão com o banco de dados
$conn->close();
?>