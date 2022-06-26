<?php 
    session_start(); 
    require_once 'conecta.php';
    $sql = 'UPDATE users SET status_=0 WHERE id_user='.$_SESSION['id_user'];
    $result = mysqli_query($conexao, $sql);
    session_destroy();
    header('location:../../../');
?>