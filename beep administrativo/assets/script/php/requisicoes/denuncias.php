<?php
// $json[] = [
//     'erro' => false,
//     'id' => $v['id_solicita'],
//     'title' =>  $v['nome_jogo'],
//     'img' => $v['img_jogo'],
// ];
session_start();
if(isset($_SESSION['id_root'])) {
    require_once '../conecta.php';
    $sql_denuncia = "SELECT * FROM denuncias";
    $res_denuncia = mysqli_query($conexao, $sql_denuncia);
    $array_list = mysqli_fetch_all($res_denuncia, 1);
    if(empty($array_list)) {
        $json[] = [
            'erro' => false, 
            'id' => null,
            'title' => 'Não há nenhuma solicitação de jogo ainda.',
            'img' => null
        ];
        echo json_encode($json);
        die;
    }
    foreach($array_list as $v) {
        $num_d = 0;
        foreach($array_list as $v2) {
            if($v['post_denunciado'] == $v2['post_denunciado']) {
                $num_d++;
            }
        }
        $json[] = [
            'erro' => false, 
            'id' => $v['id_denuncia'],
            'title' => $v['post_denunciado'],
            'num' => $num_d,
            'img' => null
        ];
        echo json_encode($json);
    }
}