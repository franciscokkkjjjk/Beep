<?php 
    session_start();
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    } else {
        header('location:inicial.php');
    }
?>