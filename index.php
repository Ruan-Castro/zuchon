<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Controle de Contratos</title>
		<link rel="stylesheet" type="text/css" href="./css/login.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
<body class="gradient">
		<?php
			if(isset($_SESSION['msg'])){
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
		?>
<div class="container">
	<div class="login">
		<div class="logo-login">
			<img src="imagens/runatecnologiacriativa.png" class="tamanho-logo" />
		</div>
		<div class="dados-login">
			<form method="POST" action="./php/valida.php" class="px-4 py-3">
			  	<center><h1>Login de Usuário</h1></center>
			    <div class="formulario01">
					<input type="text" name="usuario" placeholder="Usuário">
			    </div>
			    <div class="formulario01">
					<input type="password" name="senha" placeholder="Senha">
			    </div>
			    <center>
			    	<button type="submit" name="login">Entrar</button>
					<div class="footer">
						Criado por <a href="https://github.com/Ruan-Castro" target="_blank">Antonio Marcos</a>
					</div>
			    </center>
	  		</form>
		</div>
	</div>
</div>
</body>
</html>