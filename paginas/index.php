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
		<button onclick="Modal.open()" class="bnt direita">Ticket +</button>
		<button class="filtro corr"></button>
		<button class="filtro cory"></button>
		<button class="filtro corg"></button>
		<button onclick="location.href='../php/sair.php'" class="bnt esquerda"><?php echo $_SESSION['nome']; ?></button>
	</header>
	<main>
		
	</main>
	<footer>
		
	</footer>
	<div class="modal-overlay">
        <div class="modal">
            <div id="form">
                <h2>Novo Ticket</h2>
                <form action="" onsubmit="Form.submit(event)">
                    <div class="input-group">
                        <label 
                            class="sr-only" 
                            for="resumo">Resumo</label>
                        <input 
                            type="text" 
                            id="resumo" 
                            name="resumo"
                            placeholder="Resumo"
                        />
                    </div>

                    <div class="input-group">
                        <label 
							class="sr-only" 
							for="solicitacao">Solicitação</label>
                        <input
							type="text"
							id="solicitacao" 
							name="solicitacao"
							placeholder="Sua solicitação"
                        />
                    </div>

                    <div class="input-group actions">
                        <a 
                        onclick="Modal.close()"
                        href="#" 
                        class="button cancel">Cancelar</a>
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
}else{
	$_SESSION['msg'] = "<center id='aviso'>Área restrita</center>";
	header("Location: ../index.php");	
}
?>