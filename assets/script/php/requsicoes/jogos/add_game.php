<?php 
session_start();
if(isset($_GET['id_game'])) {
    $json = [
        'error' => false,
        'desc' => 'jogo adicionado a conta.'
    ];
} else {
    $json = [
        'error' => true,
        'desc' => 'id_game não existe.'
    ];
}
echo json_encode($json);
