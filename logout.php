<<<<<<< HEAD
<?php
session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Finalizar a sessão
session_destroy();

// Redirecionar para a página de login
header("location: login.php");
exit;
?>
=======
<?php
session_start();

// Destruir todas as variáveis de sessão
$_SESSION = array();

// Finalizar a sessão
session_destroy();

// Redirecionar para a página de login
header("location: login.php");
exit;
?>
>>>>>>> 68221b35f241cb4d8c71073fab7709096587fc5d
