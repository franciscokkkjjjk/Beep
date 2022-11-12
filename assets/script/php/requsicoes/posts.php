<?php
session_start();
require_once '../conecta.php';
require_once '../function/funcoes.php';
//pega publicação do usuário
$sql_posts = "SELECT * FROM publicacoes WHERE publicacoes.user_publi IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin=" . $_SESSION['id_user'] . ") AND publicacoes.quarentena = 0 AND publicacoes.type <> 1 ORDER BY publicacoes.date_publi DESC";
$res_posts = mysqli_query($conexao, $sql_posts);
$postagens = mysqli_fetch_all($res_posts, 1);


$sql_curtidas = 'SELECT * FROM curtidas WHERE id_user_curti=' . $_SESSION['id_user'];
$res_curtidas = mysqli_query($conexao, $sql_curtidas);
$arra_curtida = mysqli_fetch_all($res_curtidas, 1);

$sql_all_compartilhada = 'SELECT * FROM publicacoes WHERE user_publi=' . $_SESSION['id_user'] . ' AND type=4';
$res_all_compartilhada = mysqli_query($conexao, $sql_all_compartilhada);
$array_all_compartilhada = mysqli_fetch_all($res_all_compartilhada, 1);
$posi = 0;
$pos_aux = 0;

foreach ($postagens as $post_segui) {
    $user_curtiu = false;
    $user_comp = false;
    if ($post_segui['type'] == 2) {
        $user_compartilhou = false;
        $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $post_segui['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND  publicacoes.type=4";
        $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
        $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
        if (!is_null($assoc_compartilhou)) {
            $user_compartilhou = true;
        }
        foreach ($arra_curtida as $value_c) {
            if ($value_c['id_postagem'] == $post_segui['id_publi']) {
                $user_curtiu = true;
            }
        }
        //pega publicação raiz
        $sql_compartilhad = 'SELECT * FROM publicacoes WHERE id_publi=' . $post_segui['id_publi_interagida'];
        $res_compartilhada = mysqli_query($conexao, $sql_compartilhad);
        $array_compartilhada = mysqli_fetch_assoc($res_compartilhada);
        if (!is_null($array_compartilhada)) {
            $sql_s_perfil = 'SELECT * FROM users WHERE id_user=' . $array_compartilhada['user_publi'];
            $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
            $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

            $id_publi_compartilhada = $array_compartilhada['id_publi'];
            $text_publi_compartilhada =  $array_compartilhada['text_publi'];
            $midia_compartilhada = $array_compartilhada['img_publi'];
            $quarentena_compartilhada = $array_compartilhada['quarentena'];
            $user_compartilhada = $array_compartilhada['user_publi'];
            $nome_user_compartilhada = $array_s_perfil['nome'];
            $username_compartilhada = $array_s_perfil['username'];
            $mida_user_compartilhada = $array_s_perfil['foto_perfil'];
        } else {
            $id_publi_compartilhada = NULL;
            $text_publi_compartilhada = NULL;
            $midia_compartilhada = NULL;
            $quarentena_compartilhada = 1; // falta verificar se o post 4 ta excluido ou não; o post completo tbm deve ser verificado
            $user_compartilhada =        NULL;
            $nome_user_compartilhada =  NULL;
            $username_compartilhada =   NULL;
            $mida_user_compartilhada = NULL;
        }
        $sql_s_compartilhador = 'SELECT * FROM users WHERE id_user=' . $post_segui['user_publi'];
        $res_s_compartilhador = mysqli_query($conexao, $sql_s_compartilhador);
        $array_s_compartilhador = mysqli_fetch_assoc($res_s_compartilhador);

        $timeline[$posi] = [
            'id_publi' => $id_publi_compartilhada,
            'type' => $post_segui['type'],
            'text_post' => $text_publi_compartilhada,
            'img_publi' => $midia_compartilhada,
            'num_curtidas' => $post_segui['num_curtidas'],
            'beepadas' => $post_segui['num_compartilha'],
            'date_publi' => dateCalc($array_compartilhada),
            'num_comentario' => $post_segui['num_comentario'],
            'quarentena' => $quarentena_compartilhada, //quarentena da publicação raiz
            'user_curtiu' => $user_curtiu,
            'user_compartilhou' => $user_compartilhou,
            'user_info' => [
                'user_id' => $user_compartilhada,
                'nome_user' => $nome_user_compartilhada,
                'username_user' => $username_compartilhada,
                'img_user' => perfilDefault($mida_user_compartilhada, ''),
            ],
            'compartilhador_info' => [
                'quarentena' => $post_segui['quarentena'], //quarentena a publicação que interage
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
        $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $post_segui['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND publicacoes.type=4";
        $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
        $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
        if (!is_null($assoc_compartilhou)) {
            $user_compartilhou = true;
        }

        $sql_s_perfil = 'SELECT * FROM users WHERE id_user=' . $post_segui['user_publi'];
        $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
        $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

        foreach ($arra_curtida as $value_c) {
            if ($value_c['id_postagem'] == $post_segui['id_publi']) {
                $user_curtiu = true;
            }
        }
        $timeline[$posi] = [
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
            'user_compartilhou' => $user_compartilhou,
            'user_info' => [
                'user_id' => $post_segui['user_publi'],
                'nome_user' => $array_s_perfil['nome'],
                'username_user' => $array_s_perfil['username'],
                'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
            ]
        ];
        $sql_user_curtiram = "SELECT * FROM curtidas WHERE curtidas.id_postagem=" . $post_segui['id_publi'];
        $res_user_curtiram = mysqli_query($conexao, $sql_user_curtiram);
        $array_users_curtiram = mysqli_fetch_all($res_user_curtiram, 1);
        foreach ($array_users_curtiram as $value_U_C) {
            $post[$posi]['users_curtiram'] = [
                'id_user' => $value_U_C['id_user_curti'],
                'hora_curtida' => $value_U_C['curtida_date']
            ];
        }
    } elseif ($post_segui['type'] == 4) {

        $sql_compartilhad = 'SELECT * FROM publicacoes WHERE id_publi=' . $post_segui['id_publi_interagida'];
        $res_compartilhada = mysqli_query($conexao, $sql_compartilhad);
        $array_compartilhada = mysqli_fetch_assoc($res_compartilhada);
        if(is_null($array_compartilhada)) {
            continue;
        }
        if ($array_compartilhada['quarentena'] > 0) { //pula pra proxima se o publicação compartilhada estiver em quarentena
            continue;
        }

        foreach ($arra_curtida as $value_c) {
            if ($value_c['id_postagem'] == $post_segui['id_publi_interagida']) {
                $user_curtiu = true;
            }
        }
        foreach ($array_all_compartilhada as $value_pu) {
            if ($value_pu['id_publi_interagida'] == $array_compartilhada['id_publi']) {
                $user_comp = true;
            }
        }


        $sql_s_perfil = 'SELECT * FROM users WHERE id_user=' . $array_compartilhada['user_publi'];
        $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
        $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

        $sql_s_compartilhador = 'SELECT * FROM users WHERE id_user=' . $post_segui['user_publi'];
        $res_s_compartilhador = mysqli_query($conexao, $sql_s_compartilhador);
        $array_s_compartilhador = mysqli_fetch_assoc($res_s_compartilhador);

        $timeline[$posi] = [
            'id_publi' => $array_compartilhada['id_publi'],
            'type' => $post_segui['type'],
            'text_post' => $array_compartilhada['text_publi'],
            'img_publi' => $array_compartilhada['img_publi'],
            'num_curtidas' => $array_compartilhada['num_curtidas'],
            'beepadas' => $array_compartilhada['num_compartilha'],
            'date_publi' => dateCalc($array_compartilhada),
            'num_comentario' => $array_compartilhada['num_comentario'],
            'user_curtiu' => $user_curtiu,
            'user_compartilhou' => $user_comp,
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
if (empty($timeline)) {
    $timeline = [
        'nada' => 'nada por aqui'
    ];
}

echo json_encode($timeline);
