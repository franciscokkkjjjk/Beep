<?php
session_start();
require_once '../conecta.php';
$json = array();
if (isset($_POST['p-xD30'])) {
    $post_curtido = $_POST['p-xD30'];
    $error = false;
}
if (isset($_POST['p-xD30'])) {
    $sql_type_post = 'SELECT * FROM publicacoes WHERE id_publi=' . $_POST['p-xD30'];
    $res_type_post = mysqli_query($conexao, $sql_type_post);
    $arra_type_post = mysqli_fetch_assoc($res_type_post);
    if ($arra_type_post['type'] == 2) {
        $sql_verify = "SELECT * FROM `curtidas` WHERE curtidas.id_user_curti=" . $_SESSION['id_user'] . " AND curtidas.id_postagem=" . $arra_type_post['id_publi_interagida'];
    } else {
        $sql_verify = "SELECT * FROM `curtidas` WHERE curtidas.id_user_curti=" . $_SESSION['id_user'] . " AND curtidas.id_postagem=" . $_POST['p-xD30'];
    }
    $res_verify = mysqli_query($conexao, $sql_verify);
    $all_verify = mysqli_fetch_all($res_verify, 1);
    if (count($all_verify) > 1) {
        $json = [
            'error' => true,
            'mensage' => '<a href="https://youtu.be/DzMo-EhGqG4">click aqui</a>'
        ];
        echo json_encode($json);
        die;
    }
    if ($arra_type_post['type'] == '4') {
        $post_curtido = $arra_type_post['id_publi_interagida'];
    }
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();
    $data_publi = date('Y-m-d H:i:s');
    $sql_curtida = "INSERT INTO curtidas(id_user_curti, id_postagem, curtida_date) VALUE (" . $_SESSION['id_user'] . ", " . $post_curtido . ", '$data_publi')";
    $res_curtida = mysqli_query($conexao, $sql_curtida);

    $sql_num = 'SELECT num_curtidas FROM publicacoes WHERE id_publi=' . $post_curtido;
    $res_num = mysqli_query($conexao, $sql_num);
    $ar_num = mysqli_fetch_assoc($res_num);
    $num_calc = intval($ar_num['num_curtidas']) + 1;
    $sql_up = "UPDATE publicacoes SET num_curtidas=" . $num_calc . " WHERE id_publi=" . $post_curtido;
    $res_up = mysqli_query($conexao, $sql_up);

    if ($res_curtida and $res_up) {
        $json = [
            'error' => false,
            'curtidas' => $num_calc
        ];
    }

} else {
    echo 'saia saia imediatamnete';
    $json = [
        'error' => true,
        'mensage' => 'O input do id não existe.'
    ];
}
echo json_encode($json);
?>