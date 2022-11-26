<?php
if (isset($_SESSION['id_root'])) {
    session_start();
    require_once '../conect_pdo.php';
    $id_user = $pdo->escape_string($_POST['x_ID30']);
    $upt = $pdo->query("UPDATE users SET status_=0, tempo_suspensao=NULL WHERE id_user=" . $id_user);
    $json = [
        'mensage' => 'Denúncia definida como "Tudo ok" com sucesso',
        'error' => false
    ];
    if (!$upt) {
        $json = [
            'mensage' => 'Não foi possivel definir denuncia com "Tudo ok"',
            'error' => true,
        ];
        echo json_encode($json);
        die;
    }
    $upt_publi = $pdo->query("UPDATE publicacoes SET publicacoes.quarentena=0 WHERE publicacoes.user_publi=" . $id_user);
    if (!$upt_publi) {
        $json['mensage'] .= "<br>Não foi possivel tirar da quarentena as publicações do usuário.";
    }
    $delete_d = $pdo->query("DELETE FROM denuncias_user=" . $id_user);
    if (!$delete_d) {
        $json['mensage'] .= "<br>Não foi possivel deletar as denúncias.";
    }
    echo json_encode($json);
}
