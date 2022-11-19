<?php 
if(isset($_POST['id_user'])) {
    require
    $id_user = 
} else {
    $json = [
        'error' => true,
        'mensage' => 'A postagem foi suspensa.'
    ];
    echo json_encode($json);
    die;
}