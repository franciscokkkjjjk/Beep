<?php 
$dat_in = mktime(0, 0, 0, date('m'), date('d'), date('Y'));;
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once 'conecta.php';
$nome_user = $_POST['nome_edit'];
$username_user = $_POST['username_edit'];
$bio_user = addslashes($_POST['bio_edit']);
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
        //upload de arquivo
            //foto de perfil 
            $_FILES["input_file_perfil"]["name"];
    $target_dir = "../../imgs/profile/";//tem que renomear os arquivos antes de criar no banco de dados
    $target_file = $target_dir . basename($_FILES["input_file_perfil"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $novo_nome = uniqid().'.'.pathinfo($_FILES["input_file_perfil"]["name"],PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["input_file_perfil"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['error_img'] = 'O upload não era uma imagem.';
        $uploadOk = 0;
        header('location:../../../paginas/index.php');
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    $_SESSION['error_img'] = 'A imagem não existe';
    $uploadOk = 0;
    header('location:../../../paginas/perfil.php');
    }

    // Check file size
    if ($_FILES["input_file_perfil"]["size"] > 500000) {
    $_SESSION['error_img'] = 'a imagem é muito grande.';
    $uploadOk = 0;
    header('location:../../../paginas/perfil.php');
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" && $imageFileType != "jfif") {
    $_SESSION['error_img'] = "O upload só pode ser apenas jpg, png, jpeg, gif ou jfif";
    $uploadOk = 0;
    header('location:../../../paginas/perfil.php');
    }

    //banner_upload
    $_FILES["input_file_banner"]["name"];
    $target_file_banner = $target_dir . basename($_FILES["input_file_banner"]["name"]);
    $uploadOk = 1;
    $imageFileType_banner = strtolower(pathinfo($target_file_banner,PATHINFO_EXTENSION));
    $novo_nome_banner = uniqid().'.'.pathinfo($_FILES["input_file_banner"]["name"],PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
    $check_banner = getimagesize($_FILES["input_file_banner"]["tmp_name"]);
    if($check_banner !== false) {
        $uploadOk = 1;
    } else {
        $_SESSION['error_img'] = 'O upload não era uma imagem.';
        $uploadOk = 0;
        header('location:../../../paginas/perfil.php');
    }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
    $_SESSION['error_img'] = 'A imagem não existe';
    $uploadOk = 0;
    header('location:../../..');
    }

    // Check file size
    if ($_FILES["input_file_banner"]["size"] > 500000) {
    $_SESSION['error_img'] = 'a imagem é muito grande.';
    $uploadOk = 0;
    header('location:../../../paginas/perfil.php');
    }

    // Allow certain file formats
    if($imageFileType_banner != "jpg" && $imageFileType_banner != "png" && $imageFileType_banner != "jpeg"
    && $imageFileType_banner != "gif" && $imageFileType_banner != "jfif") {
    $_SESSION['error_img'] = "O upload só pode ser apenas jpg, png, jpeg, gif ou jfif";
    $uploadOk = 0;
    header('location:../../../paginas/perfil.php');
    }

    //
    if ($uploadOk == 0) {
        header('location:../../../paginas/perfil.php');
    // if everything is ok, try to upload file
    } else {
    if (move_uploaded_file($_FILES["input_file_perfil"]["tmp_name"], $target_file.$novo_nome) and move_uploaded_file($_FILES["input_file_banner"]["tmp_name"], $target_file_banner.$novo_nome)) {
        $img = basename($_FILES["input_file_perfil"]["name"]);
        $img_name = $img.$novo_nome;
        //
        $img_banner = basename($_FILES["input_file_banner"]["name"]);
        $img_name_banner = $img_banner.$novo_nome_banner;
        //
        $sql_edit = "UPDATE users SET username='$usernameDE',nome='$nome_user', bio='$bio_user',foto_perfil='$img_name',banner_pefil='$img_name_banner' ,data_nas='$datOt' WHERE id_user=".$_SESSION['id_user'];
        $rest_edit = mysqli_query($conexao, $sql_edit);
        if($rest_edit) {
            $sql_user = 'SELECT * FROM users WHERE id_user='.$_SESSION['id_user'];
            $resultado_user = mysqli_query($conexao, $sql_user);
            $array_user= mysqli_fetch_all($resultado_user, 1);
            foreach($array_user as $user) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['img'] = $user['foto_perfil'];
                $_SESSION['img_banner'] = $user['banner_pefil'];
                $_SESSION['bio_user'] = $user['bio'];
                $_SESSION['data_nas'] = $user['data_nas'];
            }
            header('location:../../../paginas/perfil.php');
        }
    }
}
} 
}else{
    echo 'menor de idade';
}
//é possivel mandar funções de js pelo php $_session['funcao'] = 'funcaojs_()';
?>