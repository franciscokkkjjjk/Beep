<?php
session_start();
//Deve colocar todas as publicações do magrao em quarentena
//deve suspender o magrao até uma segunda ordem ou o tempo dele acabar
if (isset($_SESSION['id_root'])) {
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();
    require_once '../conect_pdo.php';
    $id_user = $pdo->escape_string($_POST['x_ID30']);
    $tempo_supensao = $pdo->real_escape_string($_POST['x_U30']);
    $Date = date("d-m-Y");
    if ($tempo_supensao != NULL) {
        $tempo_supensao = date('Y-m-d H:i:s', strtotime($Date . ' + ' . $tempo_supensao . ' days'));
    }
    $suspender_user = $pdo->query("UPDATE users SET users.tempo_suspensao='" . $tempo_supensao . "', users.status_=1 WHERE users.id_user=" . $id_user);
    $json = [
        "mensage" => '',
        'error' => false
    ];
    if (!$suspender_user) {
        $json = [
            "mensage" => 'Não foi possivel suspender o usuário.',
            'error' => true
        ];
        echo json_encode($json);
        die;
    } else {
        $json['mensage'] .= "Usuário suspenso com sucesso.";
        $json['error'] = false;
    }
    $suspender_publi = $pdo->query("UPDATE publicacoes SET publicacoes.quarentena=1 WHERE publicacoes.user_publi=".$id_user);
    if (!$suspender_publi) {
        $json["mensage"] .= "Não foi possivel colocar as publicações em quarentena.";
        $json['error'] = true;
    }
    echo json_encode($json);
    die;
}
