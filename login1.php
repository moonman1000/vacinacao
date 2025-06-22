<<<<<<< HEAD
<?php
session_start();

// Defina as credenciais do administrador
$admin_username = "admin";
$admin_password = "1234"; // Altere para uma senha segura

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifique as credenciais do administrador
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: visualizar.php");
        exit;
    } else {
        $login_error = "Nome de usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Administrador</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-login {
            max-width: 400px;
            width: 100%;
            margin: auto;
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

        .input-group-prepend .input-group-text {
            background-color: #fff;
        }

        .login_btn {
            background-color: #dc3545;
            color: #fff;
        }

        .login_btn:hover {
            background-color: #c82333;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
           
            <span class="logo_title mt-5"> Acesso Administrador </span>
        </div>
        <div class="card-body">
            <?php
            if (isset($login_error)) {
                echo "<p class='error'>$login_error</p>";
            }
            ?>
            <form action="login.php" method="post">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="Nome de usuário" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Senha" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="btn" value="Entrar" class="btn btn-outline-danger float-right login_btn">
                </div>

                <div class="form-group">
                    <a href="dashboard.php" class="btn btn-outline-light float-left">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
=======
<?php
session_start();

// Defina as credenciais do administrador
$admin_username = "admin";
$admin_password = "1234"; // Altere para uma senha segura

// Verifique se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifique as credenciais do administrador
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("location: visualizar.php");
        exit;
    } else {
        $login_error = "Nome de usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Administrador</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <style>
        body {
            background-color: #f5f5f5;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card-login {
            max-width: 400px;
            width: 100%;
            margin: auto;
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

        .input-group-prepend .input-group-text {
            background-color: #fff;
        }

        .login_btn {
            background-color: #dc3545;
            color: #fff;
        }

        .login_btn:hover {
            background-color: #c82333;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
           
            <span class="logo_title mt-5"> Acesso Administrador </span>
        </div>
        <div class="card-body">
            <?php
            if (isset($login_error)) {
                echo "<p class='error'>$login_error</p>";
            }
            ?>
            <form action="login.php" method="post">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="username" class="form-control" placeholder="Nome de usuário" required>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Senha" required>
                </div>

                <div class="form-group">
                    <input type="submit" name="btn" value="Entrar" class="btn btn-outline-danger float-right login_btn">
                </div>

                <div class="form-group">
                    <a href="dashboard.php" class="btn btn-outline-light float-left">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
>>>>>>> 68221b35f241cb4d8c71073fab7709096587fc5d
