<?php
include('../php/conect.php');

if(empty($_POST['usuario']) || empty($_POST['senha'])){
	header('Location: ../index.html');
}

$usuario = mysqli_real_escape_string($conexao, $_POST['usuario']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "SELECT * FROM usu WHERE usuario='' and senha= '' ";