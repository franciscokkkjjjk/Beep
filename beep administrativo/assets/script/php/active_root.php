<?php 
    session_start();
    require_once 'conecta.php';
    $senha1 = mysqli_escape_string($conexao, $_POST['pass--root']);
    $senha2 = mysqli_escape_string($conexao, $_POST['senha--root_c']);
    if($senha1 == $senha2) {
        $senha1 = password_hash($senha1, PASSWORD_DEFAULT);
        $sql_redifine = 'UPDATE adms SET senha=';
    } else {
        $_SESSION['error_pass'] = true;
        $_SESSION['mensagem'] = 'Senhas diferentes.';
        header('location: ../../../');
        die;
    }
?>