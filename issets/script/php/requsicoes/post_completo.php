<?php 
    session_start();
    if(isset($_POST['All_xD30'])) {
        require_once '../conecta.php';
        require_once '../function/funcoes.php';
        $id_post = $_POST['All_xD30'];
        $sql_post = 'SELECT * FROM publicacoes WHERE id_publi='.$id_post;
        $res_post = mysqli_query($conexao, $sql_post);
        $assoc_post = mysqli_fetch_assoc($res_post);

        $sql_info_user_publi = 'SELECT * FROM users WHERE id_user='.$assoc_post['user_publi'];
        $res_info_user_publi = mysqli_query($conexao, $sql_info_user_publi);
        $assoc_info_user_publi = mysqli_fetch_assoc($res_info_user_publi);

        $sql_curtidas = 'SELECT * FROM curtidas WHERE id_user_curti='.$_SESSION['id_user'];
        $res_curtidas = mysqli_query($conexao, $sql_curtidas);
        $arra_curtida = mysqli_fetch_all($res_curtidas, 1);

        $user_curtiu = false;  
        foreach($arra_curtida as $value_c) {
            if($value_c['id_postagem'] == $assoc_post['id_publi']) {//curtida da publicação aberta
                $user_curtiu = true;  
            } 
        }

        $sql_all_compartilhada = 'SELECT * FROM publicacoes WHERE user_publi='.$_SESSION['id_user'].' AND type=4';
        $res_all_compartilhada = mysqli_query($conexao, $sql_all_compartilhada);
        $array_all_compartilhada = mysqli_fetch_all($res_all_compartilhada, 1);


        if($assoc_post['type'] == '1') {
            $post_completo = [
                'erro' => true,
                'desc' => 'usuario tentou puxar um comentario'
            ];
            echo json_encode($post_completo);
        } elseif($assoc_post['type'] == '3') {
            $user_compartilhou = false;
            $sql_compartilhou = "SELECT * FROM publicacoes WHERE publicacoes.id_publi_interagida=".$assoc_post['id_publi']." AND publicacoes.user_publi=".$_SESSION['id_user']." AND (publicacoes.type=4 OR publicacoes.type=2)";
            $res_compartilhou = mysqli_query($conexao, $sql_compartilhou);
            $assoc_compartilhou = mysqli_fetch_assoc($res_compartilhou);
                if(!is_null($assoc_compartilhou)) {
                    $user_compartilhou = true;
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
                'user_compartilhou'=> $user_compartilhou,
                'user_info' => [
                    'user_id' => $assoc_post['user_publi'],
                    'nome_user' => $assoc_info_user_publi['nome'],
                    'username_user' => $assoc_info_user_publi['username'],
                    'img_user' => perfilDefault($assoc_info_user_publi['foto_perfil'], ''),
                ]
            ];
            $sql_comentarios = 'SELECT * FROM publicacoes WHERE id_publi_interagida='.$assoc_post['id_publi'].' AND type=1 ORDER BY num_curtidas DESC';
            $res_comentarios = mysqli_query($conexao, $sql_comentarios);
            $array_comentarios = mysqli_fetch_all($res_comentarios, 1);

            foreach($array_comentarios as $valueC) {
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
                    'user_curtiu' => $user_curtiu,
                    'user_compartilhou'=> $user_compartilhou,
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