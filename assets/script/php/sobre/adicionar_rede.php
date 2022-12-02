<?php
session_start();
require_once '../conect_pdo.php';
if (isset($_POST['username_rede'])) {
    $json = [
        'mensage' => 'Rede social adicionada com sucesso.',
        'error' => false
    ];
    $user_ = $_SESSION['id_user'];
    $username = $pdo->real_escape_string($_POST['username_rede']);
    $value_rede = intval($pdo->real_escape_string($_POST['rede_a']));
    $type = $value_rede;
    $username = str_replace('@', '', $username);
    if ($value_rede == 1) {
        $value_rede = 'https://twitter.com/' . $username;
    } else if ($value_rede == 2) {
        $value_rede = 'https://www.instagram.com/' . $username;
    } else if ($value_rede == 3) {
        $value_rede = 'https://www.facebook.com/' . $username;
    } else if ($value_rede == 4) {
        $value_rede = 'https://twitter.com/' . $username;
    } else if ($value_rede == 5) {
        $value_rede = "https://steamcommunity.com/id/" . $username;
    } else {
        $json = [
            'mensage',
            'error' => true
        ];
    }
    $add_rede = $pdo->query("INSERT INTO sobre(id_user, type_r, username_rede, username_txt) VALUES ($user_, $type, '$value_rede', '$username')");
    if (!$add_rede) {
        $json = [
            'mensage' => 'Não foi possivel adicionar a rede social.',
            'error' => true
        ];
    }
    echo json_encode($json);
}