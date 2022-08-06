<?php 
    session_start();
    require_once('../conecta.php');
    require_once('../function/funcoes.php');
        $post_id = $_POST['p-xD30'];
        $sql_info = 'SELECT * FROM publicacoes WHERE id_publi='.$post_id;
        $res_info = mysqli_query($conexao, $sql_info);
        $assoc_info = mysqli_fetch_assoc($res_info);
        if($assoc_info['type'] == '3' or $assoc_info['type'] == '2' or $assoc_info['type'] == '1'){
            if(!is_null($assoc_info)) {
                $user_info_comentada = 'SELECT * FROM users WHERE id_user='.$assoc_info['user_publi'];
                $res_user_info_cometada = mysqli_query($conexao, $user_info_comentada);
                $assoc_user = mysqli_fetch_assoc($res_user_info_cometada);
                if(!is_null($assoc_user)) {
                    $info_comentada = [
                        'id_publi' => $assoc_info['id_publi'],
                        'type' => $assoc_info['type'],
                        'id_interacao' => $assoc_info['id_publi_interagida'],
                        'text_post' => $assoc_info['text_publi'],
                        'img_publi' => $assoc_info['img_publi'],
                        'num_curtidas' => $assoc_info['num_curtidas'],
                        'beepadas' => $assoc_info['num_compartilha'],
                        'date_publi' => dateCalc($assoc_info),
                        "date_publi_ca" => date('d/m/Y', strtotime($assoc_info['date_publi'])),
                        "date_publi_hr" => date('H:i', strtotime($assoc_info['date_publi'])),
                        'num_comentario' => $assoc_info['num_comentario'],
                        'user_info' => [
                            'user_id' => $assoc_info['user_publi'],
                            'nome_user' => $assoc_user['nome'],
                            'username_user' => $assoc_user['username'],
                            'img_user' => perfilDefault($assoc_user['foto_perfil'], ''),
                        ]
                    ];
                    echo json_encode($info_comentada);
                } else {
                    $info_comentada[] = [
                        'erro' => true,
                        'desc' => 'usuario não encontrado'
                    ];
                }
            } else {
                $info_comentada[] = [
                    'erro' => true,
                    'desc' => 'postagem não encontada'
                ];
            }
        } elseif ($assoc_info['type'] == '4') {
            $sql_raiz_type3 = 'SELECT * FROM publicacoes WHERE id_publi='.$assoc_info['id_publi_interagida'];
            $res_raiz_type3 = mysqli_query($conexao, $sql_raiz_type3);
            $assoc_raiz_type3 = mysqli_fetch_assoc($res_raiz_type3);
            if(!is_null($assoc_raiz_type3)) {
                $user_info_comentada = 'SELECT * FROM users WHERE id_user='.$assoc_raiz_type3['user_publi'];
                $res_user_info_cometada = mysqli_query($conexao, $user_info_comentada);
                $assoc_user = mysqli_fetch_assoc($res_user_info_cometada);
                if(!is_null($assoc_user)) {
                    $info_comentada = [
                        'id_publi' => $assoc_raiz_type3['id_publi'],
                        'type' => $assoc_raiz_type3['type'],
                        'id_interacao' => $assoc_raiz_type3['id_publi_interagida'],
                        'text_post' => $assoc_raiz_type3['text_publi'],
                        'img_publi' => $assoc_raiz_type3['img_publi'],
                        'num_curtidas' => $assoc_raiz_type3['num_curtidas'],
                        'beepadas' => $assoc_raiz_type3['num_compartilha'],
                        'date_publi' => dateCalc($assoc_raiz_type3),
                        "date_publi_ca" => date('d/m/Y', strtotime($assoc_raiz_type3['date_publi'])),
                        "date_publi_hr" => date('H:i', strtotime($assoc_raiz_type3['date_publi'])),
                        'num_comentario' => $assoc_raiz_type3['num_comentario'],
                        'user_info' => [
                            'user_id' => $assoc_raiz_type3['user_publi'],
                            'nome_user' => $assoc_user['nome'],
                            'username_user' => $assoc_user['username'],
                            'img_user' => perfilDefault($assoc_user['foto_perfil'], ''),
                        ]
                    ];
                    echo json_encode($info_comentada);
                } else {
                    $info_comentada[] = [
                        'erro' => true,
                        'desc' => 'usuario não encontrado'
                    ];
                }
            } else {
                $info_comentada[] = [
                    'erro' => true,
                    'desc' => 'postagem não encontada'
                ];
            }
        }

?>