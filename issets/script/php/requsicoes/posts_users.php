<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';
    $perfil = $_GET['username'];

    $sql_perfil = "SELECT * FROM users WHERE username='$perfil'";
    $res_perfil = mysqli_query($conexao, $sql_perfil);
    $array_info = mysqli_fetch_assoc($res_perfil);

    $sql_posts = "SELECT * FROM publicacoes WHERE user_publi=".$array_info['id_user']." ORDER BY date_publi DESC ";
    $res_posts = mysqli_query($conexao,$sql_posts);
    $postagens = mysqli_fetch_all($res_posts,1);

    $perfil_visit[] = {

    }
?>