<?php
session_start();
require_once '../conect_pdo.php';
require_once '../function/funcoes.php';
date_default_timezone_set('America/Sao_Paulo');
date_default_timezone_get();
if (isset($_POST['x_SALVAD30'])) {
    $id_publi = $pdo->real_escape_string($_POST['x_SALVAD30']);
    $verify = $pdo->query("SELECT * FROM publicacoes WHERE id_publi=" . $id_publi)->fetch_assoc();
    if (is_null($verify) or empty($verify)) {
        $json = [
            'mensage' => 'A publicação não existe.',
            'error' => true
        ];
        echo json_encode($json);
        die;
    }
    $verify02 = $pdo->query("SELECT * FROM publicacao_salva WHERE id_publi=" . $id_publi . " AND id_user=" . $_SESSION['id_user'])->fetch_assoc();
    if (!is_null($verify02) or !empty($verify02)) {
        $json = [
            'mensage' => 'A publicação já foi salva.',
            'error' => true
        ];
        echo json_encode($json);
        die;
    }
    $hoje = date("Y-m-d H:i:s");
    $salvar_sql = $pdo->query("INSERT INTO publicacao_salva(id_user, id_publi, data_salva) VALUES (" . $_SESSION['id_user'] . ", $id_publi, '$hoje')");
    if ($salvar_sql) {
        $json = [
            'mensage' => 'Sua publicação foi salva com sucesso.',
            'error' => false
        ];
    } else {
        $json = [
            'mensage' => 'Sua publicação não foi salva com sucesso.',
            'error' => true
        ];
    }
    echo json_encode($json);
}
if (isset($_POST['verify_salva'])) {
    $id_publi = $pdo->real_escape_string($_POST['verify_salva']);
    $verify02 = $pdo->query("SELECT * FROM publicacao_salva WHERE id_publi=" . $id_publi . " AND id_user=" . $_SESSION['id_user'])->fetch_assoc();
    if (!is_null($verify02) or !empty($verify02)) {
        $json = true;
        echo json_encode($json);
        die;
    } else {
        $json = false;
        echo json_encode($json);
        die;
    }
}
if (isset($_POST['x_REMOVED30'])) {
    $id_publi = $pdo->real_escape_string($_POST['x_REMOVED30']);
    $verify = $pdo->query("SELECT * FROM publicacoes WHERE id_publi=" . $id_publi)->fetch_assoc();
    if (is_null($verify) or empty($verify)) {
        $json = [
            'mensage' => 'A publicação não existe.',
            'error' => true
        ];
        echo json_encode($json);
        die;
    }
    $salvar_sql = $pdo->query("DELETE FROM publicacao_salva WHERE id_publi=" . $id_publi . " AND id_user=" . $_SESSION['id_user']);
    if ($salvar_sql) {
        $json = [
            'mensage' => 'Sua publicação foi retirada das publicações salvas com sucesso.',
            'error' => false
        ];
    } else {
        $json = [
            'mensage' => 'Sua publicação não foi retirada das publicações salvas com sucesso.',
            'error' => true
        ];
    }
    echo json_encode($json);
}

