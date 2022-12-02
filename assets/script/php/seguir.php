<?php
    session_start();
    require_once 'conecta.php';
    $id_perfil_seguir = mysqli_real_escape_string($conexao, $_POST['iD_x30']);
    $sql_user1 = 'SELECT t_seguindo FROM users WHERE id_user='.$_SESSION['id_user'];
    $res_user1 = mysqli_query($conexao, $sql_user1);
    $array_user1= mysqli_fetch_assoc($res_user1);
    $sql_user2 = 'SELECT * FROM users WHERE id_user='.$id_perfil_seguir;
    $res_user2 = mysqli_query($conexao, $sql_user2);
    $array_user2 = mysqli_fetch_assoc($res_user2);
    $sql_perfil_num0 = "INSERT INTO seguidores(user_seguin, user_seguido) VALUE (".intval($_SESSION['id_user']).", ".intval($id_perfil_seguir).")";
    $res_perfil_num0 = mysqli_query($conexao, $sql_perfil_num0);
    if($res_perfil_num0) {
        $sql_tabela_s = "SELECT * FROM seguidores WHERE user_seguin=". $_SESSION['id_user'];
        $res_user_seguindo = mysqli_query($conexao, $sql_tabela_s);
        $ass_seguidores = mysqli_fetch_all($res_user_seguindo,1);
        $num_seguindo = count($ass_seguidores)-1;

        $sql_tabela_s = "SELECT * FROM seguidores WHERE user_seguido=". $array_user2['id_user'];
        $res_user_seguindo = mysqli_query($conexao, $sql_tabela_s);
        $ass_seguidores = mysqli_fetch_all($res_user_seguindo,1);

        $num_seguido = count($ass_seguidores)-1;

        $sql_update_num0 = "UPDATE users SET t_seguindo='$num_seguindo' WHERE id_user=".$_SESSION['id_user'];
        $res_upt_num0 = mysqli_query($conexao, $sql_update_num0);
        $sql_update_num1 = "UPDATE users SET t_seguidores='$num_seguido' WHERE id_user=".$id_perfil_seguir;
        $res_upt_num1 = mysqli_query($conexao, $sql_update_num1);
        if($res_upt_num0 and $res_upt_num1) {
                header("Location: ".$_SERVER['HTTP_REFERER']."");
        }
    }
?>