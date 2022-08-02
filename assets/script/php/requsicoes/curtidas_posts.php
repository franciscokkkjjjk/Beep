<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';
    $user_push = $_GET['username'];
    
    $sql_req = "SELECT * FROM users WHERE username='$user_push'";
    $res_requ = mysqli_query($conexao, $sql_req);
    $assoc_user_req = mysqli_fetch_assoc($res_requ);

    $sql_post_curtidos = "SELECT * FROM publicacoes WHERE publicacoes.id_publi IN (SELECT curtidas.id_postagem FROM curtidas WHERE curtidas.id_user_curti=".$assoc_user_req['id_user']." ORDER BY curtida_date DESC)";
    $res_push = mysqli_query($conexao, $sql_post_curtidos);
    $array_push = mysqli_fetch_all($res_push, 1);
    
    $user_push = array();
    $i = 0;
    foreach($array_push as $valueP) {
        $i++;
        $sql_user_ ='SELECT * FROM users WHERE id_user='.$valueP['user_publi'];
        $res_user_ = mysqli_query($conexao, $sql_user_);
        $assoc_user_ = mysqli_fetch_assoc($res_user_);
        $post_curtidos[] = [
            'user_id' => $valueP['user_publi'],
            'img_user' => perfilDefault($assoc_user_['foto_perfil'], ''),
            'username_user' => $assoc_user_['username'],
            'nome_user' => $assoc_user_['nome'],
            'id_publi' => $valueP['id_publi'],
            'text_post' => $valueP['text_publi'],
            'img_publi' => $valueP['img_publi'],
            'num_curtidas' => $valueP['num_curtidas'],
            'beepadas' => $valueP['num_compartilha'],
            'date_publi' => dateCalc($valueP),
            'num_comentario' => $valueP['num_comentario'],
            'user_curtiu' => true
        ];
    }

    if($res_push) {
        echo json_encode($post_curtidos);
    }
?>