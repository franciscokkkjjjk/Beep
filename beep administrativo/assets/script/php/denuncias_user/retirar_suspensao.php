<?php
session_start();
if (isset($_SESSION['id_root'])) {
    require_once '../conect_pdo.php';
    $id_user_d =  $pdo->escape_string($_POST['x_ID30']);
    $verify = $pdo->query("SELECT * FROM users WHERE id_user=" . $id_user_d)->fetch_assoc();
    if (is_null($verify) or empty($verify)) {
        $json = [
            'mensage' => 'Esse usuário não existe mais.',
            'error' => true
        ];
        echo json_encode($json);
        die;
    }
    $upt_sus = $pdo->query("UPDATE users SET status_=0, tempo_suspensao=null WHERE id_user=".$id_user_d);
    if(!$upt_sus) {
        $json = [
            'mensage' => 'Não foi possivel retirar o usuário da suspensão.',
            'error' => true
        ];
        echo json_encode($json);
        die;
    }
    $upt_publi = $pdo->query("UPDATE publicacoes SET quarentena=0 WHERE user_publi=".$id_user_d);
    if(!$upt_publi) {
        $json = [
            'mensagem' => 'usuário fora da suspensão, mas infelismente não foi possivel tirar suas publicações da quarentena.',
            'error' => true
        ];
        echo json_encode($json);
        die;
    }
    $json = [
        'mensage' => 'Usuário foi tirado da supensão com sucesso.',
        'error' => false
    ];
    echo json_encode($json);
    die;
}
