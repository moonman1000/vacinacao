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
