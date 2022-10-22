<?php 
    if(isset($_POST['dP_xd30'])) {
        session_start();
        require_once '../conecta.php';
        $id_post = mysqli_escape_string($conexao, $_POST['dP_xd30']);
        $sql_post = "SELECT * FROM publicacoes WHERE id_publi=" . $id_post;
        $res_post = mysqli_query($coenxao, $sql_post);
        $ass_post = mysqli_fetch_assoc($res_post);
        $tipo_post = $ass_post['type'];
        $verify = "SELECT * FROM denuncias WHERE "

    } else {
        $json = [
            'error' => true,
            'mensage' => 'Input inexistente.' 
        ];
        echo json_encode($json);
    }
?>