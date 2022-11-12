<?php
echo 'em construção...';

//mandei o ultimo por GET então esse tbm vai ser mandado por get
//deve apenas excluir a publicação == as outras verficações serão feitas em outros arq
if (isset($_GET['id_p'])) {
    session_start();
    require_once "../conect_pdo.php";
    $id_publi =  $pdo->real_escape_string($_GET['id_p']);
    if ($id_publi == "" or is_null($id_publi)) {
        $_SESSION['mensagem'] = "O id da publicação denunciada não foi inserida.";
        $_SESSION['error'] = true;
        header('location:../../../../paginas/visualizar_D.php');
        die;
    }
    $sql_verify = $pdo->query("SELECT * FROM denuncias WHERE post_denunciado=" . $id_publi)->fetch_all(1);
    if (count($sql_verify) < 1) {
        $_SESSION['mensagem'] = "A denúncia não existe mais.";
        $_SESSION['error'] = true;
        header('location:../../../../paginas/dununcias.php');
        die;
    }
    $sql_verify_2 = $pdo->query("SELECT * FROM publicacoes WHERE id_publi=" . $id_publi)->fetch_assoc();
    if (is_null($sql_verify_2)) {
        $sql_delete_solicitacoes = $pdo->query("DELETE FROM denuncias WHERE post_denunciado=" . $id_publi);
        if ($sql_delete_solicitacoes) {
            $_SESSION['mensagem'] = "A publicação não existe mais.";
            $_SESSION['error'] = true;
            header('location:../../../../paginas/dununcias.php');
            die;
        } else {
            $_SESSION['mensagem'] = "Não foi possivel deletar as denuncias da publicação que não existe mais.";
            $_SESSION['error'] = true;
            header('location:../../../../paginas/visualizar_D.php');
            die;
        }
    }
    $sql_delete_publi = $pdo->query("DELETE FROM publicacoes WHERE id_publi=" . $id_publi);
    if ($sql_delete_publi) {
        $_SESSION['mensagem'] = "";
        $_SESSION['mensagem'] .= "A publicação foi excluida com sucesso.";
        if ($sql_verify_2['img_publi'] != "") {
            if (unlink("../../../../../assets/imgs/posts/" . $sql_verify_2['img_publi'])) {
                $_SESSION['mensagem'] .= "<br> A mídia da publicação foi excluida com sucesso.";
            } else {
                $_SESSION['mensagem'] .= "<br> A mídia da publicação não pode ser excluida.";
            }
        }
        
        
        
        
        // eu tava verifcando as curtidas na ultima vez l=kkkkkkkk
        
        
        
        
        
        
        
        
        
        $sql_delete_curtidas = $pdo->query("DELETE FROM curtidas WHERE id_postagem=" . $id_publi); // não terá mensagem ------------esse deleta as curtidas da publicação -------------
        $sql_delete_compartilhadas = $pdo->query("DELETE FROM publicacoes WHERE id_publi_interagida=" . $id_publi . ' AND type=4'); // não terá mensagem ------------esse deleta as curtidas da publicação -------------
        $sql_delete_denuncia_all = $pdo->query("DELETE FROM denuncias WHERE post_denunciado=" . $id_publi);
        if (!$sql_delete_denuncia_all) {
            $_SESSION['mensagem'] .= "<br> As denunicias não puderam ser deletadas.";
        }
        header("location:../../../../paginas/dununcias.php");
        die;
    } else {
        $_SESSION['mensagem'] = "A publicação foi pode ser excluida com êxito.";
        $_SESSION['error'] = true;
        header("location:../../../../paginas/visualizar_D.php");
        die;
    }
}
