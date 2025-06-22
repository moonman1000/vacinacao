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
$idade = $_POST['idade'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$vacinadoGripe = isset($_POST['vacinado_gripe']) ? 'Sim' : 'Não';
$vacinadoCovid = isset($_POST['vacinado_covid']) ? 'Sim' : 'Não';

// Validação básica
if ($id && $nome && $idade && $telefone) {
    // Query para atualizar o membro
    $sql_update = "UPDATE membros SET nome=?, idade=?, telefone=?, vacinado_gripe=?, vacinado_covid=? WHERE id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sisssi", $nome, $idade, $telefone, $vacinadoGripe, $vacinadoCovid, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso'); window.location.href='visualiza.php';</script>";
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
