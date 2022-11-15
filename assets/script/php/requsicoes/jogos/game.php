<?php
session_start();
require_once "../../conecta.php";
require_once "../../function/funcoes.php";
if (!isset($_SESSION['id_user'])) {
    header('location:../../../../../');
    die;
}
if (isset($_GET['pag'])) {
    $pag = $_GET['pag'];
} else {
    $pag = 1;
}
$json = array();

$limit = 50; //mudar isso ai kkkkkkkkkkkkkkkkkkk
$offset = $limit * ($pag - 1);

$sql_game = "SELECT * FROM jogos LIMIT $limit OFFSET $offset";
$res_game = mysqli_query($conexao, $sql_game);
$game_array = mysqli_fetch_all($res_game, 1);

$sql_game_user = "SELECT * FROM jogos_possui WHERE id_user=" . $_SESSION['id_user'];
$res_game_user = mysqli_query($conexao, $sql_game_user);
$arra_game_user = mysqli_fetch_all($res_game_user, 1);

if ($game_array != NULL) {
    foreach ($game_array as $value_game) {
        //valida a classifcação indicativa
        if (!valid_class_ind($_SESSION['data_nas'], $value_game['class_etaria'])) {
            continue;
        }
        $possui = false;
        foreach ($arra_game_user as $v_game) {
            if ($v_game['id_game'] == $value_game['id_jogos']) {
                $possui = true;
            }
        }
        $json[] = [
            'id_game' => $value_game['id_jogos'],
            'nome_jogo' => $value_game['nome_jogo'],
            'capa_game' => $value_game['img_jogo'],
            'faixa_etaria' => $value_game['class_etaria'],
            'possui' => $possui
        ];
    }
} else {
    $json = [
        'erro' => false,
        'nada' => 'nada por aqui'
    ];
}
if(empty($json) OR is_null($json)) {
    $json = [
        'erro' => false,
        'nada' => 'nada por aqui'
    ];
}
echo json_encode($json);
