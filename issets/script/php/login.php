<?php 
    session_start();
    require_once('conecta.php');
    $sql = 'SELECT * FROM users';
    $resultado = mysqli_query($conexao, $sql);
    $user = mysqli_fetch_all($resultado, 1);
    $email = $_POST['email--user'];
    $senha = md5($_POST['senha--user']);
    $emailError = true;
    foreach($user as $user_aux){
        var_dump($user_aux['email']);  
        if($email == $user_aux['email']) {
            $emailError = false;
            if($senha == $user_aux['senha']) {
                $_SESSION['id_user'] = $user_aux['id_user'];
                $_SESSION['img'] = $user_aux['foto_perfil'];
                $_SESSION['username'] = $user_aux['username'];
                $_SESSION['email'] = $email;
                $_SESSION['nome'] = $user_aux['nome'];
                $_SESSION['img_banner'] = $user_aux['banner_pefil'];
                $_SESSION['bio_user'] = $user_aux['bio'];
                $_SESSION['historyc'] = array();
                header('location:../../../paginas/inicial.php');
            } else {
                $_SESSION['mensagem'] = 'Senha incorreta. <a href="">você esqueceu a senha?</a>';
                $_SESSION['email'] = $email;
                header('location:../../../');
            }
      }
    }
    if($emailError) {
        $_SESSION['email'] = $email;
        $_SESSION['mensagem'] = 'Esse email não possui cadastro em nosso servidor.';
        $_SESSION['erro_email'] = true;
        header('location:../../../');
    }
?>