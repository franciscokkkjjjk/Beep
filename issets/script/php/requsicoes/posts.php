<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';

    $sql_posts = "SELECT * FROM publicacoes WHERE publicacoes.user_publi IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin=8) AND publicacoes.type <> 1 ORDER BY publicacoes.date_publi DESC";
    $res_posts = mysqli_query($conexao,$sql_posts);
    $postagens = mysqli_fetch_all($res_posts,1);

    $sql_posts_curtidos = "SELECT * FROM publicacoes WHERE publicacoes.id_publi IN (SELECT curtidas.id_postagem FROM curtidas WHERE curtidas.id_user_curti IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin=".$_SESSION['id_user']."))";
    $res_posts_curtidos = mysqli_query($conexao, $sql_posts_curtidos);
    $array_posts_curtidos = mysqli_fetch_all($res_posts_curtidos,1);

    $sql_curtidas = 'SELECT * FROM curtidas WHERE id_user_curti='.$_SESSION['id_user'];
    $res_curtidas = mysqli_query($conexao, $sql_curtidas);
    $arra_curtida = mysqli_fetch_all($res_curtidas, 1);
    $posi = 0;
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
            'id_publi' => $post_segui['id_publi'],
            'type' => $post_segui['type'],
            'id_interacao' => $post_segui['id_publi_interagida'],
            'text_post' => $post_segui['text_publi'],
            'img_publi' => $post_segui['img_publi'],
            'num_curtidas' => $post_segui['num_curtidas'],
            'beepadas' => $post_segui['num_compartilha'],
            'date_publi' => dateCalc($post_segui),
            'num_comentario' => $post_segui['num_comentario'],
            'user_curtiu' => $user_curtiu,
            'user_info' => [
                'user_id' => $post_segui['user_publi'],
                'nome_user' => $array_s_perfil['nome'],
                'username_user' => $array_s_perfil['username'],
                'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
            ]
        ];
    $sql_user_curtiram = "SELECT * FROM curtidas WHERE curtidas.id_postagem=".$post_segui['id_publi'];
    $res_user_curtiram =mysqli_query($conexao, $sql_user_curtiram);
    $array_users_curtiram = mysqli_fetch_all($res_user_curtiram, 1);
    foreach($array_users_curtiram as $value_U_C){    
            $post[$posi]['users_curtiram'] = [
                'id_user' => $value_U_C['id_user_curti'],
                'hora_curtida' => $value_U_C['curtida_date']
            ];
        }
    $posi++;
    }

    echo json_encode($post);
?>