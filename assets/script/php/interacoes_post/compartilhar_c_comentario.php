<?php
session_start();
if (isset($_POST['cC_xd30'])) {
    require_once '../conecta.php';
    $id_interagida = $_POST['cI_xd30'];
    $sql_verify = "SELECT * FROM `publicacoes` WHERE `id_publi_interagida`=$id_interagida AND type=2 AND user_publi=" . $_SESSION['id_user'] . "";
    $sql_verify = mysqli_query($conexao, $sql_verify);
    $array_verify = mysqli_fetch_all($sql_verify, 1);
    $text_post = mysqli_escape_string($conexao, $_POST['cC_xd30']);
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();
    $data_publi = date('Y-m-d H:i:s');
    $arquivo_name  = $_FILES['midia_repost']['name'];
    if ($arquivo_name == '' or $arquivo_name == null) {
        $name_banco = null;
    } else {
        $diretorio = '../../../imgs/posts/';
        $ex = strtolower(pathinfo($arquivo_name, PATHINFO_EXTENSION));
        $name_banco = bin2hex(random_bytes(20)) . '.' . $ex;
        if (!move_uploaded_file($_FILES["midia_repost"]["tmp_name"], $diretorio . $name_banco)) {
            $json = [
                'error' => true,
                'mensage' => 'Algo deu errado! Parece que o upload não pode ser concluido.'
            ];
            echo json_encode($json);
            die;
        }
    }
    $type_sql = "SELECT * FROM publicacoes WHERE id_publi=" . $id_interagida;
    $res_sql = mysqli_query($conexao, $type_sql);
    $ass_sql = mysqli_fetch_assoc($res_sql);
    if ($ass_sql['type'] == 4) {
        $id_interagida = $ass_sql['id_publi_interagida'];
    }
    //pega a publicação raiz antes de cadastrar para cadastrar o id do jogo
    $sql_post_raiz = "SELECT * FROM publicacoes WHERE publicacoes.id_publi=" . $id_interagida;
    $res_post_raiz = mysqli_query($conexao, $sql_post_raiz);
    $ass_post_raiz = mysqli_fetch_assoc($res_post_raiz);
    if (is_null($ass_post_raiz['id_game'])) {
        $ass_post_raiz['id_game'] = "NULL";
    }
    $sql_respot_coment = "INSERT INTO publicacoes(user_publi, type, id_publi_interagida, text_publi, img_publi, num_curtidas, num_compartilha, date_publi, num_comentario, id_game, quarentena) VALUE (" . $_SESSION['id_user'] . ",2, " . $id_interagida . ",'$text_post','$name_banco', 0, 0, '$data_publi', 0, " . $ass_post_raiz['id_game'] . ", 0)";
    $res_query = mysqli_query($conexao, $sql_respot_coment);

    $sql_post_inter = 'SELECT * FROM publicacoes WHERE id_publi=' . $id_interagida;
    $res_post_inter = mysqli_query($conexao, $sql_post_inter);
    $ass_post_inter = mysqli_fetch_assoc($res_post_inter);
    $cal = intval($ass_post_inter['num_compartilha']) + 1;
    if ($res_query) {
        $upd_num = "UPDATE publicacoes SET num_compartilha=$cal WHERE id_publi=" . $id_interagida;
        $res_num = mysqli_query($conexao, $upd_num);
        $json = [
            'error' => false,
            'mensage' => 'Postagem compartilhada com sucesso!',
        ];
        echo json_encode($json);
        die;
    } else {
        //deleta a imagem que foi para o diretorio post
        if (!($name_banco == null)) {
            $nomodiretorio = $diretorio . $name_banco;
            unlink($nomodiretorio);
        }
        $json = [
            'error' => true,
            'mensage' => 'Falha ao compartilhar o post. Tente novamente.'
        ];
        echo json_encode($json);
        die;
    }
} else {
    $json = [
        'error' => true,
        'mensage' => 'Algo deu errado! Parece que os dados não poderam ser enviados.'
    ];
    echo json_encode($json);
    die;
}
