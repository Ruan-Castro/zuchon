<?php
	define('HOST', '192.168.17.250:8000');
	define('USUARIO', 'root');
	define('SENHA', '');
	define('DB', 'zuchon');

	$conexao = mysqli_connect(HOST, USUARIO, SENHA, DB) or die ('Não é possível conectar!');