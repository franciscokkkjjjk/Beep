<?php 
if(isset($_GET['id_p'])) {
    $id_publi =  $pdo->real_escape_string($_GET['id_p']);
    var_dump($id_publi);
    die;

}