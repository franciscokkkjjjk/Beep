<?php 
    session_start();
    if(isset($_POST['p_xD30_info_'])) {
        require_once '../conecta.php';
        $id_publi = $_POST['p-xD30'];
        $sql_publi = 'SELECT * FROM publicacoes WHERE id_publi='.$id_publi;
        $res_publi = mysqli_query($conexao, $sql_publi);
        $assoc_publi = mysqli_fetch_assoc($res_publi);
        $num_comentario = intval($assoc_publi['num_comentario'])+1;
        if($assoc_publi['type'] == 4) {
            $sql_raiz_publi = "SELECT * FROM publicacoes Where publicacoes.id_publi=".$assoc_publi['id_publi_interagida'];
            $res_raiz_publi = mysqli_query($conexao, $sql_raiz_publi);
            $assoc_raiz_publi = mysqli_fetch_assoc($res_raiz_publi);
            $num_comentario = intval($assoc_raiz_publi['num_comentario'])+1;
            $id_publi = $assoc_raiz_publi['id_publi'];
        }
        $arquivo = $_FILES['img_post']['name'];
        if($arquivo == '' or $arquivo == null) {
           $nome_banco_ar = null; 
        } else {
            $diretorio = '../../../imgs/posts/';
            $novo_nome = uniqid().'.'.pathinfo($_FILES["img_post"]["name"],PATHINFO_EXTENSION);
            $nome_banco_ar = $novo_nome;
            move_uploaded_file($_FILES["img_post"]["tmp_name"], $diretorio.$novo_nome);
        }
        $text_post = addslashes($_POST['p_xD30_info_']);
        date_default_timezone_set('America/Sao_Paulo');
        date_default_timezone_get();
        $data_publi = date('Y-m-d H:i:s');
        $sql_coment = "INSERT INTO publicacoes(user_publi, type, id_publi_interagida, text_publi, img_publi, num_curtidas, num_compartilha, date_publi, num_comentario, quarentena) VALUE (".$_SESSION['id_user'].",1, ".$id_publi.",'$text_post','$nome_banco_ar', 0, 0, '$data_publi', 0, 0)";
        $res_coment = mysqli_query($conexao, $sql_coment);
        if($res_coment) {
            $sql_upt = "UPDATE publicacoes SET num_comentario=".$num_comentario." WHERE id_publi=".$id_publi;
            $res_upt = mysqli_query($conexao, $sql_upt);
            if($res_upt){
                $json = [
                    'mensage' => 'Comentário enviado com sucesso.'
                ];
                echo json_encode($json);
            }
        }
    } else {
        echo json_encode($json);
    } 
?>