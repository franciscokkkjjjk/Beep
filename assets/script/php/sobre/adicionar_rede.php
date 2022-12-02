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
    $sql_ = $pdo->query("SELECT * FROM sobre WHERE id_user=" . $user_ . " AND type_r=" . $type . " AND username_txt='" . $username . "'")->fetch_assoc();
    if (!is_null($sql_) or !empty($sql_)) {
        $json = [
            'mensage' => 'Você já adicionou essa rede social',
            'error' => true
        ];
        echo json_encode($json);
        die;
    }
    if ($value_rede == 1) {
        $value_rede = 'https://twitter.com/' . $username;
    } else if ($value_rede == 2) {
        $value_rede = 'https://www.instagram.com/' . $username;
    } else if ($value_rede == 3) {
        $value_rede = 'https://www.facebook.com/' . $username;
    } else if ($value_rede == 4) {
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

if(isset($_POST['x_REMOVEXD30'])) {
    $type = $pdo->real_escape_string($_POST['x_TYPE30']);
    $username = $pdo->real_escape_string($_POST['x_REMOVEXD30']);
    $sql_ = $pdo->query("DELETE FROM sobre WHERE type_r=" . $type . " AND username_txt='" . $username . "'");
    if($sql_) {
        $json = [
            'mensage' => "Rede social removida com sucesso.",
            'error' => false
        ];
    } else {
        $json = [
            'mensage' => "Rede social não pode ser removida.",
            'error' => true
        ];
    }
    echo json_encode($json);

}