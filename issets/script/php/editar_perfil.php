<?php 
$dat_in = mktime(0, 0, 0, date('m'), date('d'), date('Y'));;
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once 'conecta.php';
$nome_user = trim($_POST['nome_edit']);
$username_user = $_POST['username_edit'];
$bio_user = trim($_POST['bio_edit']);
$mes_user = $_POST['mes'];
$ano_user = intval($_POST['ano']);
$dia_user = intval($_POST['dia']);
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
for($i = 0;$i < 12;$i++){
    if($meses[$i] == $mes_user){
        $mesOut = $i+1;
        $datIn = mktime( 0, 0, 0, $mesOut, $dia_user, $ano_user);
        break;
    } else{
        $mesOut = intval($mes_user);
        $datIn = mktime( 0, 0, 0, $mesOut, $dia_user, $ano_user);
     }
}
$datOt = date('Y-m-d', $datIn);
var_dump($datOt);
$calc = $dat_in-$datIn;
$cal_pross00 = $calc/60;
$cal_pross0000 = $cal_pross00/60;
$cal_pross01 = $cal_pross0000/24;
$date_coverti = $cal_pross01/365.25;
if($date_coverti >= 18){
    $sql_valid_username = 'SELECT username FROM users';
    $resultado_valid_username = mysqli_query($conexao, $sql_valid_username);
    $array_valid_user = mysqli_fetch_all($resultado_valid_username, 1);
    $usernameDE =  '@'. $username_user;
    $usernameDE_session = $_SESSION['username'];
    $user_erro = false;
    if($usernameDE != $usernameDE_session) {
        $user_erro = true;
    }
    foreach($array_valid_user as $value_) {
        if($value_['username'] == $usernameDE and $user_erro) {
            $username_erro = true;
            echo "esse ja existe";
            break;
        } 
    }
    if(isset($username_erro)) {
        echo ' tem um igual e diferente da ssessao';
    } else {
        //upload do perfil;
        $diretorio = '../../imgs/profile/';
        $img_perfil = $_FILES['input_file_perfil']['name'];
        $img_diretorio_perfil = $diretorio . basename($_FILES["input_file_perfil"]["name"]);
        $perfil = 1;
        if($img_perfil == '') {
            $nome_banco_perfil = $_SESSION['img'];
        } else {
            unlink('../../imgs/profile/'.$_SESSION['img']);
            $extensao = strtolower(pathinfo($img_diretorio_perfil,PATHINFO_EXTENSION));
                if($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg"
                && $extensao != "gif" && $extensao != "jfif") {
                    $_SESSION['error_img'] = "O upload só pode ser apenas jpg, png, jpeg, gif ou jfif";
                    $banner = 0;
                    header('location:../../../paginas/perfil.php');
                }
            if($perfil == 1) {
                $novo_nome = uniqid().'.'.pathinfo($_FILES["input_file_perfil"]["name"],PATHINFO_EXTENSION);
                $nome_banco_perfil = $img_perfil.$novo_nome;
                move_uploaded_file($_FILES["input_file_perfil"]["tmp_name"], $img_diretorio_perfil.$novo_nome);
            }
        }
        //upload de banner 
        $img_banner = $_FILES['input_file_banner']['name'];
        $img_diretorio_banner = $diretorio . basename($_FILES["input_file_banner"]["name"]);
        $banner = 1;
        if($img_banner == '') {
            $nome_banco_banner = $_SESSION['img_banner'];
        } else {
            unlink('../../imgs/profile/'.$_SESSION['img_banner']);
            $extensao = strtolower(pathinfo($img_diretorio_banner,PATHINFO_EXTENSION));
                if($extensao != "jpg" && $extensao != "png" && $extensao != "jpeg"
                && $extensao != "gif" && $extensao != "jfif") {
                    $_SESSION['error_img'] = "O upload só pode ser apenas jpg, png, jpeg, gif ou jfif";
                    $banner = 0;
                    header('location:../../../paginas/perfil.php');
                    die;
                }
            if($banner == 1) {
                $novo_nome_banner = uniqid().'.'.pathinfo($_FILES["input_file_banner"]["name"],PATHINFO_EXTENSION);
                $nome_banco_banner = $img_banner.$novo_nome_banner;
                move_uploaded_file($_FILES["input_file_banner"]["tmp_name"], $img_diretorio_banner.$novo_nome_banner);
            }
        }
        //
        $sql_edit = "UPDATE users SET username='$usernameDE',nome='$nome_user',foto_perfil='$nome_banco_perfil',banner_pefil='$nome_banco_banner' ,bio='$bio_user', data_nas='$datOt' WHERE id_user=".$_SESSION['id_user'];
        $rest_edit = mysqli_query($conexao, $sql_edit);
        if($rest_edit) {
            $sql_user = 'SELECT * FROM users WHERE id_user='.$_SESSION['id_user'];
            $resultado_user = mysqli_query($conexao, $sql_user);
            $array_user= mysqli_fetch_all($resultado_user, 1);
            foreach($array_user as $user) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['bio_user'] = $user['bio'];
                $_SESSION['img'] = $user['foto_perfil'];
                $_SESSION['img_banner'] = $user['banner_pefil'];
                $_SESSION['data_nas'] = $user['data_nas'];
            }
            header('location:../../../paginas/perfil.php');
        }
    } 
}else{
    echo 'menor de idade';
}
//é possivel mandar funções de js pelo php $_session['funcao'] = 'funcaojs_()';
?>