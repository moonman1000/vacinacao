<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card-dashboard {
            max-width: 500px;
            width: 100%;
            border: none;
        }
        .card-header {
            text-align: center;
        }
        .logo_title {
            color: #fff;
            font-size: 1.5rem;
            margin-top: 20px;
        }
        .btn-custom {
            background-color: #4CAF50;
            color: white;
            width: 100%;
            padding: 14px;
            margin-top: 20px;
            border-radius: 4px;
            font-size: 16px;
        }
        .btn-custom:hover {
            background-color: #45a049;
        }
        .logo {
            max-width: 100px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card card-dashboard mx-auto text-center bg-dark">
            <div class="card-header mx-auto bg-dark">
                
                <span class="logo_title mt-5">PARÔQUIA NOSSA SENHORA DE FÁTIMA<br>Cadastro de Membros<br>Vacinação</span>
            </div>
            <div class="card-body">
                <a href="formulario.php" class="btn btn-outline-success btn-custom">Fazer o Cadastro</a>
                <a href="visualizar.php" class="btn btn-outline-primary btn-custom">Administrador</a>
            </div>
        </div>
    </div>
</body>
</html>


