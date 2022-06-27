<?php 
    session_start();
    $dat_in = mktime(0, 0, 0, date('m'), date('d'), date('Y'));;
//divisão para chegar nos 18: 213195 24 4 1,2
    require_once 'conecta.php'; 
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
            $mesOut = $i+1;
            break;
        }
    }
    $datIn = mktime( 0, 0, 0, $mesOut, $dia_nas, $ano_nas);
    $datOt = date('Y-m-d', $datIn);
    $calc = $dat_in-$datIn;
    $cal_pross00 = $calc/60;
    $cal_pross0000 = $cal_pross00/60;
    $cal_pross01 = $cal_pross0000/24;
    $date_coverti = $cal_pross01/365.25;
    $error_email = true;
    if($date_coverti >= 18){
        $sql_valid = 'SELECT * FROM users';
        $resultado_valid  = mysqli_query($conexao,$sql_valid);
        $linha_valid = mysqli_fetch_all($resultado_valid,1);
        foreach($linha_valid as $valid) {
            if($valid['email'] == $email) {
                $error_email = false;
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['dia_nas'] = $dia_nas;
                $_SESSION['mes_nas'] = $mes_nas;
                $_SESSION['ano_nas'] = $ano_nas;
                $_SESSION['email'] = $email;
                $_SESSION['mensagem'] = 'Esse email já esta sendo usado.';
                $_SESSION['erroEmail'] = true;
                header('location:../../../paginas/cadastrar_se.php');
            }
        }
        if($error_email) {
            $sql_username = 'SELECT username FROM users';
            $resultado_username  = mysqli_query($conexao, $sql_username);
            $linha_username = mysqli_fetch_all($resultado_username,1);
            $noSpaces = explode(' ',$nome);
            $username_sub = substr($noSpaces[0], 0,4);
            $username_DF = '@'.$username_sub.rand(0, 500000);
            $manteiga = false;
            while (true){ 
                foreach($linha_username as $usernameV) {
                    if($username_DF == $usernameV['username']){
                        echo 'ops! tem um igual como??';
                        $username_DF = '@'.$username_sub.rand(0, 500000);
                        continue;
                    } else {
                        $manteiga = true;
                        break;
                    }
                }
                if($manteiga) {
                    echo "não tinha nenhum igual";
                    break;
                }
            }
           $sql_cadastro = "INSERT INTO users(username, email, nome, senha, foto_perfil, banner_pefil, bio, data_nas, status_) VALUE ('$username_DF', '$email', '$nome', '$pass',NULL,NULL,NULL,'$datOt', 0)";
           $resultado_cadastro = mysqli_query($conexao,$sql_cadastro);
           if($resultado_cadastro) {
            session_destroy();
            header('location:../../../');
           } else {
            echo 'deu ruim';
           }
        }
    } else {
        $_SESSION['mensagem'] = 'Foi mal baixinho(a), você precisa ser maior de idade para cadastrar-se';
        header('location:../../../paginas/cadastrar_se.php');
    }

?>