<?php 
    require_once '../conecta.php';
    $a = 'nem fois';
    if(isset($_POST['p-xD30'])) {
        $a = 'kkkkk';
    }
    $resultJson = ['moio' => false, 'texto' => 'miranda cheguei', 'teste' => $a];
    echo json_encode($resultJson);
?>