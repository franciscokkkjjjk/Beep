<?php
    session_start();
    require_once '../conecta.php';
    if(isset($_POST['p-xD30'])) {
        $postagem = $_POST['p-xD30'];
        $sql_type_post = 'SELECT * FROM publicacoes WHERE id_publi='.$_POST['p-xD30'];
        $res_type_post = mysqli_query($conexao, $sql_type_post);
        $arra_type_post = mysqli_fetch_assoc($res_type_post);

        $sql_verify = "SELECT * FROM `curtidas` WHERE curtidas.id_user_curti=" . $_SESSION['id_user'] . " AND curtidas.id_postagem=".$_POST['p-xD30'];
        $res_verify = mysqli_query($conexao, $sql_verify);
        $all_verify = mysqli_fetch_all($res_verify, 1);
        if(count($all_verify) < 1) {
            $json = [
                'error' => true,
                'mensage' => 'Essa postagem já foi descurtida anteriormente.'
            ];
           echo json_encode($json);
           die;
        }
        if($arra_type_post['type'] == '4') {
            $postagem = $arra_type_post['id_publi_interagida'];
        }
        $sql_descurtir = "DELETE FROM curtidas WHERE id_user_curti=".$_SESSION['id_user']." AND id_postagem=".$postagem;
        $res_d = mysqli_query($conexao, $sql_descurtir);

        $sql_num = 'SELECT num_curtidas FROM publicacoes WHERE id_publi='.$postagem;
        $res_num = mysqli_query($conexao, $sql_num);
        $ar_num = mysqli_fetch_assoc($res_num);
        if(count($all_verify) >= 2) {
            $num_calc = intval($ar_num['num_curtidas'])-2;
        } else {
            $num_calc = intval($ar_num['num_curtidas'])-1;
        }
        $sql_up = "UPDATE publicacoes SET num_curtidas=".$num_calc." WHERE id_publi=".$postagem;
        $res_up = mysqli_query($conexao, $sql_up);

        if($res_d) {
            $josoares = [
                'error' => false,
                'curtidas' => $num_calc
            ];
            echo json_encode($josoares);
        } else {
            $josoares = [
                'error' => true,
                'mensage' => 'não foi possivel atualizar o numero de curtidas'
            ];
            echo json_encode($josoares);
        }
    } else {
        echo 'saia saia daqui';
    }
   
?>