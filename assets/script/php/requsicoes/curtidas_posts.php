<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';
    if(isset($_GET['username'])) {
        $user_push = mysqli_escape_string($conexao, $_GET['username']);
    } else {
        $user_push = mysqli_escape_string($conexao, $_SESSION['username']);
    }
    $posi = 0;
    $sql_req = "SELECT * FROM users WHERE username='$user_push'";
    $res_requ = mysqli_query($conexao, $sql_req);
    $assoc_user_req = mysqli_fetch_assoc($res_requ);


    $sql_curtidas = 'SELECT * FROM curtidas WHERE id_user_curti='.$_SESSION['id_user'];
    $res_curtidas = mysqli_query($conexao, $sql_curtidas);
    $arra_curtida = mysqli_fetch_all($res_curtidas, 1);

    $sql_post_curtidos = "SELECT * FROM publicacoes WHERE publicacoes.id_publi IN (SELECT curtidas.id_postagem FROM curtidas WHERE curtidas.id_user_curti=".$assoc_user_req['id_user']." ORDER BY curtida_date DESC)";
    $res_push = mysqli_query($conexao, $sql_post_curtidos);
    $array_push = mysqli_fetch_all($res_push, 1);
    foreach($array_push as $post_segui) {
        $user_curtiu = false;
        $user_comp = false;
    
        if($post_segui['type'] == 2) {
            $user_compartilhou = false;
            $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=".$post_segui['id_publi']." AND publicacoes.user_publi=".$_SESSION['id_user']." AND (publicacoes.type=4 OR publicacoes.type=2)";
            $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
            $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
                if(!is_null($assoc_compartilhou)) {
                    $user_compartilhou = true;
                } 

            $sql_compartilhad = 'SELECT * FROM publicacoes WHERE id_publi='.$post_segui['id_publi_interagida'];
            $res_compartilhada = mysqli_query($conexao, $sql_compartilhad);
            $array_compartilhada = mysqli_fetch_assoc($res_compartilhada);

            $sql_s_perfil = 'SELECT * FROM users WHERE id_user='.$array_compartilhada['user_publi'];
            $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
            $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);
            
            foreach($arra_curtida as $value_c) {
                if($value_c['id_postagem'] == $post_segui['id_publi_interagida']) {
                    $user_curtiu = true;  
                } 
            }

            $sql_s_compartilhador = 'SELECT * FROM users WHERE id_user='.$post_segui['user_publi'];
            $res_s_compartilhador = mysqli_query($conexao, $sql_s_compartilhador);
            $array_s_compartilhador = mysqli_fetch_assoc($res_s_compartilhador);

            $post_curtidos[] = [
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

                foreach($arra_curtida as $value_c) {
                    if($value_c['id_postagem'] == $post_segui['id_publi_interagida']) {
                        $user_curtiu = true;  
                    } 
                }

            $sql_s_perfil = 'SELECT * FROM users WHERE id_user='.$post_segui['user_publi'];
            $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
            $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

            $post_curtidos[] = [
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

            foreach($array_all_compartilhada as $value_pu) {
                if($value_pu['id_publi_interagida'] == $array_compartilhada['id_publi']) {
                    $user_comp = true;
                }
            }

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
                
            $post_curtidos[] = [
                'id_publi' => $array_compartilhada['id_publi'],
                'type' => $post_segui['type'],
                'text_post' => $array_compartilhada['text_publi'],
                'img_publi' => $array_compartilhada['img_publi'],
                'num_curtidas' => $array_compartilhada['num_curtidas'],
                'beepadas' => $array_compartilhada['num_compartilha'],
                'date_publi' => dateCalc($array_compartilhada),
                'num_comentario' => $array_compartilhada['num_comentario'],
                'user_curtiu' => $user_curtiu,
                'user_compartilhou'=> $user_comp,
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
    if($array_push == null) {
        $post_curtidos = [
            'nada' => 'nada por aqui!'
        ];
    }
    if($res_push) {
        echo json_encode($post_curtidos);
    }
?>