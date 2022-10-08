<?php 
    session_start();
    require_once 'conecta.php';
    $senha1 = mysqli_escape_string($conexao, $_POST['pass--root']);
    $senha2 = mysqli_escape_string($conexao, $_POST['senha--root_c']);
    if($senha1 == $senha2) {
        $senha1 = password_hash($senha1, PASSWORD_DEFAULT);
        $sql_redefine = "UPDATE adms SET senha='" . $senha1 . "', ativo=1 WHERE id_adm=" . $_SESSION['id_root'];
        $res_redefine = mysqli_query($conexao, $sql_redefine);
        if($res_redefine) {
            unset($_SESSION['ative']);
            header('location: ../../../');
            die;
        } else {
            $_SESSION['error_pass'] = true;
            $_SESSION['mensagem'] = 'Erro ao criar uma senha.';
            header('location: ../../../');
            die;
        }
    } else {
        $_SESSION['error_pass'] = true;
        $_SESSION['mensagem'] = 'Senhas diferentes.';
        header('location: ../../../');
        die;
    }
?>