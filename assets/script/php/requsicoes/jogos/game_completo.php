<?php 
session_start();
require_once '../../conecta.php';
if(isset($_GET['id_game'])) {
    $sql_ = "SELECT * FROM jogos WHERE id_jogos=" . $_GET['id_game'];
    $res_ = mysqli_query($conexao, $sql_);
    if($res_) {
        $assoc_ = mysqli_fetch_assoc($res_);
        $json = [
            'id_game' => $assoc_['id_jogos'],
            'nome_game' => $assoc_['nome_jogo'],
            'img_game' => $assoc_['img_jogo'],
            'desc_jogo' => $assoc_['desc_jogo'],
            'loja' => $assoc_['loja'],
            'class_etaria' => $assoc_['class_etaria']
        ];
        echo json_encode($json);
        } else {
        $json = [
            'error' => true,
            'mensage' => 'Algo deu errado! Recarregue a pagina, e tente novamente!'
        ];
        echo json_encode($json);
    }
} else {
    $json = [
        'error' => true,
        'mensage' => 'O id_game para o post completo não existe. Tente novamente.'
    ];
    echo json_encode($json);
}
