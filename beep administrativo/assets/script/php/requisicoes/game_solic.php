<?php 
    session_start();
    if(!isset($_SESSION['id_root'])) {
        die;
    }
?>