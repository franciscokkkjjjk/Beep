<?php
session_start();
require_once '../../conecta.php';
if (isset($_GET['id_game'])) {
    $sql_verify = "SELECT * FROM jogos_possui WHERE id_user=".$_SESSION['id_user']." AND id_game=".$_GET['id_game'];
    $res_verify = mysqli_query($conexao, $sql_verify);
    $assoc_verify = mysqli_fetch_assoc($res_verify);
    if($assoc_verify == null) {
        $sql_game_add = "INSERT INTO jogos_possui(id_user, id_game) VALUES (" . $_SESSION['id_user'] . "," . $_GET['id_game'] . ")";
        $res_game_add = mysqli_query($conexao, $sql_game_add);
        if ($res_game_add) {
            $json = [
                'error' => false,
                'mensage' => 'jogo adicionado a conta.'
        ];
        }
    } else {
        $json = [
            'error' => true,
            'mensage' => 'Esse jogo já foi adicionado a conta.'
    ];
    }
    // adicionar na tabela de jogos posuidos
} else {
    $json = [
        'error' => true,
        'mensage' => 'id_game não existe.'
    ];
}
echo json_encode($json);
