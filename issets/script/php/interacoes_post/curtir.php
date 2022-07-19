<?php 
    session_start();
    require_once '../conecta.php';
    $json = array();
    if(isset($_POST['p-xD30'])) {
        $post_curtido = $_POST['p-xD30'];
        $error = false;
    }   
    if(isset($_POST['p-xD30'])) {
        date_default_timezone_set('America/Sao_Paulo');
        date_default_timezone_get();
        $data_publi = date('Y-m-d H:i:s');
        $sql_curtida = "INSERT INTO curtidas(id_user_curti, id_postagem, curtida_date) VALUE (".$_SESSION['id_user'].", ".$post_curtido.", '$data_publi')";
        $res_curtida = mysqli_query($conexao, $sql_curtida);
        if($res_curtida) {
            $json[] = [
                'moio' => false,
            ];
        }
  
    } else {
        echo 'saia saia imediatamnete';
        $json[] = [
            'moio' => true,
        ];
    }
    echo json_encode($json);
?>