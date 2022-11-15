<?php
session_start();
require_once '../../conecta.php';
require_once '../../function/funcoes.php';
if (isset($_GET['id_game'])) {
    $sql_ = "SELECT * FROM jogos WHERE id_jogos=" . $_GET['id_game'];
    $res_ = mysqli_query($conexao, $sql_);
    $assoc_ = mysqli_fetch_assoc($res_);

    if ($res_) {
        //valida a classifcação indicativa
        if (!valid_class_ind($_SESSION['data_nas'], $assoc_['class_etaria'])) {
            $json = [
                'error' => true,
                'mensage' => 'Você não tem idade o suficiente para acessar esse jogo.'
            ];
            echo json_encode($json);
            die;
        }
        $json = [
            'id_game' => $assoc_['id_jogos'],
            'nome_game' => $assoc_['nome_jogo'],
            'img_game' => $assoc_['img_jogo'],
            'desc_jogo' =>  $assoc_['desc_jogo'],
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
