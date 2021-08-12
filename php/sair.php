<?php

session_start();
unset(
$_SESSION['ID'],
$_SESSION['nome'],
$_SESSION['usuario'],
$_SESSION['sexo'],
$_SESSION['NA'],
$_SESSION['setor']
);

$_SESSION['msg'] = "<center id='aviso'>Deslogado com sucesso!</center>";
header("Location: ../index.php");
?>