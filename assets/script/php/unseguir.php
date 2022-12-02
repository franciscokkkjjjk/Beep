<?php 
    session_start();
    require_once 'conecta.php';
    if(!isset($_SESSION['id_user'])) {
        header('location:../../../paginas/inicial.php');
    }
    $user_un = $_POST['iD_x30'];
    $sql_unf = 'DELETE FROM seguidores WHERE user_seguin='.$_SESSION['id_user'].' AND user_seguido='.$user_un;
    $res_unf = mysqli_query($conexao, $sql_unf);
    $sql_user_unf = 'SELECT * FROM seguidores WHERE user_seguido='.$user_un;

    $res_user_unf = mysqli_query($conexao, $sql_user_unf);
    $array_user_unf = mysqli_fetch_all($res_user_unf, 1);
    $cal_user_unf =  count($array_user_unf)-1;

    $sql_user_unf_up = "UPDATE users SET t_seguidores='$cal_user_unf' WHERE id_user=".$user_un;
    $res_user_unf_up = mysqli_query($conexao, $sql_user_unf_up);

    $sql_session_unf = 'SELECT * FROM users WHERE id_user='.$_SESSION['id_user'];
    $res_session_unf = mysqli_query($conexao, $sql_session_unf);
    $array_session_unf = mysqli_fetch_assoc($res_session_unf);

    $sql_segundo = "SELECT * FROM seguidores WHERE user_seguin=".$_SESSION['id_user'];
    $res_ = mysqli_query($conexao, $sql_segundo);
    $ass_ = mysqli_fetch_all($res_,1);
    $cal_session_unf =  count($ass_)-1;

    $sql_session_unf_up = "UPDATE users SET t_seguindo='$cal_session_unf' WHERE id_user=".$_SESSION['id_user'];
    $res_session_unf_up = mysqli_query($conexao, $sql_session_unf_up);
    if($res_unf and $res_user_unf_up and $res_session_unf_up) {
        header("Location: ".$_SERVER['HTTP_REFERER']."");
    }
?>