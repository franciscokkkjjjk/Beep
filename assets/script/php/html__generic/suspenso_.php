<?php
$sql_user_sus = "SELECT * FROM users WHERE id_user=" . $_SESSION['id_user'];
$res_user_sus = mysqli_query($conexao, $sql_user_sus);
$assoc_user_sus = mysqli_fetch_assoc($res_user_sus);
if ($assoc_user_sus['status_']) {
    $temp = $assoc_user_sus['tempo_suspensao'];
    $continue = true;
   
    if ($temp == null) {
        $temp = "Indeterminado.";
    } else {
        $temp = strtotime($temp) - strtotime(date('Y-m-d H:i:s'));
        $temp = floor(((($temp / 60) / 60) / 24));
        if ($temp > 1) {
            $temp .= " dias";
        } elseif ($temp < 0) {
            $sql_user_sus = "UPDATE users SET status_=0, tempo_suspensao=NULL WHERE id_user=" . $_SESSION['id_user'];
            $res_user_sus = mysqli_query($conexao, $sql_user_sus);
            $continue = false;
        } else {
            $temp .= " dia";
        }
    }
    if ($continue) {
        $_SESSION['mensagem'] = 'Sua conta está suspensa. Tempo: ' . $temp;
        header('location: ../');
        unset($_SESSION['id_user']);
        die;
    }
}
