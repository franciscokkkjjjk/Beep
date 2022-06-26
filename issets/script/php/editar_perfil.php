<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once 'conecta.php';
//é possivel mandar funções de js pelo php $_session['funcao'] = 'funcaojs_()';
?>