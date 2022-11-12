<?php 
if(isset($_GET['id_p'])) {
    session_start();
    require_once "../conect_pdo.php";
    $id_publi =  $pdo->real_escape_string($_GET['id_p']);
    if($id_publi == "" OR is_null($id_publi)) {
        $_SESSION['mensagem'] = "O id da publicação não foi enviado.";
        $_SESSION['error'] = true;
        header('location:../../../../paginas/visualizar_D.php');
        die;
    }
    $sql_post = $pdo->query("SELECT * FROM publicacoes WHERE id_publi=" . $id_publi)->fetch_assoc();
    if($sql_post['quarentena']) {
        $sql_upt = $pdo->query("UPDATE publicacoes SET quarentena=0 WHERE id_publi=".$id_publi);
    }
    $sql_d = $pdo->query("DELETE FROM denuncias WHERE post_denunciado=".$id_publi);
    if($sql_d) {
        $_SESSION['mensagem'] = "A publicação foi considerada como \"Tudo ok\", e as denúncias referentes a ela foram apagadas.";
        header('location:../../../../paginas/dununcias.php');
        die;
    } else {
        $_SESSION['mensagem'] = "Não foi possivel considerar ela como \"Tudo ok\", tente novamente.";
        $_SESSION['error'] = true;
        header('location:../../../../paginas/visualizar_D.php');
        die;
    }
}