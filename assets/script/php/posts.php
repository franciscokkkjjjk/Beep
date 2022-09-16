<?php 
    session_start();
    require_once 'conecta.php';
    if($_POST['post_text'] == '') {
        $text_post = NULL;
    } else {
        $text_post = addslashes($_POST['post_text']);
    }
    if($img_perfil = $_FILES['img_post']['name'] == '') {
        $nome_banco_perfil = NULL;
    } else {
        $diretorio = '../../imgs/posts/';
        $img_post = $_FILES['img_post']['name'];
        $img_diretorio_post = $diretorio . basename($_FILES["img_post"]["name"]);
        $extensao = pathinfo($_FILES["img_post"]["name"],PATHINFO_EXTENSION);
        if($extensao != "mp4" AND $extensao != "jpeg" and $extensao != "gif" and $extensao != "png" and $extensao != "jfif"  AND $extensao != "jpg") {
            var_dump($extensao);
            $_SESSION['menssagem'] = 'O arquivo que você tentou inserir não atende os requsitos necessários.';
            $_SESSION['fal'] = true;
            header('location:../../../paginas/inicial.php');
            die;
        }
        $novo_nome = uniqid().'.'.pathinfo($_FILES["img_post"]["name"],PATHINFO_EXTENSION);
        $nome_banco_perfil = $novo_nome;
        move_uploaded_file($_FILES["img_post"]["tmp_name"], $diretorio.$novo_nome);
    }
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();
    $data_publi = date('Y-m-d H:i:s');
    $sql_post = "INSERT INTO publicacoes(user_publi, type, id_publi_interagida, text_publi, img_publi, num_curtidas, num_compartilha, date_publi, num_comentario, id_game) VALUE (".$_SESSION['id_user'].",3, NULL,'$text_post','$nome_banco_perfil', 0, 0, '$data_publi', 0, NULL)";
    $res_post = mysqli_query($conexao, $sql_post);
    var_dump($res_post);
    if($res_post) {
        $_SESSION['menssagem'] = 'Postagem enviada com sucesso.';
        header('location:../../../paginas/inicial.php');
    }
?>