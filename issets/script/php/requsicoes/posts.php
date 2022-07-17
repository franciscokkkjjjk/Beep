<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';
    $sql_posts = "SELECT * FROM publicacoes WHERE user_publi IN (SELECT user_seguido FROM seguidores WHERE user_seguin=".$_SESSION['id_user'].") ORDER BY date_publi DESC ";
    $res_posts = mysqli_query($conexao,$sql_posts);
    $postagens = mysqli_fetch_all($res_posts,1);
    foreach($postagens as $post_segui) {
        $sql_s_perfil = 'SELECT * FROM users WHERE id_user='.$post_segui['user_publi'];
        $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
        $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);
    $post[] = [
        'user_id' => $post_segui['user_publi'],
        'img_user' => perfilDefault($array_s_perfil['foto_perfil'], ''),
        'username_user' => $array_s_perfil['username'],
        'nome_user' => $array_s_perfil['nome'],
        'id_publi' => $post_segui['id_publi'],
        'text_post' => $post_segui['text_publi'],
        'img_publi' => $post_segui['img_publi'],
        'num_curtidas' => $post_segui['num_curtidas'],
        'beepadas' => $post_segui['num_compartilha'],
        'date_publi' => dateCalc($post_segui),
        'num_comentario' => $post_segui['num_comentario']
    ];
    }
    echo json_encode($post);
?>