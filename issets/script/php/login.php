<?php 
    session_start();
    require_once('conecta.php');
    $sql = 'SELECT * FROM users';
    $resultado = mysqli_query($conexao, $sql);
    $user = mysqli_fetch_all($resultado, 1);
    var_dump($user);
    $email = $_POST['email--user'];
    $senha = $_POST['senha--user'];
    foreach($user as $user_aux){
        if($email == $user_aux['email']) {
            if($senha == $user_aux['senha']) {
                $_SESSION['id_user'] = $user_aux['id_user'];
                $_SESSION['img'] = $user_aux['foto_perfil'];
                $_SESSION['username'] = $user_aux['username'];
                $_SESSION['nome'] = $user_aux['nome'];
                header('location:../../../paginas/inicial.php');
            } else {
                $_SESSION['mensagem'] = 'Senha ou email incorretos.';
                $_SESSION['email'] = $email;
                header('location:../../../');
            }
      } else {
        $_SESSION['email'] = $email;
        $_SESSION['mensagem'] = 'Esse email não possui cadastro em nosso servidor.';
        $_SESSION['erro_email'] = true;
        header('location:../../../');
        
      }
    }
?>