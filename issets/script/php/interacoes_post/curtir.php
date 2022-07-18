<?php 
    session_start();
    require_once '../conecta.php';
    $json = array();
    if(isset($_POST['p-xD30'])) {
        $post_curtido = $_POST['p-xD30'];
        $error = false;
    }   
    if(isset($_POST['p-xD30'])) {
        $sql_curtida = 'INSERT INTO curtidas(id_user_curti, id_postagem	) VALUE ('.$_SESSION['id_user'].', '.$post_curtido.')';
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