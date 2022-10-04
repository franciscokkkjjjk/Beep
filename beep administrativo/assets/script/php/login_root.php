<?php 
    session_start();
    require_once 'conecta.php';
    $email = mysqli_escape_string($conexao, $_POST['email--user']);
    $sql_verify = "SELECT * FROM adms WHERE email='$email'";
    $res_verify = mysqli_query($conexao, $sql_verify);
    $assoc_verify = mysqli_fetch_assoc($res_verify);
    $senha = mysqli_escape_string($conexao, $_POST['senha--user']);
    if(is_null($assoc_verify)) {
        $_SESSION['mensagem'] = 'Você não possui cadastro no sistema.';
        $_SESSION['erro_email'] = true;
        $_SESSION['email_root'] = $email;
        header('location:../../../');
        die;
    } else {
        if($assoc_verify['ativo']) {
            if(password_verify($senha, $assoc_verify['senha'])) {
                $_SESSION['id_root'] = $assoc_verify['id_adm'];
                $_SESSION['nome_adm'] = $assoc_verify['nome_adm'];
                
                die;
            } else {
                $_SESSION['mensagem'] = 'Email ou senha invalidos.';
                $_SESSION['erro_email'] = true;
                $_SESSION['email_root'] = $email;
                header('location:../../../');
                die;
            }
        } else {
            if($senha == $assoc_verify['senha']) {
                $_SESSION['ative'] = true;
                $_SESSION['id_root'] = $assoc_verify['id_adm'];
                $_SESSION['nome_adm'] = $assoc_verify['nome_adm'];
            }
        }
    }
    var_dump($email);
?>