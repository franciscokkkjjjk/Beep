<?php 
    session_start();
    $date_atual = date("d-m-y");
    $dat_in = strtotime($date_atual);
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
    $datIn = strtotime($mesOut.'/'.$dia_nas.'/'.$ano_nas);
    $datOt = date('Y-m-d', $datIn);
    $calc = $dat_in-$datIn;
    $cal_pross00 = $calc/213195;
    $cal_pross01 = $cal_pross00/24;
    $cal_pross02 = $cal_pross01/4;
    $date_coverti = $cal_pross02/1.2;
    if($date_coverti >= 18){
        $sql_valid = 'SELECT email FROM users';
        $resultado_valid  = mysqli_query($conexao,$sql_valid);
        $linha_valid = mysqli_fetch_all($resultado_valid,1);
        foreach($linha_valid as $valid) {
            if($valid['email'] == $email) {
                $_SESSION['nome'] = $nome;
                $_SESSION['email'] = $email;
                $_SESSION['dia_nas'] = $dia_nas;
                $_SESSION['mes_nas'] = $mes_nas;
                $_SESSION['ano_nas'] = $ano_nas;
                $_SESSION['email'] = $email;
                $_SESSION['mensagem'] = 'Esse email já esta sendo usado.';
                $_SESSION['erroEmail'] = true;
                header('location:../../../paginas/cadastrar_se.php');
            } else {
                $sql_username = 'SELECT username FROM users';
                $resultado_username  = mysqli_query($conexao, $sql_username);
                $linha_username = mysqli_fetch_all($resultado_username,1);
                $nome = 'francisco brum gomes';
                $noSpaces = explode(' ',$nome);
                $contagem_user = mb_strlen($noSpaces[0]);
                $contagem_user00 = $contagem_user/3;
                for($i = 0; $i < $cal_pross00; $i++) {
                    
                }
                var_dump($a);
                foreach($linha_username as $usernameV) {
                    //.
                }
                var_dump($linha_username);
               //$sql_cadastro = "INSERT INTO users(username, email, nome, senha, foto_perfil, bio, data_nas) VALUE (@$nome)";
            }
        }
    } else {
        $_SESSION['mensagem'] = 'Foi mal baixinho(a), você precisa ser maior de idade para cadastrar-se';
        header('location:../../../paginas/cadastrar_se.php');
    }

?>