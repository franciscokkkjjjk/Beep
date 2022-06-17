<?php 
    session_start();
    require_once('conecta.php');
    $sql = 'SELECT * FROM users';
    $resultado = mysqli_query($conexao, $sql);
    $user = mysqli_fetch_all($resultado, 1);
    var_dump($user);
    $email = $_POST['email--user'];
    $senha = $_POST['senha--user'];
?>