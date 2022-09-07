<?php
session_start(); 
if(isset($_POST['cC_xd30'])) {
    require_once '../conecta.php';
    $text_post = addslashes($_POST['cC_xd30']);
    $id_interagida = $_POST['cI_xd30']; 
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();
    $data_publi = date('Y-m-d H:i:s');
    $arquivo_name  = $_FILES['midia_repost']['name'];
    if($arquivo_name == '' or $arquivo_name == null) {
        $name_banco = null;
    } else {
        $diretorio = '../../../imgs/posts/';
        $ex = strtolower(pathinfo($arquivo_name,PATHINFO_EXTENSION));
        $name_banco = bin2hex(random_bytes(20)) . '.' . $ex;
        if(!move_uploaded_file($_FILES["midia_repost"]["tmp_name"], $diretorio.$name_banco)) {
            $json = [
                'error' => true,
                'mensage' => 'Algo deu errado! Parece que o upload não pode ser concluido.'
             ];
             echo json_encode($json);
             die;
        }
    }
    //$sql_respot_coment = "INSERT INTO publicacoes(user_publi, type, id_publi_interagida, text_publi, img_publi, num_curtidas, num_compartilha, date_publi, num_comentario) VALUE (".$_SESSION['id_user'].",2, ".$id_interagida.",'$text_post','$name_banco', 0, 0, '$data_publi', 0)";
    //$res_query = mysqli_query($conexao,$sql_respot_coment);
    $res_query = true;
    if($res_query) {
        $json = [
            'error' => false,
            'mensage' => 'Postagem compartilhada com sucesso!'
         ];
         echo json_encode($json);
         die;
    } else {
        //deleta a imagem que foi para o diretorio post
        $json = [
            'error' => true,
            'mensage' => 'Falha ao compartilhar o post. Tente novamente.'
         ];
         echo json_encode($json);
         die;
    }
} else {
    $json = [
        'error' => true,
        'mensage' => 'Algo deu errado! Parece que os dados não poderam ser enviados.'
     ];
     echo json_encode($json);
}