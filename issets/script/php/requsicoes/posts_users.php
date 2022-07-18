<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';
    $perfil = $_GET['username'];
    $perfil_visit = array();
    $sql_perfil = "SELECT * FROM users WHERE username='$perfil'";
    $res_perfil = mysqli_query($conexao, $sql_perfil);
    $array_info = mysqli_fetch_assoc($res_perfil);

    $sql_posts = "SELECT * FROM publicacoes WHERE user_publi=".$array_info['id_user']." ORDER BY date_publi DESC ";
    $res_posts = mysqli_query($conexao,$sql_posts);
    $postagens = mysqli_fetch_all($res_posts,1);

    $sql_seguir = 'SELECT * FROM seguidores WHERE user_seguin='.$_SESSION['id_user'];
    $res_seguir = mysqli_query($conexao, $sql_seguir);
    $array_seguidor = mysqli_fetch_all($res_seguir, 1);
    $seguindo = false;
    foreach($array_seguidor as $value) {
        if($value['user_seguido'] == $array_info['id_user']) {
            $seguindo = true;
        }
    }
        $perfil_visit = [
                'user_id' => $array_info['id_user'],
                'img_user' => perfilDefault($array_info['foto_perfil'], ''),
                'banner_pefil' => perfilDefault($array_info['banner_pefil'], ''),
                'bio' => $array_info['bio'],
                't_seguindo' => $array_info['t_seguindo'],
                't_seguidores' => $array_info['t_seguidores'],
                'data_nas' => date('d/m/Y', strtotime($array_info['data_nas'])) ,
                'username_user' => $array_info['username'],
                'nome_user' => $array_info['nome'],
                'seguindo' => $seguindo,
                'publicacoes' => array()
            ];
            foreach($postagens as $post_segui) {
                $perfil_visit['publicacoes'][] = 
                [
                    'id_publi' => $post_segui['id_publi'],
                    'text_post' => $post_segui['text_publi'],
                    'img_publi' => $post_segui['img_publi'],
                    'num_curtidas' => $post_segui['num_curtidas'],
                    'beepadas' => $post_segui['num_compartilha'],
                    'date_publi' => dateCalc($post_segui),
                    'num_comentario' => $post_segui['num_comentario']
                ];
            }
    echo json_encode($perfil_visit);
?>