<?php 
    session_start();
    require_once 'conecta.php';
    if(!isset($_SESSION['id_user'])) {
        header('location:../../../paginas/inicial.php');
    }
    $user_un = $_POST['iD_x30'];
    $sql_unf = 'DELETE FROM seguidores WHERE user_seguin='.$_SESSION['id_user'].' AND user_seguido='.$user_un;
    $res_unf = mysqli_query($conexao, $sql_unf);
    $sql_user_unf = 'SELECT t_seguidores FROM users WHERE id_user='.$user_un;
    $res_user_unf = mysqli_query($conexao, $sql_user_unf);
    $array_user_unf = mysqli_fetch_assoc($res_user_unf);
    $cal_user_unf =  intval($array_user_unf['t_seguidores'])-1;
    $sql_user_unf_up = "UPDATE users SET t_seguidores='$cal_user_unf' WHERE id_user=".$user_un;
    $res_user_unf_up = mysqli_query($conexao, $sql_user_unf_up);
    $sql_session_unf = 'SELECT t_seguindo FROM users WHERE id_user='.$_SESSION['id_user'];
    $res_session_unf = mysqli_query($conexao, $sql_session_unf);
    $array_session_unf = mysqli_fetch_assoc($res_session_unf);
    $cal_session_unf =  intval($array_session_unf['t_seguindo']) -1;
    $sql_session_unf_up = "UPDATE users SET t_seguindo='$cal_session_unf' WHERE id_user=".$_SESSION['id_user'];
    $res_session_unf_up = mysqli_query($conexao, $sql_session_unf_up);
    if($res_unf and $res_user_unf_up and $res_session_unf_up) {
        header("Location: ".$_SERVER['HTTP_REFERER']."");
    }
?>