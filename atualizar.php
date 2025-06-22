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

// Recebendo os dados do formulário
$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$idade = $_POST['idade'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$vacinadoGripe = isset($_POST['vacinado_gripe']) ? 'Sim' : 'Não';
$vacinadoCovid = isset($_POST['vacinado_covid']) ? 'Sim' : 'Não';

// Validação básica
if ($id && $nome && $idade && $telefone) {
    // Query para atualizar o usuário
    $sql_update = "UPDATE usuarios SET nome=?, idade=?, telefone=?, vacinado_gripe=?, vacinado_covid=? WHERE id=?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("sisssi", $nome, $idade, $telefone, $vacinadoGripe, $vacinadoCovid, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Dados atualizados com sucesso'); window.location.href='visualizar.php';</script>";
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
