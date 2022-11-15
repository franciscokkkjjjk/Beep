<?php
session_start();
if (isset($_GET['username'])) {
    require_once '../../conecta.php';
    require_once '../../function/funcoes.php';
    $json = array();
    $sql_user = "SELECT * FROM users WHERE username='" . $_GET['username'] . "'";
    $res_user = mysqli_query($conexao, $sql_user);
    $assoc_user = mysqli_fetch_assoc($res_user);

    $sql_game_user = "SELECT * FROM jogos_possui WHERE id_user=" . $_SESSION['id_user'];
    $res_game_user = mysqli_query($conexao, $sql_game_user);
    $arra_game_user = mysqli_fetch_all($res_game_user, 1);

    if ($assoc_user != null) {
        $sql_info = "SELECT * FROM jogos_possui WHERE id_user=" . $assoc_user['id_user'];
        $res_info = mysqli_query($conexao, $sql_info);
        if ($res_info) {
            $assoc_info = mysqli_fetch_all($res_info, 1);
            if ($assoc_info != null) {
                foreach ($assoc_info as $v) {
                    $sql_game = "SELECT * FROM jogos WHERE id_jogos=" . $v['id_game'];
                    $res_game = mysqli_query($conexao, $sql_game);
                    $assoc_game = mysqli_fetch_assoc($res_game);

                    //valida a classifcação indicativa
                    if (!valid_class_ind($_SESSION['data_nas'], $assoc_game['class_etaria'])) {
                        continue;
                    }

                    $possui = false;
                    foreach ($arra_game_user as $v_game) {
                        if ($v_game['id_game'] == $v['id_game']) {
                            $possui = true;
                        }
                    }
                    $json[] = [
                        'id_game' => $assoc_game['id_jogos'],
                        'nome_jogo' => $assoc_game['nome_jogo'],
                        'capa_game' => $assoc_game['img_jogo'],
                        'faixa_etaria' => $assoc_game['class_etaria'],
                        'possui' => $possui
                    ];
                }
            } else {
                $json = [
                    'nada' => 'nada por aqui'
                ];
            }
        } else {
            $json = [
                'error' => true,
                'mensage' => 'Algo deu errado! Atualize a pagina e tente novamente.'
            ];
        }
    } else {
        $json = [
            'error' => true,
            'mensage' => 'O usuário não existe.'
        ];
    }
} else {
    $json = [
        'error' => true,
        'mensage' => 'O username não existe. Tente novamente.'
    ];
}
if(is_null($json) OR empty($json)) {
    $json = [
        'nada' => 'nada por aqui'
    ];
}
echo json_encode($json);
