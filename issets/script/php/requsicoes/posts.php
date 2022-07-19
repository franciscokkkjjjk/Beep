<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';


    $sql_posts = "SELECT * FROM publicacoes WHERE user_publi IN (SELECT user_seguido FROM seguidores WHERE user_seguin=".$_SESSION['id_user'].") ORDER BY date_publi DESC";
    $res_posts = mysqli_query($conexao,$sql_posts);
    $postagens = mysqli_fetch_all($res_posts,1);

    $sql_curtidas = 'SELECT * FROM curtidas WHERE id_user_curti='.$_SESSION['id_user'];
    $res_curtidas = mysqli_query($conexao, $sql_curtidas);
    $arra_curtida = mysqli_fetch_all($res_curtidas, 1);

    foreach($postagens as $post_segui) {
        $user_curtiu = false;
        $sql_s_perfil = 'SELECT * FROM users WHERE id_user='.$post_segui['user_publi'];
        $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
        $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);
        foreach($arra_curtida as $value_c) {
            if($value_c['id_postagem'] == $post_segui['id_publi']) {
                $user_curtiu = true;  
            } 
        }

    $post[] = [
        'user_id' => $post_segui['user_publi'],
        'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
        'username_user' => $array_s_perfil['username'],
        'nome_user' => $array_s_perfil['nome'],
        'id_publi' => $post_segui['id_publi'],
        'text_post' => $post_segui['text_publi'],
        'img_publi' => $post_segui['img_publi'],
        'num_curtidas' => $post_segui['num_curtidas'],
        'beepadas' => $post_segui['num_compartilha'],
        'date_publi' => dateCalc($post_segui),
        'num_comentario' => $post_segui['num_comentario'],
        'user_curtiu' => $user_curtiu,
        'users_curtiram' => array()
    ];
    $sql_user_curtiram = "SELECT curtidas.id_user_curti FROM curtidas WHERE curtidas.id_postagem=".$post_segui['id_publi'];
    $res_user_curtiram =mysqli_query($conexao, $sql_user_curtiram);
    $array_users_curtiram = mysqli_fetch_all($res_user_curtiram, 1);
    foreach($array_users_curtiram as $value_U_C){    
            $post['users_curtiram'] = [
                'id_user' => $value_U_C['id_user_curti']
            ];
        }
    }
    print_r($post);die;
    echo json_encode($post);
?>