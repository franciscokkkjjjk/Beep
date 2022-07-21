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
        if($post_segui['type'] == 2) {
            $user_compartilhou = false;
            $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=".$post_segui['id_publi']." AND publicacoes.user_publi=".$_SESSION['id_user']." AND (publicacoes.type=4 OR publicacoes.type=2)";
            $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
            $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
                if(!is_null($assoc_compartilhou)) {
                    $user_compartilhou = true;
                }
            foreach($arra_curtida as $value_c) {
                if($value_c['id_postagem'] == $post_segui['id_publi']) {
                    $user_curtiu = true;  
                } 
            }

            $sql_compartilhad = 'SELECT * FROM publicacoes WHERE id_publi='.$post_segui['id_publi_interagida'];
            $res_compartilhada = mysqli_query($conexao, $sql_compartilhad);
            $array_compartilhada = mysqli_fetch_assoc($res_compartilhada);

            $sql_s_perfil = 'SELECT * FROM users WHERE id_user='.$array_compartilhada['user_publi'];
            $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
            $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

            $sql_s_compartilhador = 'SELECT * FROM users WHERE id_user='.$post_segui['user_publi'];
            $res_s_compartilhador = mysqli_query($conexao, $sql_s_compartilhador);
            $array_s_compartilhador = mysqli_fetch_assoc($res_s_compartilhador);

            $timeline[] = [
                'id_publi' => $array_compartilhada['id_publi'],
                'type' => $post_segui['type'],
                'text_post' => $array_compartilhada['text_publi'],
                'img_publi' => $array_compartilhada['img_publi'],
                'num_curtidas' => $post_segui['num_curtidas'],
                'beepadas' => $post_segui['num_compartilha'],
                'date_publi' => dateCalc($array_compartilhada),
                'num_comentario' => $post_segui['num_comentario'],
                'user_curtiu' => $user_curtiu,
                'user_compartilhou'=> $user_compartilhou,
                'user_info' => [
                    'user_id' => $array_compartilhada['user_publi'],
                    'nome_user' => $array_s_perfil['nome'],
                    'username_user' => $array_s_perfil['username'],
                    'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
                ],
                'compartilhador_info' => [
                    'id_da_compartilhada' => $post_segui['id_publi'],
                    'id_interacao' => $post_segui['id_publi_interagida'],
                    'text_compartilhada' => $post_segui['text_publi'],
                    'img_compartilhada' => $post_segui['img_publi'],
                    'date_publi_compartilhada' => dateCalc($post_segui),
                    'user_id' => $post_segui['user_publi'],
                    'nome_user' => $array_s_compartilhador['nome'],
                    'username_user' => $array_s_compartilhador['username'],
                    'img_user' => perfilDefault($array_s_compartilhador['foto_perfil'], ''),
                ]
            ];
            } elseif ($post_segui['type'] == 3) {
            $user_compartilhou = false;
            $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=".$post_segui['id_publi']." AND publicacoes.user_publi=".$_SESSION['id_user']." AND (publicacoes.type=4 OR publicacoes.type=2)";
            $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
            $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
                if(!is_null($assoc_compartilhou)) {
                    $user_compartilhou = true;
                }

            $sql_s_perfil = 'SELECT * FROM users WHERE id_user='.$post_segui['user_publi'];
            $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
            $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

            foreach($arra_curtida as $value_c) {
                if($value_c['id_postagem'] == $post_segui['id_publi']) {
                    $user_curtiu = true;  
                } 
            }
            $timeline[] = [
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
                'user_compartilhou'=> $user_compartilhou,
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
    } elseif ($post_segui['type'] == 4) {

            $sql_compartilhad = 'SELECT * FROM publicacoes WHERE id_publi='.$post_segui['id_publi_interagida'];
            $res_compartilhada = mysqli_query($conexao, $sql_compartilhad);
            $array_compartilhada = mysqli_fetch_assoc($res_compartilhada);       
            
            foreach($arra_curtida as $value_c) {
                if($value_c['id_postagem'] == $post_segui['id_publi_interagida']) {
                    $user_curtiu = true;  
                } 
            }

            $sql_s_perfil = 'SELECT * FROM users WHERE id_user='.$array_compartilhada['user_publi'];
            $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
            $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

            $sql_s_compartilhador = 'SELECT * FROM users WHERE id_user='.$post_segui['user_publi'];
            $res_s_compartilhador = mysqli_query($conexao, $sql_s_compartilhador);
            $array_s_compartilhador = mysqli_fetch_assoc($res_s_compartilhador);
            if($post_segui['user_publi'] == $_SESSION['id_user']){
                $user_compartilhou = true;
            } else {
                $user_compartilhou = false;
            }
                
            $timeline[] = [
                'id_publi' => $array_compartilhada['id_publi'],
                'type' => $post_segui['type'],
                'text_post' => $array_compartilhada['text_publi'],
                'img_publi' => $array_compartilhada['img_publi'],
                'num_curtidas' => $array_compartilhada['num_curtidas'],
                'beepadas' => $array_compartilhada['num_compartilha'],
                'date_publi' => dateCalc($array_compartilhada),
                'num_comentario' => $array_compartilhada['num_comentario'],
                'user_curtiu' => $user_curtiu,
                'user_compartilhou'=> $user_compartilhou,
                'user_info' => [
                    'user_id' => $array_compartilhada['user_publi'],
                    'nome_user' => $array_s_perfil['nome'],
                    'username_user' => $array_s_perfil['username'],
                    'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
                ],
                'compartilhador_info' => [
                    'id_da_compartilhada' => $post_segui['id_publi'],
                    'id_interacao' => $post_segui['id_publi_interagida'],
                    'date_publi_compartilhada' => dateCalc($post_segui),
                    'user_id' => $post_segui['user_publi'],
                    'nome_user' => $array_s_compartilhador['nome'],
                    'username_user' => $array_s_compartilhador['username'],
                    'img_user' => perfilDefault($array_s_compartilhador['foto_perfil'], ''),
                ]
            ];
    }
    $posi++;
    }

    echo json_encode($timeline);
?>