if (isset($_POST['x_POSTD30'])) {
    require_once '../conecta.php';
    //pega as publicação do usuário
    $sql_posts = "SELECT * FROM publicacoes WHERE publicacoes.id_publi IN (SELECT id_publi FROM publicacao_salva WHERE id_user = ".$_SESSION['id_user']." ORDER BY data_salva DESC) AND publicacoes.quarentena = 0";
    $res_posts = mysqli_query($conexao, $sql_posts);
    $postagens = mysqli_fetch_all($res_posts, 1);
    $id_game_publi;
    $nome_game_publi;

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

            //verfica o jogo da publicação
            if (!(is_null($array_compartilhada)) or !(empty($array_compartilhada))) {
                $assoc_game = valid_game($array_compartilhada['id_game'], $conexao);
            } else {
                $assoc_game = false;
            }
            if ($assoc_game != false) {
                $nome_game_publi = $assoc_game['nome_jogo'];
                $id_game_publi = $assoc_game['id_jogos'];
                //valida a classifcação indicativa
                if (!valid_class_ind($_SESSION['data_nas'], $assoc_game['class_etaria'])) {
                    continue;
                }
            } else {
                $nome_game_publi = NULL;
                $id_game_publi = NULL;
            }

            if (!is_null($array_compartilhada) or !empty($array_compartilhada)) {
                $sql_s_perfil = 'SELECT * FROM users WHERE id_user=' . $array_compartilhada['user_publi'];
                $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
                $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

                $id_publi_compartilhada = $array_compartilhada['id_publi'];
                $text_publi_compartilhada = $array_compartilhada['text_publi'];
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
                $user_compartilhada = NULL;
                $nome_user_compartilhada = NULL;
                $username_compartilhada = NULL;
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
                'quarentena' => $quarentena_compartilhada,
                //quarentena da publicação raiz
                'user_curtiu' => $user_curtiu,
                'user_compartilhou' => $user_compartilhou,
                'user_info' => [
                    'user_id' => $user_compartilhada,
                    'nome_user' => $nome_user_compartilhada,
                    'username_user' => $username_compartilhada,
                    'img_user' => perfilDefault($mida_user_compartilhada, ''),
                ],
                'compartilhador_info' => [
                    'quarentena' => $post_segui['quarentena'],
                    //quarentena a publicação que interage
                    'id_da_compartilhada' => $post_segui['id_publi'],
                    'id_interacao' => $post_segui['id_publi_interagida'],
                    'text_compartilhada' => $post_segui['text_publi'],
                    'img_compartilhada' => $post_segui['img_publi'],
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
        } elseif ($post_segui['type'] == 3) {
            $user_compartilhou = false;
            $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $post_segui['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND publicacoes.type=4";
            $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
            $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
            if (!is_null($assoc_compartilhou)) {
                $user_compartilhou = true;
            }

            //pega o usuário que fez a publicação
            $sql_s_perfil = 'SELECT * FROM users WHERE id_user=' . $post_segui['user_publi'];
            $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
            $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);


            //pega informações do jogo do usuário
            $sql_game_post = "SELECT * FROM jogos WHERE jogos.id_jogos ='" . $post_segui['id_game'] . "'";
            $res_game_post = mysqli_query($conexao, $sql_game_post);
            $ass_game_post = mysqli_fetch_assoc($res_game_post);


            if (is_null($ass_game_post) or empty($ass_game_post)) {
                $id_game_publi = null;
                $nome_game_publi = null;
                //a classifcação indicativa só serve para jogos, publicações sem jogos não são verificadas
            } else {
                $id_game_publi = $ass_game_post['id_jogos'];
                $nome_game_publi = $ass_game_post['nome_jogo'];
                //valida a classifcação indicativa
                if (!valid_class_ind($_SESSION['data_nas'], $ass_game_post['class_etaria'])) {
                    continue;
                }
            }
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
            //verifica se o post compartilhado existe caso não exista ele pula para proxima repetição
            if (is_null($array_compartilhada)) {
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

            //verfica o jogo da publicação raiz //as subpublicações serão sempre do jogo raiz (preguiça do dev kkkk)
            $assoc_game = valid_game($array_compartilhada['id_game'], $conexao);
            if ($assoc_game != false) {
                $nome_game_publi = $assoc_game['nome_jogo'];
                $id_game_publi = $assoc_game['id_jogos'];

                //valida a classifcação indicativa
                if (!valid_class_ind($_SESSION['data_nas'], $assoc_game['class_etaria'])) {
                    continue;
                }
            } else {
                $nome_game_publi = NULL;
                $id_game_publi = NULL;
            }
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
                ],
                "game_publi" => [
                    'game_id' => $id_game_publi,
                    'game_nome' => $nome_game_publi
                ]
            ];
        } elseif($post_segui['type'] == 1) {
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
            $array_compartilhada = $post_segui;

            //verfica o jogo da publicação
            if (!(is_null($array_compartilhada)) or !(empty($array_compartilhada))) {
                $assoc_game = valid_game($array_compartilhada['id_game'], $conexao);
            } else {
                $assoc_game = false;
            }
            if ($assoc_game != false) {
                $nome_game_publi = $assoc_game['nome_jogo'];
                $id_game_publi = $assoc_game['id_jogos'];
                //valida a classifcação indicativa
                if (!valid_class_ind($_SESSION['data_nas'], $assoc_game['class_etaria'])) {
                    continue;
                }
            } else {
                $nome_game_publi = NULL;
                $id_game_publi = NULL;
            }

            if (!is_null($array_compartilhada) or !empty($array_compartilhada)) {
                $sql_s_perfil = 'SELECT * FROM users WHERE id_user=' . $array_compartilhada['user_publi'];
                $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
                $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);

                $id_publi_compartilhada = $array_compartilhada['id_publi'];
                $text_publi_compartilhada = $array_compartilhada['text_publi'];
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
                $user_compartilhada = NULL;
                $nome_user_compartilhada = NULL;
                $username_compartilhada = NULL;
                $mida_user_compartilhada = NULL;
            }
            $sql_s_compartilhador = 'SELECT * FROM users WHERE id_user=' . $post_segui['user_publi'];
            $res_s_compartilhador = mysqli_query($conexao, $sql_s_compartilhador);
            $array_s_compartilhador = mysqli_fetch_assoc($res_s_compartilhador);

            $timeline[$posi] = [
                'id_publi' => $id_publi_compartilhada,
                'type' => 4,
                'text_post' => $text_publi_compartilhada,
                'img_publi' => $midia_compartilhada,
                'num_curtidas' => $post_segui['num_curtidas'],
                'beepadas' => $post_segui['num_compartilha'],
                'date_publi' => dateCalc($array_compartilhada),
                'num_comentario' => $post_segui['num_comentario'],
                'quarentena' => $quarentena_compartilhada,
                //quarentena da publicação raiz
                'user_curtiu' => $user_curtiu,
                'user_compartilhou' => $user_compartilhou,
                'user_info' => [
                    'user_id' => $user_compartilhada,
                    'nome_user' => $nome_user_compartilhada,
                    'username_user' => $username_compartilhada,
                    'img_user' => perfilDefault($mida_user_compartilhada, ''),
                ],
                'compartilhador_info' => [
                    'quarentena' => $post_segui['quarentena'],
                    //quarentena a publicação que interage
                    'id_da_compartilhada' => $post_segui['id_publi'],
                    'id_interacao' => $post_segui['id_publi_interagida'],
                    'text_compartilhada' => $post_segui['text_publi'],
                    'img_compartilhada' => $post_segui['img_publi'],
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
    if (empty($timeline)) {
        $timeline = [
            'nada' => 'nada por aqui'
        ];
    }

    echo json_encode($timeline);
}