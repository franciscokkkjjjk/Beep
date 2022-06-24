<?php
    session_start();
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    }
    require_once '../issets/script/php/conecta.php';
    $sql = 'SELECT username, email, nome, foto_perfil, banner_pefil, bio, data_nas FROM user WHERE id_user='.$_SESSION['id_user'];
    $resultado = mysqli_query($conexao, $sql); 
    $array_user = mysqli_fetch_assoc($resultado);
    var_dump($array_user);
?>