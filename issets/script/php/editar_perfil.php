<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
} 
require_once '../issets/script/php/conecta.php';
?>