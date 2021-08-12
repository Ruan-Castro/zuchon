<?php
session_start();
require_once "php/conexao.php";

$nome=$_POST['nome'];
$usuario=$_POST['user'];
$senha=$_POST['senha'];
$senha2=$_POST['senha2'];
$email=$_POST['email'];
$tipo_usuario=$_POST['codtipo_usuario'];

if ($_POST['senha']!=$_POST['senha2'] || $_POST['senha2']=='' || $_POST['senha']=='') {
	$_SESSION['msg'] = "<center id='aviso'>SENHAS NÃO ESTÃO IGUAIS OU ESTÃO VAZIAS</center>";
	header("Location: cadastro_usuario.php");
}else{

//echo "Nome: $nome <br>";
//echo "E-mail: $email <br>";

$result_usuario = "INSERT INTO USUARIOS (NOME, USUARIO, SENHA, EMAIL, TIPO_USUARIO) VALUES ('$nome', '$usuario', '$senha', '$email', '$tipo_usuario')";
$resultado_usuario = mysqli_query($conn, $result_usuario);

if(mysqli_insert_id($conn)){
	$_SESSION['msg'] = "<center id='aviso'>Usuário cadastrado com *SUCESSO*</center>";
	header("Location: listar_usuario.php");
}else{
	$_SESSION['msg'] = "<center id='aviso'>Usuário não cadastrado :(</center>";
	header("Location: cadastro_usuario.php");
}}
?>