<?php 
    session_start();
    $datOt = date('Y-m-d',$oldDate);
    $datIn = strtotime($a.'/'.$b.'/'.);
    $datOt = date('Y-m-d',$oldDate);
    die;
    require_once 'conecta.php';
    $pass = md5($_POST['senha_user']);
    $email = $_POST['email_user'];
    $nome = $_POST['nome_user'];
    $dia_nas = intval($_POST['dia']);
    $mes_nas = $_POST['mes'];
    $ano_nas = intval($_POST['ano']);
    var_dump($dia_nas);
    var_dump($mes_nas);
    var_dump($ano_nas);
    die;
    $sql_valid = 'SELECT * FROM users';
    $resultado  = mysqli_query($conexao,$sql_valid);

?>