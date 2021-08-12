<?php
session_start();
require_once "php/conexao.php";

$EMPRESA=$_POST['empresa'];

//echo "Nome: $nome <br>";
//echo "E-mail: $email <br>";

$result_usuario = "INSERT INTO empresasventura (EMPRESA, DTCRIACAO) VALUES ('$EMPRESA', NOW())";
$resultado_usuario = mysqli_query($conn, $result_usuario);

if(mysqli_insert_id($conn)){
	$_SESSION['msg'] = "<center id='aviso'>Empresa Ventura cadastrado com *SUCESSO*</center>";
	header("Location: listar_empresasventura.php");
}else{
	$_SESSION['msg'] = "<center id='aviso'>Empresa Ventura não cadastrada! :(</center>";
	header("Location: cadastro_empresasventura.php");
}
?>