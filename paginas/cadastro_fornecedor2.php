<?php
session_start();
require_once "php/conexao.php";

$FORNECEDOR=$_POST['fornecedor'];

//echo "Nome: $nome <br>";
//echo "E-mail: $email <br>";

$result_usuario = "INSERT INTO FORNECEDORES (FORNECEDOR, DTCRIACAO) VALUES ('$FORNECEDOR', NOW())";
$resultado_usuario = mysqli_query($conn, $result_usuario);

if(mysqli_insert_id($conn)){
	$_SESSION['msg'] = "<center id='aviso'>Fornecedor cadastrado com *SUCESSO*</center>";
	header("Location: listar_fornecedor.php");
}else{
	$_SESSION['msg'] = "<center id='aviso'>Fornecedor não cadastrado :(</center>";
	header("Location: cadastro_fornecedor.php");
}
?>