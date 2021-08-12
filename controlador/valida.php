<?php
session_start();
require_once "php/conexao.php";

if(!empty($_POST)){
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	echo "$usuario - $senha";
	if((!empty($usuario)) AND (!empty($senha))){
		//Gerar a senha criptografa
		//echo password_hash($senha, PASSWORD_DEFAULT);
		//Pesquisar o usuário no BD
		$result_usuario = "SELECT ID, nome,usuario, senha, email, tipo_usuario FROM USUARIOS WHERE usuario='$usuario' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if($resultado_usuario){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			if($senha==$row_usuario['senha']){
				$_SESSION['ID'] = $row_usuario['ID'];
				$_SESSION['nome'] = $row_usuario['nome'];
				$_SESSION['usuario'] = $row_usuario['usuario'];
				$_SESSION['email'] = $row_usuario['email'];
				$_SESSION['tipo_usuario'] = $row_usuario['tipo_usuario'];
				header("Location: inicio.php");
			}else{
				$_SESSION['msg'] = "<center id='aviso'>Login e/ou Senha incorreto!</center>";
				header("Location: index.php");
			}
		}
	}else{
		$_SESSION['msg'] = "<center id='aviso'>Login e senha incorreto!</center>";
		header("Location: index.php");
	}
}else{
	$_SESSION['msg'] = "<center id='aviso'>Página não encontrada</center>";/* Erro de validação */
	header("Location: index.php");
}
?>