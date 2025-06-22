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

// Recebe os dados do formulário
$nome = $_POST['nome'] ?? '';
$idade = $_POST['idade'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$vacinadoGripe = isset($_POST['vacinado_gripe']) ? 'Sim' : 'Não';
$vacinadoCovid = isset($_POST['vacinado_covid']) ? 'Sim' : 'Não';

// Prepara a consulta SQL para inserir os dados
$sql_insert = "INSERT INTO usuarios (nome, idade, telefone, vacinado_gripe, vacinado_covid) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("sisss", $nome, $idade, $telefone, $vacinadoGripe, $vacinadoCovid);

// Executa a consulta e verifica se foi bem-sucedida
if ($stmt->execute()) {
    header("Location: ".$_SERVER['HTTP_REFERER']."?insert_success=true");
    exit();
} else {
    echo "Erro ao inserir os dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$stmt->close();
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

// Recebe os dados do formulário
$nome = $_POST['nome'] ?? '';
$idade = $_POST['idade'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$vacinadoGripe = isset($_POST['vacinado_gripe']) ? 'Sim' : 'Não';
$vacinadoCovid = isset($_POST['vacinado_covid']) ? 'Sim' : 'Não';

// Prepara a consulta SQL para inserir os dados
$sql_insert = "INSERT INTO usuarios (nome, idade, telefone, vacinado_gripe, vacinado_covid) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql_insert);
$stmt->bind_param("sisss", $nome, $idade, $telefone, $vacinadoGripe, $vacinadoCovid);

// Executa a consulta e verifica se foi bem-sucedida
if ($stmt->execute()) {
    header("Location: ".$_SERVER['HTTP_REFERER']."?insert_success=true");
    exit();
} else {
    echo "Erro ao inserir os dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$stmt->close();
$conn->close();
?>

>>>>>>> 68221b35f241cb4d8c71073fab7709096587fc5d
