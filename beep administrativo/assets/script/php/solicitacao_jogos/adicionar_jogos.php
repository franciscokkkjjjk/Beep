<?php
//adicionar a tabela jogos
if($_POST['p_adm305']) {
    $json = [
        'error' => false,
        'mensage' => $_GET['id_game']
    ];
}

echo json_encode($json);