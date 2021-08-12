<?php
session_start();
if(!empty($_SESSION['ID']) && $_SESSION['tipo_usuario']==2){
?>
<!DOCTYPE html>
<head>
  <title>Gestão de Contratos</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/bootstrap413.min.css">
  <!-- CSS apenas -->
  <link rel="shortcut icon" href="imagens/icon.ico" />
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/css.css">
</head>
<body class="gradient">
	<?php
		if(isset($_SESSION['msg'])){
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
	?>
<nav class="navbar navbar-expand-lg navbar-light bg-light elevation">
	<div class="container-fluid">
		<a class="navbar-brand" href="#"><img src="imagens/grupocarmais.png" width="150px"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
		</button>
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
	      		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<a class="btn btn-default" type="button" href="inicio.php">Início</a>
					<a class="btn btn-default" type="button" href="#">Gráficos</a>
					<div class="dropdown">
					    <button class="btn btn-default active" type="button" data-toggle="dropdown">Cadastros
					    <span class="caret"></span></button>
					    <ul class="dropdown-menu">
					    	<li class="dropdown-header">Fornecedores</li>
					    	<li><a href="listar_fornecedor.php">Listar Fornecedores</a></li>
					    	<li><a href="cadastro_fornecedor.php">Cadastrar novo</a></li>
					    	<li class="divider"></li>
					    	<li class="dropdown-header">Empresas Ventura</li>
					    	<li><a href="listar_empresasventura.php">Listar Existentes</a></li>
					    	<li><a href="cadastro_empresasventura.php">Cadastrar Nova</a></li>
				    	<?php
						if ($_SESSION['tipo_usuario']==2) {
						?> 
							<li class="divider"></li>
						    	<li class="dropdown-header">Cadastrar Usuário</li>
						    	<li><a href="listar_usuario.php">Listar Usuários</a></li>
						    	<li class="active"><a href="cadastro_usuario.php">Cadastrar Novo</a></li>
						<?php } else{ } ?>
				    	</ul>
					</div>
				</ul>
			</div>
		</div>
    <form class="form-inline my-2 my-lg-0">
		<center>Bem vindo<br> <b><?php echo $_SESSION['nome'] ?>!</b>
		<a href="sair.php"><img src="imagens/sair.png" height="20px" width="20px"></a></center>
	</form>
	</div>
</nav>
<center>
<div class="container">
	<div style="width: 300px; background-color: #FFF; border-radius: 0 10px 0 10px;">
	  <form method="POST" action="cadastro_usuario2.php" class="px-4 py-3">
	    <div class="form-group">
	      <label style="float: left;">Nome</label>
	      <input type="text" name="nome" class="form-control" placeholder="Digite o nome do Usuário">
	    </div>
	    <div class="form-group">
	      <label style="float: left;">Usuário</label>
	      <input type="text" name="user" class="form-control" placeholder="Para logar no sistema">
	    </div>
	    <div class="form-group">
	      <label style="float: left;">Senha</label>
	      <input type="password" name="senha" class="form-control" placeholder="Digite a senha">
	    </div>
	    <div class="form-group">
	      <label style="float: left;">Repetir senha</label>
	      <input type="password" name="senha2" class="form-control" placeholder="Digite a senha novamente">
	    </div>
	    <div class="form-group">
	      <label style="float: left;">E-mail do Usuário</label>
	      <input type="email" name="email" class="form-control" placeholder="Digite o E-mail">
	    </div>
	    <select name="codtipo_usuario">
<?php
		include("php/conexao.php");
		if ($conn -> connect_errno) {
		  echo "Falha de conexão com MySQL: " . $mysqli -> connect_error;
		  exit();
		}
		$result_usuarios = "
			SELECT
					codtipo_usuario,
					tipo_de_usuario
			  FROM
			  		tipo_usuario
			  			";
		$resultado_usuarios = mysqli_query($conn, $result_usuarios);
		while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
	?>
			<option value="<?php echo $row_usuario['codtipo_usuario']; ?>"><?php echo $row_usuario['tipo_de_usuario']; ?></option>
	<?php
		}
	?>
		</select>
			</datalist>
	    <center>
		    <!--<div class="form-check">
		    	<input type="checkbox" class="form-check-input" id="dropdownCheck">
		    	<label class="form-check-label" for="dropdownCheck">
		    		Lembrar-me
		    	</label>
		    </div>-->
		    <?php
		    	
		    ?>
	    	<button type="submit" value="Cadastrar" class="btn btn-primary">Cadastrar</button>
	    </center>
	  </form>
	</div>
</div>
</center>
</body>
</html>

<?php
}else{
	$_SESSION['msg'] = "<center id='aviso'>Área restrita</center>";
	header("Location: index.php");	
}
?>