<?php
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

// Recebe os dados do formulário
$nome = $_POST['nome'] ?? '';
$idade = $_POST['idade'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$vacinadoGripe = isset($_POST['vacinado_gripe']) ? 'Sim' : 'Não';
$vacinadoCovid = isset($_POST['vacinado_covid']) ? 'Sim' : 'Não';

// Validação dos campos obrigatórios
if (empty($nome) || empty($idade) || empty($telefone)) {
    echo "Por favor, preencha todos os campos obrigatórios.";
    $conn->close();
    exit();
}

// Prepara a consulta SQL para inserir os dados
$sql_insert = "INSERT INTO membros (nome, idade, telefone, vacinado_gripe, vacinado_covid) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("sisss", $nome, $idade, $telefone, $vacinadoGripe, $vacinadoCovid);

// Executa a consulta e verifica se foi bem-sucedida
if ($stmt->execute()) {
    header("Location: formulario.php?insert_success=true");
    exit();
} else {
    echo "Erro ao inserir os dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$stmt->close();
$conn->close();
?>