<?php 
    session_start();
    require_once 'conecta.php'; //567.600.000.000.000 18 anos em milesegundos
    $meses = [
        'Janeiro',//0
        'Fevereiro',
        'Março',//2
        'Abril',
        'Maio',//4
        'Junho',
        'Julho',//6
        'Agosto',//7
        'Setembro',
        'Outubro',//9
        'Novembro',
        'Dezembro'//10
    ];
    $pass = md5($_POST['senha_user']);
    $email = $_POST['email_user'];
    $nome = $_POST['nome_user'];
    $dia_nas = intval($_POST['dia']);
    $mes_nas = $_POST['mes'];
    $ano_nas = intval($_POST['ano']);
    for($i = 0;$i<12;$i++){
        if($meses[$i] == $mes_nas){
            echo 'kk finalmente é '.$meses[$i];
            $mesOut = $i+1;
            echo 'janeiro é o mes '.$mesOut;
            break;
        }
    }
    $datIn = strtotime($mesOut.'/'.$dia_nas.'/'.$ano_nas);
    var_dump($datIn);
    die;
    $datOt = date('Y-m-d', $datIn);
    die;
    var_dump($dia_nas);
    var_dump($mes_nas);
    var_dump($ano_nas);
    die;
    $sql_valid = 'SELECT * FROM users';
    $resultado  = mysqli_query($conexao,$sql_valid);

?>