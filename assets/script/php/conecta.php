<?php
$bdServidor = '127.0.0.1';
$bdUsuario = 'root';
$bdSenha = '';
$bdBanco = 'beep';
$conexao = mysqli_connect($bdServidor,$bdUsuario,$bdSenha,$bdBanco);

if ($conexao === false)
{	
	echo "Problemas para conectar no banco. Erro: ";
	echo mysqli_connect_error();	
	//String vazia,nao ocorreu erro
}
else
{
	//echo "Tudo ok";
}
?>