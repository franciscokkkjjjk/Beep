<?php 
    session_start();
    require_once('../conecta.php');
        $post_id = $_POST['p-xD30'];
        $sql_info = 'SELECT * FROM publicacoes WHERE id_publi='.$post_id;
        $res_info = mysqli_query($conexao, $sql_info);
        $assoc_info = mysqli_fetch_assoc($res_info);
        if($assoc_info['type'] == '3' or $assoc_info['type'] == '2'){
            $a[] = ['nada' => 'nada'];
            echo json_encode($a);
        } elseif ($assoc_info['type'] == '4') {
            $a[] = ['nada' => 'nada'];
            echo json_encode($a);
        }

?>