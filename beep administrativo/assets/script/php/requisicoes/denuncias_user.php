<?php
session_start();
if (isset($_SESSION['id_root'])) {
    require_once '../conecta.php';
    $sql_denuncia = "SELECT distinct *, count(`id_user_denunciado`) as `qts_denunciado` from denuncias_user group by `id_user_denunciado` ORDER BY count(`id_user_denunciado`) DESC;";
    $res_denuncia = mysqli_query($conexao, $sql_denuncia);
    $array_list = mysqli_fetch_all($res_denuncia, 1);
    $json = array();

    if (empty($array_list) or is_null($array_list)) {
        $json[] = [
            'erro' => false,
            'id' => null,
            'title' => 'Não há nenhum usuário denunciado ainda.',
            'img' => null
        ];
        echo json_encode($json);
        die;
    }
    foreach ($array_list as $v) {
        $num_d = 0;
        foreach ($array_list as $v2) {
            if ($v['id_user_denunciado'] == $v2['id_user_denunciado']) {
                $num_d++;
            }
        }
        $sql_user = "SELECT * FROM users WHERE id_user=" . $v['id_user_denunciado'];
        $res_user = mysqli_query($conexao, $sql_user);
        $ass_user = mysqli_fetch_assoc($res_user);
        if (empty($ass_user) or is_null($ass_user)) {
            continue;
        }
        $json[] = [
            'erro' => false,
            'id' => $v['id_denuncia_'],
            'title' => $v['id_user_denunciado'],
            'num' =>   $v['qts_denunciado'],
            'img' => $ass_user['foto_perfil']
        ];
    }
    if (count($json) == 0) {
        $json[] = [
            'erro' => false,
            'id' => null,
            'title' => 'Não há nenhum usuário denunciado ainda.',
            'img' => null
        ];
    }
    echo json_encode($json);
}
