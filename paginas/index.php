<?php
session_start();
if(!empty($_SESSION['ID'])){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Zuchon - HelpDesk</title>
	<link rel="shortcut icon" href="../imagens/icon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/css.css">
</head>
<body class="fundo">
	<?php
		if(isset($_SESSION['msg'])){
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
	?>
	<header>
		<button onclick="location.href='./novoticket.php'" class="bnt direita">Ticket +</button>
		<button class="filtro corr"></button>
		<button class="filtro cory"></button>
		<button class="filtro corg"></button>
		<button onclick="location.href='../php/sair.php'" class="bnt esquerda"><?php echo $_SESSION['nome']; ?></button>
	</header>
	<main>
		
	</main>
	<footer>
		
	</footer>
</body>
</html>
<?php
}else{
	$_SESSION['msg'] = "<center id='aviso'>Área restrita</center>";
	header("Location: ../index.php");	
}
?>