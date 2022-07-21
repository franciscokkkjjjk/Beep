<?php 
    session_start();
    require_once '../conecta.php';
    $json = array();
    if(isset($_POST['p-xD30'])) {
        $post_curtido = $_POST['p-xD30'];
        $error = false;
    }   
    if(isset($_POST['p-xD30'])) {
        $sql_type_post = 'SELECT * FROM publicacoes WHERE id_publi='.$_POST['p-xD30'];
        $res_type_post = mysqli_query($conexao, $sql_type_post);
        $arra_type_post = mysqli_fetch_assoc($res_type_post);
        if($arra_type_post['type'] == '4') {
            $post_curtido = $arra_type_post['id_publi_interagida'];
        }
        date_default_timezone_set('America/Sao_Paulo');
        date_default_timezone_get();
        $data_publi = date('Y-m-d H:i:s');
        $sql_curtida = "INSERT INTO curtidas(id_user_curti, id_postagem, curtida_date) VALUE (".$_SESSION['id_user'].", ".$post_curtido.", '$data_publi')";
        $res_curtida = mysqli_query($conexao, $sql_curtida);
        
        $sql_num = 'SELECT num_curtidas FROM publicacoes WHERE id_publi='.$post_curtido;
        $res_num = mysqli_query($conexao, $sql_num);
        $ar_num = mysqli_fetch_assoc($res_num);
        $num_calc = intval($ar_num['num_curtidas'])+1;
        $sql_up = "UPDATE publicacoes SET num_curtidas=".$num_calc." WHERE id_publi=".$post_curtido;
        $res_up = mysqli_query($conexao, $sql_up);

        if($res_curtida and $res_up) {
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