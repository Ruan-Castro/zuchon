<?php
session_start();
require_once "../php/conexao.php";

$resumo=$_POST['resumo'];
$solicitacao=$_POST['solicitacao'];
$usuario=$_SESSION['ID'];

$incluir_ticket = "INSERT INTO chamado (resumo, solicitacao, DTABERTURA, dtencerramento, tecnico, usuario) VALUES ('$resumo', '$solicitacao', now(), null, null, $usuario)";
$resultado = mysqli_query($conn, $incluir_ticket);

if(mysqli_insert_id($conn)){
	$_SESSION['msg'] = "<center id='aviso'>Ticket criado com *SUCESSO*</center>";
	header("Location: ../paginas/index.php");
}else{
	$_SESSION['msg'] = "<center id='aviso'>Ticket não criado, contete administrador do Sistema.</center>";
	header("Location: ../paginas/index.php");
}
?>