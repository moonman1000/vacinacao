<<<<<<< HEAD
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

// Verifica se o ID foi enviado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query para deletar o usuário com o ID fornecido
    $sql_delete = "DELETE FROM usuarios WHERE id = ?";
    
    // Preparar a declaração
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário deletado com sucesso.'); window.location.href='visualizar.php';</script>";
    } else {
        echo "Erro ao deletar usuário: " . $conn->error;
    }

    // Fechar a declaração
    $stmt->close();
} else {
    echo "ID não fornecido.";
}

// Fechamento da conexão com o banco de dados
$conn->close();
?>

=======
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

// Verifica se o ID foi enviado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query para deletar o usuário com o ID fornecido
    $sql_delete = "DELETE FROM usuarios WHERE id = ?";
    
    // Preparar a declaração
    $stmt = $conn->prepare($sql_delete);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Usuário deletado com sucesso.'); window.location.href='visualizar.php';</script>";
    } else {
        echo "Erro ao deletar usuário: " . $conn->error;
    }

    // Fechar a declaração
    $stmt->close();
} else {
    echo "ID não fornecido.";
}

// Fechamento da conexão com o banco de dados
$conn->close();
?>

>>>>>>> 68221b35f241cb4d8c71073fab7709096587fc5d
