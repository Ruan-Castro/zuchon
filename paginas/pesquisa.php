<?php
session_start();
if($_SESSION['NA']==5 || $_SESSION['ID']==$HELPDESK){
    $helpdesk=$_POST['chamado'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Zuchon - HelpDesk</title>
	<link rel="shortcut icon" href="../imagens/icon.ico" />
	<link rel="stylesheet" type="text/css" href="../css/css.css">
</head>
<body>
	<?php
		if(isset($_SESSION['msg'])){
			unset($_SESSION['msg']);
		}
	?>
	<header>
        <span>
            <a onclick="Modal.open()" class="bnt direita">Ticket +</a>
            <form action="pesquisa.php" method="POST">
                <input type="text" name="chamado" placeholder="Pesquisar chamado" style="width: 150px; height: 10px; margin-right:0px;" required></input>
                <button type="submit" name="Enviar">Pesquisar</button>        
            </form>
            <!-- <button class="filtro corr"></button>
            <button class="filtro cory"></button>
            <button class="filtro corg"></button> -->
            <a href="../php/sair.php" class="bnt esquerda"><?php echo $_SESSION['nome']; ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" color="red" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/><path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/></svg></a>
        </span>
    </header>
	<main class="container">
		<section id="transaction">
            <table id="data-table">
                <thead>
                    <tr>
                        <th>Ticket</th>
                        <th>Usuário</th>
                        <th>Setor</th>
                        <th>Resumo</th>
                        <th>Data de Abertura</th>
                        <th>Data de Encerramento</th>
                        <th>Técnico</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once("../php/conexao.php");
                    //Receber o número da página
                    $pagina_atual = filter_input(INPUT_GET,'pagina', FILTER_SANITIZE_NUMBER_INT);       
                    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
                    
                    //Setar a quantidade de itens por pagina
                    $qnt_result_pg = 10;
                    
                    //calcular o inicio visualização
                    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
                    $id_user=$_SESSION['ID'];
                    $result_usuarios = "
                    SELECT
                        A.ID,
                        A.PRIORIDADE,
                        B.NOME,
                        A.RESUMO,
                        A.SOLICITACAO,
                        A.DTABERTURA,
                        A.DTENCERRAMENTO,
                        C.TECNICO,
                        D.NOMESETOR
                      FROM
                        chamado A
                    INNER JOIN usu B ON A.USUARIO=B.ID
                    INNER JOIN Tecnicos C ON A.TECNICO=C.ID
                    INNER JOIN setor D ON B.setor=D.codsetor
                    WHERE
                        A.ID=$helpdesk;
                    ";
                    $resultado_usuarios = mysqli_query($conn, $result_usuarios);
                    while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
                        ?>
                        
                    <tr>
                        <td class="<?php echo $row_usuario['PRIORIDADE'];?>"><a href="" <?php if($row_usuario['PRIORIDADE']=="tecnico"){ echo "style='color: white;'";}else{ echo "style='color: black;'";} ?> ><?php echo $row_usuario['ID'];?></a></td>
                        <td><?php echo $row_usuario['NOME'];?></td>
                        <td><?php echo $row_usuario['NOMESETOR']; ?></td>
                        <td><?php echo $row_usuario['RESUMO'];?></td>
                        <td><?php echo $row_usuario['DTABERTURA'];?></td>
                        <td><?php echo $row_usuario['DTENCERRAMENTO'];?></td>
                        <td><?php echo $row_usuario['TECNICO'];?></td>
                    </tr>
                    <tr>
                        <td class="<?php echo $row_usuario['PRIORIDADE'];?>" <?php if($row_usuario['PRIORIDADE']=="tecnico"){ echo "style='color: white;'";}else{ echo "style='color: black;'"; } ?> >Solicitação:</td>
                        <td colspan="6"><?php echo $row_usuario['SOLICITACAO'];?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </section>
	</main>
	<footer>
		Criado por <a href="https://github.com/Ruan-Castro" target="_blank">Antonio Marcos</a>
	</footer>
	<div class="modal-overlay">
        <div class="modal">
            <div id="form">
                <h2>Novo Ticket</h2>
                <form action="../php/novo_ticket2.php" method="POST">
                    <div class="input-group">
                        <label class="sr-only" for="resumo">Resumo *</label>
                        <input type="text" id="resumo" name="resumo" placeholder="Resumo" required="Resumo" />
                    </div>

                    <div class="input-group">
                        <label class="sr-only" for="solicitacao">Solicitação *</label><p>
                        <textarea class="edit_box" rows="10"  name="solicitacao" placeholder="Sua solicitação" style="width: 600px; height: 150px; margin: 0px;" required="Resumo"></textarea>
                    </div>

                    <div class="input-group actions">
                        <a onclick="Modal.close()" href="#" class="button cancel">Cancelar</a>
                        <button class="btn-cad">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<script src="../js/scripts.js"></script>
</body>
</html>
<?php
    unset(
    $_POST['chamado']
    );
}else{
	$_SESSION['msg'] = "<center id='aviso'>Área restrita</center>";
    unset(
    $_SESSION['ID'],
    $_SESSION['nome'],
    $_SESSION['tecnico'],
    $_SESSION['usuario'],
    $_SESSION['sexo'],
    $_SESSION['NA'],
    $_SESSION['setor']
    );
	header("Location: ../index.php");	
}
?>