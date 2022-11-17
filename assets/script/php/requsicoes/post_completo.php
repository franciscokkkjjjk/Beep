<?php
session_start();
if (isset($_POST['All_xD30'])) {
    require_once '../conecta.php';
    require_once '../function/funcoes.php';

    $id_post = mysqli_escape_string($conexao, $_POST['All_xD30']);
    $sql_post = 'SELECT * FROM publicacoes WHERE id_publi=' . $id_post;
    $res_post = mysqli_query($conexao, $sql_post);
    $assoc_post = mysqli_fetch_assoc($res_post);

    //verfica se ela existe
    $postagem_completa["excluida"] = false;
    if (is_null($assoc_post)) {
        $postagem_completa = [
            "error" => true,
            "mensage" => "Essa publicação não existe."
        ];
        echo json_encode($postagem_completa);
        die;
    }
    //verifica se ela ta em quarentena.
    if ($assoc_post['quarentena'] > 0) {
        $json = [
            'error' => true,
            'mensage' => 'A postagem foi suspensa.'
        ];
        echo json_encode($json);
        die;
    }
    if (is_null($assoc_post)) {
        $json = [
            'error' => true,
            'mensage' => 'A postagem não existe.'
        ];
        echo json_encode($json);
        die;
    }

    //valida a classifcação indicativa
    if ($assoc_post['id_game'] != NULL) {
        $sql_game_ = "SELECT * FROM jogos WHERE jogos.id_jogos=" . $assoc_post['id_game'];
        $res_game_ = mysqli_query($conexao, $sql_game_);
        $ass_game_ = mysqli_fetch_assoc($res_game_);
        if ((!is_null($ass_game_)) or (!empty($ass_game_))) {
            if (!valid_class_ind($_SESSION['data_nas'], $ass_game_['class_etaria'])) {
                $json = [
                    'error' => true,
                    "mensage" => "Você não tem idade suficiente para visualizar este conteúdo."
                ];
                echo json_encode($json);
                die;
            }
        }
    }
    
    $sql_info_user_publi = 'SELECT * FROM users WHERE id_user=' . $assoc_post['user_publi'];
    $res_info_user_publi = mysqli_query($conexao, $sql_info_user_publi);
    $assoc_info_user_publi = mysqli_fetch_assoc($res_info_user_publi);

    $sql_curtidas = 'SELECT * FROM curtidas WHERE id_user_curti=' . $_SESSION['id_user'];
    $res_curtidas = mysqli_query($conexao, $sql_curtidas);
    $arra_curtida = mysqli_fetch_all($res_curtidas, 1);

    $user_curtiu = false;
    foreach ($arra_curtida as $value_c) {
        if ($value_c['id_postagem'] == $assoc_post['id_publi']) { //curtida da publicação aberta
            $user_curtiu = true;
        }
    }

    $sql_all_compartilhada = 'SELECT * FROM publicacoes WHERE user_publi=' . $_SESSION['id_user'] . ' AND type=4';
    $res_all_compartilhada = mysqli_query($conexao, $sql_all_compartilhada);
    $array_all_compartilhada = mysqli_fetch_all($res_all_compartilhada, 1);


    if ($assoc_post['type'] == '3') {
        $postagem_completa['error'] = false;
        $user_compartilhou = false;
        $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $assoc_post['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND publicacoes.type=4";
        $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
        $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
        if (!is_null($assoc_compartilhou)) {
            $user_compartilhou = true;
        }
        //verfica os jogos da publicação
        $assoc_game = valid_game($assoc_post['id_game'], $conexao);
        if ($assoc_game != false) {
            $nome_game_publi = $assoc_game['nome_jogo'];
            $id_game_publi = $assoc_game['id_jogos'];
        } else {
            $nome_game_publi = NULL;
            $id_game_publi = NULL;
        }

        $postagem_completa['publicacao'] = [
            'error' => false,
            'id_publi' => $assoc_post['id_publi'],
            'type' => $assoc_post['type'],
            'id_interacao' => $assoc_post['id_publi_interagida'],
            'text_post' => $assoc_post['text_publi'],
            'img_publi' => $assoc_post['img_publi'],
            'num_curtidas' => $assoc_post['num_curtidas'],
            'beepadas' => $assoc_post['num_compartilha'],
            'date_publi' => dateCalc($assoc_post),
            "date_publi_ca" => date('d/m/Y', strtotime($assoc_post['date_publi'])),
            "date_publi_hr" => date('H:i', strtotime($assoc_post['date_publi'])),
            'num_comentario' => $assoc_post['num_comentario'],
            'user_curtiu' => $user_curtiu,
            'user_compartilhou' => $user_compartilhou,
            'user_info' => [
                'user_id' => $assoc_post['user_publi'],
                'nome_user' => $assoc_info_user_publi['nome'],
                'username_user' => $assoc_info_user_publi['username'],
                'img_user' => perfilDefault($assoc_info_user_publi['foto_perfil'], ''),
            ],
            "game_publi" => [
                'game_id' => $id_game_publi,
                'game_nome' => $nome_game_publi
            ]
        ];
        $sql_comentarios = 'SELECT * FROM publicacoes WHERE id_publi_interagida=' . $assoc_post['id_publi'] . ' AND type=1 ORDER BY num_curtidas DESC';
        $res_comentarios = mysqli_query($conexao, $sql_comentarios);
        $array_comentarios = mysqli_fetch_all($res_comentarios, 1);

        foreach ($array_comentarios as $valueC) {
            $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $valueC['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND publicacoes.type=4 ";
            $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
            $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
            if (!is_null($assoc_compartilhou)) {
                $user_compartilhou_comet = true;
            } else {
                $user_compartilhou_comet = false;
            }
            $sql_curtiu = 'SELECT * FROM curtidas WHERE curtidas.id_postagem =' . $valueC['id_publi'] . ' AND curtidas.id_user_curti=' . $_SESSION['id_user'];
            $res_curtiu = mysqli_query($conexao, $sql_curtiu);
            $assoc_curtiu = mysqli_fetch_assoc($res_curtiu);
            if (is_null($assoc_curtiu)) {
                $user_cur = false;
            } else {
                $user_cur = true;
            }
            $sql_quem_comentou = 'SELECT * FROM users WHERE id_user=' . $valueC['user_publi'];
            $res_quem_comentou = mysqli_query($conexao, $sql_quem_comentou);
            $assoc_quem_comentou = mysqli_fetch_assoc($res_quem_comentou);
            $postagem_completa['comentarios'][] = [
                'error' => false,
                'id_publi' => $valueC['id_publi'],
                'type' => $valueC['type'],
                'id_interacao' => $valueC['id_publi_interagida'],
                'text_post' => $valueC['text_publi'],
                'img_publi' => $valueC['img_publi'],
                'num_curtidas' => $valueC['num_curtidas'],
                'beepadas' => $valueC['num_compartilha'],
                'date_publi' => dateCalc($valueC),
                'num_comentario' => $valueC['num_comentario'],
                'user_curtiu' => $user_cur,
                'user_compartilhou' => $user_compartilhou_comet,
                'user_info' => [
                    'user_id' => $valueC['user_publi'],
                    'nome_user' => $assoc_quem_comentou['nome'],
                    'username_user' => $assoc_quem_comentou['username'],
                    'img_user' => perfilDefault($assoc_quem_comentou['foto_perfil'], ''),
                ]
            ];
        }
        echo json_encode($postagem_completa);
    } elseif ($assoc_post['type'] == '2' or $assoc_post['type'] == '1') {
        $user_compartilhou = false;
        $postagem_completa['error'] = false;
        $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $assoc_post['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND publicacoes.type=4";
        $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
        $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);

        if (!is_null($assoc_compartilhou)) {
            $user_compartilhou = true;
        }

        //-------------------verfica os jogos da publicação
        $assoc_game = valid_game($assoc_post['id_game'], $conexao);
        if ($assoc_game != false) {
            $nome_game_publi = $assoc_game['nome_jogo'];
            $id_game_publi = $assoc_game['id_jogos'];
        } else {
            $nome_game_publi = NULL;
            $id_game_publi = NULL;
        }

        $postagem_completa['publicacao'] = [
            'id_publi' => $assoc_post['id_publi'],
            'type' => $assoc_post['type'],
            'id_interacao' => $assoc_post['id_publi_interagida'],
            'text_post' => $assoc_post['text_publi'],
            'img_publi' => $assoc_post['img_publi'],
            'num_curtidas' => $assoc_post['num_curtidas'],
            'beepadas' => $assoc_post['num_compartilha'],
            'date_publi' => dateCalc($assoc_post),
            "date_publi_ca" => date('d/m/Y', strtotime($assoc_post['date_publi'])),
            "date_publi_hr" => date('H:i', strtotime($assoc_post['date_publi'])),
            'num_comentario' => $assoc_post['num_comentario'],
            'user_curtiu' => $user_curtiu,
            'user_compartilhou' => $user_compartilhou,
            'user_info' => [
                'user_id' => $assoc_post['user_publi'],
                'nome_user' => $assoc_info_user_publi['nome'],
                'username_user' => $assoc_info_user_publi['username'],
                'img_user' => perfilDefault($assoc_info_user_publi['foto_perfil'], ''),
            ],
            "game_publi" => [
                'game_id' => $id_game_publi,
                'game_nome' => $nome_game_publi
            ]
        ];
        $sql_comentarios = 'SELECT * FROM publicacoes WHERE id_publi_interagida=' . $assoc_post['id_publi'] . ' AND type=1 ORDER BY num_curtidas DESC';
        $res_comentarios = mysqli_query($conexao, $sql_comentarios);
        $array_comentarios = mysqli_fetch_all($res_comentarios, 1);

        foreach ($array_comentarios as $valueC) {
            $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $valueC['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND publicacoes.type=4";
            $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
            $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
            //verfica se o comentario foi suspenso se for ele passa para a proxima repetição
            if ($valueC['quarentena'] == 1) {
                continue;
            }
            if (!is_null($assoc_compartilhou)) {
                $user_compartilhou_comet = true;
            } else {
                $user_compartilhou_comet = false;
            }
            $sql_curtiu = 'SELECT * FROM curtidas WHERE curtidas.id_postagem =' . $valueC['id_publi'] . ' AND curtidas.id_user_curti=' . $_SESSION['id_user'];
            $res_curtiu = mysqli_query($conexao, $sql_curtiu);
            $assoc_curtiu = mysqli_fetch_assoc($res_curtiu);
            if (is_null($assoc_curtiu)) {
                $user_cur = false;
            } else {
                $user_cur = true;
            }
            $sql_quem_comentou = 'SELECT * FROM users WHERE id_user=' . $valueC['user_publi'];
            $res_quem_comentou = mysqli_query($conexao, $sql_quem_comentou);
            $assoc_quem_comentou = mysqli_fetch_assoc($res_quem_comentou);
            $postagem_completa['comentarios'][] = [
                'error' => false,
                'id_publi' => $valueC['id_publi'],
                'type' => $valueC['type'],
                'id_interacao' => $valueC['id_publi_interagida'],
                'text_post' => $valueC['text_publi'],
                'img_publi' => $valueC['img_publi'],
                'num_curtidas' => $valueC['num_curtidas'],
                'beepadas' => $valueC['num_compartilha'],
                'date_publi' => dateCalc($valueC),
                'num_comentario' => $valueC['num_comentario'],
                'user_curtiu' => $user_cur,
                'user_compartilhou' => $user_compartilhou_comet,
                'user_info' => [
                    'user_id' => $valueC['user_publi'],
                    'nome_user' => $assoc_quem_comentou['nome'],
                    'username_user' => $assoc_quem_comentou['username'],
                    'img_user' => perfilDefault($assoc_quem_comentou['foto_perfil'], ''),
                ]
            ];
        }
        $sql_C_comentada = 'SELECT * FROM publicacoes WHERE id_publi=' . $assoc_post['id_publi_interagida'];
        $res_C_comentada = mysqli_query($conexao, $sql_C_comentada);
        $ass_C_comentada = mysqli_fetch_assoc($res_C_comentada);
        $postagem_completa['error'] = false;

        //------------------verifica se a publicação foi excluida-----------------
        if (is_null($ass_C_comentada)) {
            $postagem_completa['publicacao']['c_comentada'] = [
                'id_publi' => NULL
            ];
        } else {
            $sql_us_C_comentada = 'SELECT * FROM users WHERE id_user=' . $ass_C_comentada['user_publi'];
            $res_us_C_comentada = mysqli_query($conexao, $sql_us_C_comentada);
            $ass_us_C_comentada = mysqli_fetch_assoc($res_us_C_comentada);



            $postagem_completa['publicacao']['c_comentada'] = [
                'error' => false,
                'id_publi' => $ass_C_comentada['id_publi'],
                'type' => $ass_C_comentada['type'],
                'quarentena' => $ass_C_comentada['quarentena'],
                'id_interacao' => $ass_C_comentada['id_publi_interagida'],
                'text_post' => $ass_C_comentada['text_publi'],
                'img_publi' => $ass_C_comentada['img_publi'],
                'date_publi' => dateCalc($ass_C_comentada),
                'user_info' => [
                    'user_id' => $ass_C_comentada['user_publi'],
                    'nome_user' => $ass_us_C_comentada['nome'],
                    'username_user' => $ass_us_C_comentada['username'],
                    'img_user' => perfilDefault($ass_us_C_comentada['foto_perfil'], ''),
                ]
            ];
        }
        echo json_encode($postagem_completa);
    } elseif ($assoc_post['type'] == 4) {

        $postagem_completa['error'] = false;
        $user_compartilhou = false;
        $sql_raiz_publi = "SELECT * FROM publicacoes WHERE publicacoes.id_publi=" . $assoc_post['id_publi_interagida'];
        $res_raiz_publi = mysqli_query($conexao, $sql_raiz_publi);
        $assc_raiz_publi = mysqli_fetch_assoc($res_raiz_publi);
        if (is_null($assc_raiz_publi)) {
            $json = [
                "error" => true,
                "mensage" => "Essa publicação não está mais disponível."
            ];
            echo json_encode($json);
            die;
        }
        if ($assc_raiz_publi["quarentena"] == 1) {
            $json = [
                'error' => true,
                "mensage" => "Essa publicação foi suspensa."
            ];
            echo json_encode($json);

            die;
        }

        $sql_user_raiz_publi = "SELECT * FROM users WHERE users.id_user=" . $assc_raiz_publi['user_publi'];
        $res_user_raiz_publi = mysqli_query($conexao, $sql_user_raiz_publi);
        $assoc_user_raiz_publi = mysqli_fetch_assoc($res_user_raiz_publi);

        $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $assc_raiz_publi['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND publicacoes.type=4 ";
        $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
        $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
        if (!is_null($assoc_compartilhou)) {
            $user_compartilhou = true;
        }
        $user_curtiu = false;
        foreach ($arra_curtida as $value_c) {
            if ($value_c['id_postagem'] == $assc_raiz_publi['id_publi']) { //curtida da publicação aberta
                $user_curtiu = true;
            }
        }
        //-------------------verfica os jogos da publicação------------
        $assoc_game = valid_game($assc_raiz_publi['id_game'], $conexao);
        if ($assoc_game != false) {
            $nome_game_publi = $assoc_game['nome_jogo'];
            $id_game_publi = $assoc_game['id_jogos'];
        } else {
            $nome_game_publi = NULL;
            $id_game_publi = NULL;
        }

        $postagem_completa['publicacao'] = [
            'id_publi' => $assc_raiz_publi['id_publi'],
            'type' => $assc_raiz_publi['type'],
            'id_interacao' => $assc_raiz_publi['id_publi_interagida'],
            'text_post' => $assc_raiz_publi['text_publi'],
            'img_publi' => $assc_raiz_publi['img_publi'],
            'num_curtidas' => $assc_raiz_publi['num_curtidas'],
            'beepadas' => $assc_raiz_publi['num_compartilha'],
            'date_publi' => dateCalc($assc_raiz_publi),
            "quarentena" => $assc_raiz_publi['quarentena'],
            "date_publi_ca" => date('d/m/Y', strtotime($assc_raiz_publi['date_publi'])),
            "date_publi_hr" => date('H:i', strtotime($assc_raiz_publi['date_publi'])),
            'num_comentario' => $assc_raiz_publi['num_comentario'],
            'user_curtiu' => $user_curtiu,
            'user_compartilhou' => $user_compartilhou,
            'user_info' => [
                'user_id' => $assc_raiz_publi['user_publi'],
                'nome_user' => $assoc_user_raiz_publi['nome'],
                'username_user' => $assoc_user_raiz_publi['username'],
                'img_user' => perfilDefault($assoc_user_raiz_publi['foto_perfil'], ''),
            ],
            "game_publi" => [
                'game_id' => $id_game_publi,
                'game_nome' => $nome_game_publi
            ]
        ];
        $sql_comentarios = 'SELECT * FROM publicacoes WHERE id_publi_interagida=' . $assc_raiz_publi['id_publi'] . ' AND type=1 ORDER BY num_curtidas DESC';
        $res_comentarios = mysqli_query($conexao, $sql_comentarios);
        $array_comentarios = mysqli_fetch_all($res_comentarios, 1);

        foreach ($array_comentarios as $valueC) {
            $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=" . $valueC['id_publi'] . " AND publicacoes.user_publi=" . $_SESSION['id_user'] . " AND publicacoes.type=4 ";
            $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
            $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
            if (!is_null($assoc_compartilhou)) {
                $user_compartilhou_comet = true;
            } else {
                $user_compartilhou_comet = false;
            }
            $sql_curtiu = 'SELECT * FROM curtidas WHERE curtidas.id_postagem =' . $valueC['id_publi'] . ' AND curtidas.id_user_curti=' . $_SESSION['id_user'];
            $res_curtiu = mysqli_query($conexao, $sql_curtiu);
            $assoc_curtiu = mysqli_fetch_assoc($res_curtiu);
            if (is_null($assoc_curtiu)) {
                $user_cur = false;
            } else {
                $user_cur = true;
            }
            $sql_quem_comentou = 'SELECT * FROM users WHERE id_user=' . $valueC['user_publi'];
            $res_quem_comentou = mysqli_query($conexao, $sql_quem_comentou);
            $assoc_quem_comentou = mysqli_fetch_assoc($res_quem_comentou);
            $postagem_completa['comentarios'][] = [
                'id_publi' => $valueC['id_publi'],
                'type' => $valueC['type'],
                'id_interacao' => $valueC['id_publi_interagida'],
                'text_post' => $valueC['text_publi'],
                'img_publi' => $valueC['img_publi'],
                'num_curtidas' => $valueC['num_curtidas'],
                'beepadas' => $valueC['num_compartilha'],
                'date_publi' => dateCalc($valueC),
                'num_comentario' => $valueC['num_comentario'],
                'user_curtiu' => $user_cur,
                'user_compartilhou' => $user_compartilhou_comet,
                'user_info' => [
                    'user_id' => $valueC['user_publi'],
                    'nome_user' => $assoc_quem_comentou['nome'],
                    'username_user' => $assoc_quem_comentou['username'],
                    'img_user' => perfilDefault($assoc_quem_comentou['foto_perfil'], ''),
                ]
            ];
        }
        echo json_encode($postagem_completa);
    }
} else {
    header('../../../../paginas/inicial.php');
}
