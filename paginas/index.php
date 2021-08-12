<?php
session_start();
if(!empty($_SESSION['ID'])){
?>
<!DOCTYPE html>
<head>
  <title>Gestão de Contratos</title>
  <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <!-- CSS apenas -->
  <link rel="shortcut icon" href="../imagens/icon.ico" />
  <link rel="stylesheet" type="text/css" href="../css/css.css">
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
		<a class="navbar-brand" href="#"><img src="../imagens/grupocarmais.png" width="150px"></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    	<span class="navbar-toggler-icon"></span>
		</button>
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
	      		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<a class="btn btn-default active" type="button" href="#">Início</a>
					<a class="btn btn-default" type="button" href="#">Gráficos</a>
					<div class="dropdown">
					    <button class="btn btn-default" type="button" data-toggle="dropdown">Cadastros
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
						if ($_SESSION['NA']==5) {
							
					?> 
						<li class="divider"></li>
					    	<li class="dropdown-header">Cadastrar Usuário</li>
					    	<li><a href="listar_usuario.php">Listar Usuários</a></li>
						    <li><a href="cadastro_usuario.php">Cadastrar Novo</a></li>
					<?php } else{ } ?>
				    	</ul>
					</div>
				</ul>
			</div>
		</div>
    <form class="form-inline my-2 my-lg-0">
		<center>Bem vind<?php if($_SESSION['sexo']==0){ echo 'o'; } if($_SESSION['sexo']==1){ echo 'a'; } if($_SESSION['sexo']==2){ echo 'x'; } ?>
			<b><?php echo $_SESSION['nome'] ?>!</b>
		<a href="../php/sair.php"><img src="../imagens/sair.png" height="20px" width="20px"></a></center>
	</form>
	</div>
</nav>
      
  <section id="listagem1">
      <table class="exe4 centro bordered elevationmd">
      	<tr id="theme" style="border-radius: 10px 0;">
			<th>FORNECEDOR</th>
			<th>PAGADORES</th>
			<th>SETOR RESPONSÁVEL</th>
			<th>SITUAÇÃO</th>
			<th>PAGAMENTO</th>
			<th>VALOR PAGO</th>
			<th>PERIODO</th>
			<th>OBS</th>
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
					A.ID, B.FORNECEDOR, D.EMPRESA, C.SETORRESP, A.CODSITUACAO, A.PAGAMENTO, A.VALORPAGO, E.CODPERIODO, A.DTCRIACAO, A.DTALTERACAO, A.QUEMALTEROU, A.OBS
			  FROM
			  		controle_de_contratos A
			INNER JOIN FORNECEDORES B ON A.CODFORNECEDOR=B.CODFORNECEDOR
			INNER JOIN SETORRESPONSAVEL C ON A.CODSETORRESP=C.CODSETORRESP
			INNER JOIN EMPRESASVENTURA D ON A.CODPAGANTES=D.CODEMPRESA
			INNER JOIN PERIODO E ON E.CODPERIODO=A.CODPERIODO
			order by B.FORNECEDOR asc LIMIT $inicio, $qnt_result_pg";
		$resultado_usuarios = mysqli_query($conn, $result_usuarios);
		while($linha = mysqli_fetch_assoc($resultado_usuarios)){
			?>
			<tr>
			<td><b><?php echo $linha['FORNECEDOR']; ?></b></td>
			<td><?php echo $linha['EMPRESA']; ?></td>
			<td><?php echo $linha['SETORRESP']; ?></td>
				<td>
					<?php
					if($linha['CODSITUACAO']==1){
					echo 'ATIVO'; 
					}
					if($linha['CODSITUACAO']==0){
					echo 'INATIVO'; 
					}?>
				</td>
				<td>
					<?php
					if($linha['PAGAMENTO']==1){
					echo '<img src="imagens/ok.png" width="20px">'; 
					}
					if($linha['PAGAMENTO']==0){
					echo '<img src="imagens/notok.png" width="20px">'; 
					}?>
				</td>
			<td><?php echo 'R$ '.$linha['VALORPAGO']; ?></td>
			<td>
				<?php
					if($linha['CODPERIODO']==1){
					echo '<b style="">DIÁRIO</b>'; 
					}
					if($linha['CODPERIODO']==2){
					echo '<b style="">SEMANAL</b>'; 
					}
					if($linha['CODPERIODO']==3){
					echo '<b style="">QUINZENAL</b>'; 
					}
					if($linha['CODPERIODO']==4){
					echo '<b style="">MENSAL</b>'; 
					}
					if($linha['CODPERIODO']==5){
					echo '<b style="">ANUAL</b>'; 
					}?>
			</td>
			<td><?php echo $linha['OBS']; ?></td>
		</tr>
		<?php 
			}
		?>
		<?php
		$result_usuarios = "
			SELECT
					COUNT(ID) AS QUANTIDADE, SUM(VALORPAGO) AS TOTAL
			  FROM
			  		controle_de_contratos
		";
		$resultado_usuarios = mysqli_query($conn, $result_usuarios);
		$linha = mysqli_fetch_assoc($resultado_usuarios)
		?>
		<tr style="background-color: #D1CDCD; color: #000;">
			<td><b>QUANTIDADE LINHAS</b></td>
			<td><b><?php echo $linha['QUANTIDADE']; ?></b></td>
			<td></td>
			<td></td>
			<td><b>TOTAL</b></td>
			<td><b><?php echo 'R$ '.$linha['TOTAL']; ?></b></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<?php
		//Paginção - Somar a quantidade de usuários
		$result_pg = "SELECT COUNT(ID) AS num_result FROM controle_de_contratos";
		$resultado_pg = mysqli_query($conn, $result_pg);
		$row_pg = mysqli_fetch_assoc($resultado_pg);
		//echo $row_pg['num_result'];
		//Quantidade de pagina 
		$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);
		
		//Limitar os link antes depois
		$max_links = 3;
		?>
		<a href='inicio.php?pagina=1'>Primeira</a>
		<?php 
		for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
			if($pag_ant >= 1){
				?>
				<a href='inicio.php?pagina=<?php echo $pag_ant ?>'><?php $pag_ant ?></a>
				<?php 
			}
		}
		?>	
		<a href='inicio.php?pagina=<?php echo $pagina ?>'><?php echo $pagina ?></a>
		<?php
		for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++){
			if($pag_dep <= $quantidade_pg){
				?>
				<a href='inicio.php?pagina=<?php echo $pag_dep ?>'><?php echo $pag_dep ?></a>
				<?php 
			}
		}
		?>
		<a href='inicio.php?pagina=<?php echo $quantidade_pg ?>'>Última</a>
  </section>
</body>
</html>

<?php
}else{
	$_SESSION['msg'] = "<center id='aviso'>Área restrita</center>";
	header("Location: index.php");	
}
?>