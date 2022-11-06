<?php 
    session_start();
    if(isset($_GET['id_p'])) {
        require_once '../conect_pdo.php';
        $id_p = $pdo->real_escape_string($_GET['id_p']);
        
    }
?>