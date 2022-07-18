<?php
    session_start();
    require_once '../conecta.php';
    if(isset($_POST['p-xD30'])) {
        $postagem = $_POST['p-xD30'];
        $sql_descurtir = "DELETE FROM curtidas WHERE id_user_curti=".$_SESSION['id_user']." AND id_postagem=".$postagem;
        $res_d = mysqli_query($conexao, $sql_descurtir);
        if($res_d) {
            $josoares[] = [
                'moio' => false
            ];
            echo json_encode($josoares);
        } else {
            $josoares[] = [
                'moio' => true
            ];
            echo json_encode($josoares);
        }
    } else {
        echo 'saia saia daqui';
    }
   
?>