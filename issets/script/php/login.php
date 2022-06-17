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
        if($email == $user_aux['emai'] and $senha == $user_aux['senha']) {
            $_SESSION['user'] = $user['id_user'];
            header('location:../../../paginas/inicial.php');
        } else {
            $_SESSION['mensagem'] = 'Senha ou email incorretos.';
        }
    }
?>