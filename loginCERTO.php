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

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .login-container h2 {
            text-align: center;
            color: #333;
        }

        .login-container input[type="text"], .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .login-container .button {
            width: 45%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .login-container .button:hover {
            background-color: #45a049;
        }

        .login-container .button-container {
            display: flex;
            justify-content: space-between;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2>Login do Administrador</h2>
    <?php
    if (isset($login_error)) {
        echo "<p class='error'>$login_error</p>";
    }
    ?>
    <form method="post" action="login.php">
        <input type="text" name="username" placeholder="Nome de usuário" required>
        <input type="password" name="password" placeholder="Senha" required>
        <div class="button-container">
            <button type="submit" class="button">Login</button>
            <a href="dashboard.php" class="button">Voltar</a>
        </div>
    </form>
</div>
</body>
</html>

