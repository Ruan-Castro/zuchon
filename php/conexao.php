<?php
	$servidor = "localhost";
	$usuario = "root";
	$senha = "";
	$dbname = "zuchon";
	
	//Criar a conexao
	$conn = mysqli_connect($servidor, $usuario, $senha, $dbname);
/* if(!empty($_SESSION['ID'])){

}else{
	$_SESSION['msg'] = "<center id='aviso'>Área restrita</center>";
	header("Location: ../index.php");
}*/
?>