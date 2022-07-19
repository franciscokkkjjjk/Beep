<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';
    $user_push = $_GET['id_user'];
    $sql_post_curtidos = 'SELECT * FROM publicacoes WHERE publicacoes.id_publi IN (SELECT curtidas.id_postagem FROM curtidas WHERE curtidas.id_user_curti='.$user_push.')';
    $res_push = mysqli_query($conexao, $sql_post_curtidos);
    $array_push = mysqli_fetch_all($res_push,1);
    foreach($array_push as $valueP) {
        
    }
?>