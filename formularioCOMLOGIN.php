<?php
// Iniciar a sessão no início do script PHP, antes de qualquer saída HTML
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Vacinação</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .container input[type="text"],
        .container input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .container button:hover {
            background-color: #45a049;
        }
        .container label {
            display: block;
            text-align: left;
            margin: 5px 0;
        }
        .container input[type="checkbox"] {
            margin-right: 10px;
        }
        .button {
            display: block;
            width: 16%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin-top: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }
        .button:hover {
            background-color: #45a049;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
    <script>
        // Função para validar entrada no campo nome
        function validarNome(event) {
            const input = event.target;
            const valor = input.value.trim();
            
            // Verifica se o valor contém números ou começa com números
            if (/\d/.test(valor) || /^\d/.test(valor)) {
                input.setCustomValidity('O nome não pode conter números.');
            } else {
                input.setCustomValidity('');
            }
        }

        // Função para formatar e limitar o número de dígitos no campo de telefone
        function formatarTelefone(event) {
            const input = event.target;
            let valor = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
            let formattedValue = '';

            // Limita o número de dígitos após o código de área
            if (valor.length > 11) {
                valor = valor.slice(0, 11); // Limita para 11 dígitos no total (2 do código de área + 9 do número)
            }

            if (valor.length > 2) {
                formattedValue = `(${valor.substring(0, 2)}) ${valor.substring(2, 11)}`;
            } else if (valor.length > 0) {
                formattedValue = `(${valor}`;
            }

            input.value = formattedValue;
        }

        // Função para limitar a quantidade de dígitos no campo de idade
        function limitarIdade(event) {
            const input = event.target;
            if (input.value.length > 3) {
                input.value = input.value.slice(0, 3); // Limita para no máximo 3 dígitos
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Vacinação</h2>
        <?php
        if (isset($_GET['insert_success']) && $_GET['insert_success'] == 'true') {
            echo "<div class='success-message'>Cadastro realizado com sucesso!</div>";
        }
        ?>
        <form action="processa.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required oninput="validarNome(event)">

            <label for="idade">Idade:</label>
            <input type="number" id="idade" name="idade" required oninput="limitarIdade(event)">

            <label for="telefone">Telefone:</label>
            <input type="text" id="telefone" name="telefone" pattern="\(\d{2}\) \d{9}" title="Por favor, insira um telefone válido com o formato (99) 999999999" oninput="formatarTelefone(event)" required>

            <label for="vacinado_gripe">Vacinado contra Gripe:</label>
            <input type="checkbox" id="vacinado_gripe" name="vacinado_gripe" value="Sim">

            <label for="vacinado_covid">Vacinado contra Covid-19:</label>
            <input type="checkbox" id="vacinado_covid" name="vacinado_covid" value="Sim">

            <button type="submit">Enviar</button>
        </form>

        <a href="dashboard.php" class="button">Voltar</a>
    </div>
</body>
</html>


