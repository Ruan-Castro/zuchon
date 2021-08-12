<?php
session_start();
if(!empty($_SESSION['ID']) && $_SESSION['tipo_usuario']==2){
?>
<!DOCTYPE html>
<html>
<head>
	<title>Início</title>
</head>
<body>
	<!DOCTYPE html>
<html>
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
					    	<li><a href="listar_empresasventura.php">Listar existentes</a></li>
					    	<li><a href="cadastro_empresasventura.php">Cadastrar nova</a></li>
					    	<li class="divider"></li>
					    	<li class="dropdown-header">Empresas Ventura</li>
					    	<li><a href="#">Cadastrar nova</a></li>
					    	<li><a href="#">Cadastrar existente</a></li>
				    	<?php
						if ($_SESSION['tipo_usuario']==2) {
						?> 
							<li class="divider"></li>
						    	<li class="dropdown-header">Cadastrar Usuário</li>
						    	<li class="active"><a href="listar_usuario.php">Listar Usuários</a></li>
						    	<li><a href="cadastro_usuario.php">Cadastrar Novo</a></li>
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
      
  <section id="listagem3">
      <table class="exe4 centro bordered elevationmd">
	      	<tr id="theme" style="border-radius: 10px 0;">
				<th>NOME</th>
				<th>USUARIO</th>
				<th>EMAIL</th>
				<th>TIPO DE USUÁRIO</th>
				<th>EDITAR</th>
			</tr>
      <?php
		include_once("php/conexao.php");
		//Receber o número da página
		$pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);		
		$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
		
		//Setar a quantidade de itens por pagina
		$qnt_result_pg = 10;
		
		//calcular o inicio visualização
		$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
		
		$result_usuarios = "
		SELECT
			A.ID,
			A.NOME,
			A.USUARIO,
			A.EMAIL,
			B.tipo_de_usuario
		  FROM
			usuarios A
		INNER JOIN tipo_usuario B ON B.codtipo_usuario=A.tipo_usuario
		 LIMIT
		 	$inicio,
		 	$qnt_result_pg";
		$resultado_usuarios = mysqli_query($conn, $result_usuarios);
		while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
			?>
			
			<tr>
				<td><b><?php echo $row_usuario['NOME'] ?></b></td>
				<td><?php echo $row_usuario['USUARIO'] ?></td>
				<td><?php echo $row_usuario['EMAIL'] ?></td>
				<td><?php echo $row_usuario['tipo_de_usuario'] ?></td>
				<td><a href='edit_usuario.php?id="<?php echo $row_usuario['CODFORNECEDOR'] ?>"'>Editar</a><br><hr></td>
			</tr>
		<?php
		}?>
	</table><?php
		//Paginção - Somar a quantidade de usuários
		$result_pg = "SELECT COUNT(CODFORNECEDOR) AS num_result FROM FORNECEDORES";
		$resultado_pg = mysqli_query($conn, $result_pg);
		$row_pg = mysqli_fetch_assoc($resultado_pg);
		//echo $row_pg['num_result'];
		//Quantidade de pagina 
		$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
		
		//Limitar os link antes depois
		$max_links = 3;
		?>
		<a href='listar_usuario.php?pagina=1'>Primeira</a>
		<?php 
		for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				?>
				<a href='listar_usuario.php?pagina=<?php $pag_ant ?>'><?php $pag_ant ?></a>
				<?php 
			}
		}
			
		echo "$pagina ";
		
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				?>
				<a href='listar_usuario.php?pagina=<?php $pag_dep ?>'><?php $pag_dep ?></a>
				<?php 
			}
		}
		?>
		<a href='listar_usuario.php?pagina=<?php $quantidade_pg ?>'>Última</a>
  </section>
</body>
</html>

<?php
}else{
	$_SESSION['msg'] = "<center id='aviso'>Área restrita</center>";
	header("Location: index.php");	
}
?>