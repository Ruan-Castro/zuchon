<?php

session_start();
unset($_SESSION['ID'], $_SESSION['usuario'], $_SESSION['email'], $_SESSION['tipo_usuario']);

$_SESSION['msg'] = "<center id='aviso'>Deslogado com sucesso!</center>";
header("Location: index.php");
?>