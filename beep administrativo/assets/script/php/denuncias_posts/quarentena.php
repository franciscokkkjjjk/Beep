<?php 
    session_start();
    if(isset($_GET['id_p'])) {
        require_once '../conect_pdo.php';
        $id_p = $pdo->real_escape_string($_GET['id_p']);
        $quantena = $pdo->query("UPDATE publicacoes SET quarentena=1 WHERE id_publi=".$id_p);
        if($quantena) {
            $_SESSION['mensagem'] = "Publicação colocada em quarentena com sucesso.";
            header('location:../../../../paginas/visualizar_D.php');
            die;
        } else {
            $_SESSION['mensagem'] = "Não foi possivel colocar a publicação em quarentena.";
            $_SESSION['error'] = true;
            header('location:../../../../paginas/visualizar_D.php');
            die;
        }

    }
?>