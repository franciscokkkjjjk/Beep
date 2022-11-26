<?php
session_start();
if (isset($_SESSION['id_root'])) {
    require_once '../conect_pdo.php';
    $id_user = $pdo->escape_string($_GET['x_ID30']);
    $upt = $pdo->query("UPDATE users SET status_=0, tempo_suspensao=NULL WHERE id_user=" . $id_user);
    if (!$upt) {
        $_SESSION['mensagem'] = 'Não foi possivel definir denuncia com "Tudo ok"';
        $_SESSION['error'] = true;
        header('location: ../../../../paginas/visualizar_D_U.php');
        die;
    }
    $upt_publi = $pdo->query("UPDATE publicacoes SET publicacoes.quarentena=0 WHERE publicacoes.user_publi=" . $id_user);
    if (!$upt_publi) {
        $_SESSION['mensagem'] = "<br>Não foi possivel tirar da quarentena as publicações do usuário.";
        $_SESSION['error'] = true;
        header('location: ../../../../paginas/denuncias_usuario.php');
        die;
    }
    $delete_d = $pdo->query("DELETE FROM denuncias_user WHERE id_user_denunciado=" . $id_user);
    if (!$delete_d) {
        $_SESSION['mensagem'] = "<br>Não foi possivel deletar as denúncias.";
        $_SESSION['error'] = true;
        header('location: ../../../../paginas/denuncias_usuario.php');
        die;
    }
    $_SESSION['mensagem'] = "denúncia definada como 'Tudo ok' com sucesso.";
    header('location: ../../../../paginas/visualizar_D_U.php');
    die;
}
