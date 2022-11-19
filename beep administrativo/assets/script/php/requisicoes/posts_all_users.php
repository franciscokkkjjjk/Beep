<?php
session_start();
require_once '../conecta.php';
require_once '../../../../../assets/script/php/function/funcoes.php';
$perfil = mysqli_escape_string($conexao, mysqli_real_escape_string($conexao, $_GET['username']));
$perfil_visit = array();

$sql_s_perfil = "SELECT * FROM users WHERE username='$perfil'";
$res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
$array_s_perfil = mysqli_fetch_assoc($res_s_perfil);
if (is_null($array_s_perfil)) {
    $json =  [
        'error' => true,
    ];
    echo json_encode($json);
    die;
}
$sql_posts = "SELECT * FROM publicacoes WHERE user_publi=" . $array_s_perfil['id_user'] . " AND publicacoes.quarentena = 0 AND publicacoes.type <> 1 ORDER BY publicacoes.date_publi DESC";
$res_posts = mysqli_query($conexao, $sql_posts);
$postagens = mysqli_fetch_all($res_posts, 1);

$posi = 0;


foreach ($postagens as $post_segui) {
    $user_curtiu = false;
    $user_comp = false;

    if ($post_segui['type'] == 2) {
        //pega a publicação raiz
        $sql_compartilhad = 'SELECT * FROM publicacoes WHERE id_publi=' . $post_segui['id_publi_interagida'];
        $res_compartilhada = mysqli_query($conexao, $sql_compartilhad);
        $array_compartilhada = mysqli_fetch_assoc($res_compartilhada);

        $sql_s_compartilhador = 'SELECT * FROM users WHERE id_user=' . $post_segui['user_publi'];
        $res_s_compartilhador = mysqli_query($conexao, $sql_s_compartilhador);
        $array_s_compartilhador = mysqli_fetch_assoc($res_s_compartilhador);

        $user_compartilhada_nome =  $array_s_compartilhador['nome'];
        $usernameCompartilhada = $array_s_compartilhador['username'];
        $foto_compartilhada = $array_s_compartilhador['foto_perfil'];

        if (!is_null($array_compartilhada)) {
            $id_compartilhada = $array_compartilhada['id_publi'];
            $text_compartilhada = $array_compartilhada['text_publi'];
            $midia_compartilhada = $array_compartilhada['img_publi'];
            $quarentena_compartilhada = $array_compartilhada['quarentena'];
            //-------------------verfica os jogos da publicação------------
            $assoc_game = valid_game($array_compartilhada['id_game'], $conexao);
            if ($assoc_game != false) {
                $nome_game_publi = $assoc_game['nome_jogo'];
                $id_game_publi = $assoc_game['id_jogos'];
            } else {
                $nome_game_publi = NULL;
                $id_game_publi = NULL;
            }
        } else {

            $id_compartilhada = NULL;
            $text_compartilhada = NULL;
            $midia_compartilhada = NULL;
            $quarentena_compartilhada = NULL;
            $nome_game_publi = NULL;
            $id_game_publi = NULL;
        }


        $perfil_visit['publi'][] = [
            'id_publi' => $id_compartilhada,
            'type' => $post_segui['type'],
            'text_post' => $text_compartilhada,
            'img_publi' => $midia_compartilhada,
            'num_curtidas' => $post_segui['num_curtidas'],
            'beepadas' => $post_segui['num_compartilha'],
            'date_publi' => dateCalc($array_compartilhada),
            'num_comentario' => $post_segui['num_comentario'],
            'user_curtiu' => false,
            'quarentena' => $quarentena_compartilhada,
            'compartilhador_info' => [
                'quarentena' => $post_segui['quarentena'],
                'id_da_compartilhada' => $post_segui['id_publi'],
                'id_interacao' => $post_segui['id_publi_interagida'],
                'text_compartilhada' => $post_segui['text_publi'],
                'img_compartilhada' => $post_segui['img_publi'],
                'date_publi_compartilhada' => dateCalc($post_segui),
                'user_id' => $post_segui['user_publi'],
                'nome_user' => $user_compartilhada_nome,
                'username_user' => $usernameCompartilhada,
                'img_user' => perfilDefault($foto_compartilhada, ''),
            ],
            'user_info' => [
                'user_id' => $array_s_perfil['id_user'],
                'nome_user' => $array_s_perfil['nome'],
                'username_user' => $array_s_perfil['username'],
                'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
            ],
            "game_publi" => [
                'game_id' => $id_game_publi,
                'game_nome' => $nome_game_publi
            ]
        ];
    } elseif ($post_segui['type'] == 3) {

        //-------------------verfica os jogos da publicação------------
        $assoc_game = valid_game($post_segui['id_game'], $conexao);
        if ($assoc_game != false) {
            $nome_game_publi = $assoc_game['nome_jogo'];
            $id_game_publi = $assoc_game['id_jogos'];
        } else {
            $nome_game_publi = NULL;
            $id_game_publi = NULL;
        }

        $perfil_visit['publi'][] = [
            'id_publi' => $post_segui['id_publi'],
            'type' => $post_segui['type'],
            'id_interacao' => $post_segui['id_publi_interagida'],
            'text_post' => $post_segui['text_publi'],
            'img_publi' => $post_segui['img_publi'],
            'num_curtidas' => $post_segui['num_curtidas'],
            'beepadas' => $post_segui['num_compartilha'],
            'date_publi' => dateCalc($post_segui),
            'num_comentario' => $post_segui['num_comentario'],
            'user_curtiu' => false,
            'user_info' => [
                'user_id' => $array_s_perfil['id_user'],
                'nome_user' => $array_s_perfil['nome'],
                'username_user' => $array_s_perfil['username'],
                'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
            ],
            "game_publi" => [
                'game_id' => $id_game_publi,
                'game_nome' => $nome_game_publi
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
        if (is_null($array_compartilhada)) {
            continue;
        }
        if ($array_compartilhada['quarentena'] == 1) {
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
        $sql_info_raiz = 'SELECT * FROM users WHERE id_user=' . $array_compartilhada['user_publi'];
        $res__info_raiz = mysqli_query($conexao, $sql_info_raiz);
        $array__info_raiz = mysqli_fetch_assoc($res__info_raiz);

        $sql_s_compartilhador = 'SELECT * FROM users WHERE id_user=' . $post_segui['user_publi'];
        $res_s_compartilhador = mysqli_query($conexao, $sql_s_compartilhador);
        $array_s_compartilhador = mysqli_fetch_assoc($res_s_compartilhador);

        //-------------------verfica os jogos da publicação------------
        $assoc_game = valid_game($array_compartilhada['id_game'], $conexao);
        if ($assoc_game != false) {
            $nome_game_publi = $assoc_game['nome_jogo'];
            $id_game_publi = $assoc_game['id_jogos'];
        } else {
            $nome_game_publi = NULL;
            $id_game_publi = NULL;
        }

        $perfil_visit['publi'][] = [
            'id_publi' => $array_compartilhada['id_publi'],
            'type' => $post_segui['type'],
            'text_post' => $array_compartilhada['text_publi'],
            'img_publi' => $array_compartilhada['img_publi'],
            'num_curtidas' => $array_compartilhada['num_curtidas'],
            'beepadas' => $array_compartilhada['num_compartilha'],
            'date_publi' => dateCalc($array_compartilhada),
            'num_comentario' => $array_compartilhada['num_comentario'],
            'user_compartilhou' => $user_comp,
            'user_info' => [
                'user_id' => $array_compartilhada['user_publi'],
                'nome_user' => $array__info_raiz['nome'],
                'username_user' => $array__info_raiz['username'],
                'img_user' => perfilDefault($array__info_raiz['foto_perfil'], ''),
            ],
            'compartilhador_info' => [
                'id_da_compartilhada' => $post_segui['id_publi'],
                'id_interacao' => $post_segui['id_publi_interagida'],
                'date_publi_compartilhada' => dateCalc($post_segui),
                'user_id' => $post_segui['user_publi'],
                'nome_user' => $array_s_compartilhador['nome'],
                'username_user' => $array_s_compartilhador['username'],
                'img_user' => perfilDefault($array_s_compartilhador['foto_perfil'], ''),
            ],
            "game_publi" => [
                'game_id' => $id_game_publi,
                'game_nome' => $nome_game_publi
            ]
        ];
    }
    $posi++;
}
if ($perfil_visit == null or empty($perfil_visit)) {
    $perfil_visit['publi'] = [
        'nada' => 'nada por aqui'
    ];
}
$perfil_visit['user'] = [
    'user_id' => $array_s_perfil['id_user'],
    'nome_user' => $array_s_perfil['nome'],
    'username_user' => $array_s_perfil['username'],
    'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
    'bio' => $array_s_perfil['bio'],
    'data_nas' => date('d/m/Y', strtotime($array_s_perfil['data_nas'])),
    'banner_pefil' => $array_s_perfil['banner_pefil'],
    't_seguindo' => $array_s_perfil['t_seguindo'],
    't_seguidores' => $array_s_perfil['t_seguidores'],
    'seguindo' => false
];

echo json_encode($perfil_visit);
