<?php
$json = [
    'error' => false,
    'mensage' => $_GET['id_game']
];
echo json_encode($json);