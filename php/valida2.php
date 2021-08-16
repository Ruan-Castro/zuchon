<?php
session_start();
require_once "conexao.php";

if(!empty($_POST)){
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	echo "$usuario - $senha";
	if((!empty($usuario)) AND (!empty($senha))){
		//Gerar a senha criptografa
		//echo password_hash($senha, PASSWORD_DEFAULT);
		//Pesquisar o usuário no BD
		$result_usuario = "SELECT ID, tecnico, usuario, sexo, senha, NA, setor FROM tecnicos WHERE usuario='$usuario' LIMIT 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);
		if($resultado_usuario){
			$row_usuario = mysqli_fetch_assoc($resultado_usuario);
			if($senha==$row_usuario['senha']){
				

				$_SESSION['ID'] = $row_usuario['ID'];
				$_SESSION['nome'] = $row_usuario['tecnico'];
				$_SESSION['usuario'] = $row_usuario['usuario'];
				$_SESSION['sexo'] = $row_usuario['sexo'];
				$_SESSION['NA'] = $row_usuario['NA'];
				$_SESSION['setor'] = $row_usuario['setor'];
				
				header("Location: ../paginas/index2.php");
			}else{
				$_SESSION['msg'] = "<center id='aviso'>Login e/ou Senha incorreto!</center>";
				header("Location: ../index2.php");
			}
		}
	}else{
		$_SESSION['msg'] = "<center id='aviso'>Login e Senha incorretos!</center>";
		header("Location: ../index2.php");
	}
}else{
	$_SESSION['msg'] = "<center id='aviso'>Página não encontrada</center>";/* Erro de validação */
	header("Location: ../index2.php");
}
?>