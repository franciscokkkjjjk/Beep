<?php 
     session_start();
     require_once '../conecta.php';
     require_once '../function/funcoes.php';
     if($_POST['c-pXD30']) {
        $sql_post_compartilhado = 'SELECT * FROM publicacoes WHERE id_publi='.$_POST['c-pXD30'];
     }
?>