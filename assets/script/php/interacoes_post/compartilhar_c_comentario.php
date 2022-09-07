<?php
session_start(); 
if(isset($_POST['cC_xd30'])) {
    $test_post = $_POST['cC_xd30'];
    $arquivo_name  = $_FILES['midia_repost']['name'];
    if($arquivo_name == '' or $arquivo_name == null) {
        $name_banco = null;
    } else {
        $diretorio = '../../../imgs/posts/';
        $ex = strtolower(pathinfo($arquivo_name,PATHINFO_EXTENSION));
        $name_banco = bin2hex(random_bytes(20)) . '.' . $ex;
        if(!move_uploaded_file($_FILES["midia_repost"]["tmp_name"], $diretorio.$name_banco)) {
            $json = [
                'moio' => true,
                'error' => 'não deu update no arquivo'
             ];
             echo json_encode($json);
             die;
        }
    }
} else {
    echo 'saia agora daq';
}