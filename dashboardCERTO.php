<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .button {
            display: block;
            width: 93%;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>PARÔQUIA NOSSA SENHORA DE FÁTIMA<br>Cadastro de Membros<br>Vacinação</br></h2>
        <a href="formulario.php" class="button">Inserir Dados</a>
        <a href="visualizar.php" class="button">Administrador</a>
     
    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</body>
</html>
