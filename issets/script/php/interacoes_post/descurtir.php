<?php
    session_start();
    require_once '../conecta.php';
    if(isset($_POST['p-xD30'])) {
        $postagem = $_POST['p-xD30'];
        $sql_descurtir = "DELETE FROM curtidas WHERE id_user_curti=".$_SESSION['id_user']." AND id_postagem=".$postagem;
        $res_d = mysqli_query($conexao, $sql_descurtir);

        $sql_num = 'SELECT num_curtidas FROM publicacoes WHERE id_publi='.$postagem;
        $res_num = mysqli_query($conexao, $sql_num);
        $ar_num = mysqli_fetch_assoc($res_num);
        $num_calc = intval($ar_num['num_curtidas'])-1;
        $sql_up = "UPDATE publicacoes SET num_curtidas=".$num_calc." WHERE id_publi=".$postagem;
        $res_up = mysqli_query($conexao, $sql_up);

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