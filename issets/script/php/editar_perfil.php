<?php 
$dat_in = mktime(0, 0, 0, date('m'), date('d'), date('Y'));;
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once 'conecta.php';
$nome_user = $_POST['nome_edit'];
$username_user = $_POST['username_edit'];
$bio_user = $_POST['bio_edit'];
$mes_user = $_POST['mes'];
$ano_user = $_POST['ano'];
$dia_user = $_POST['dia'];
//é possivel mandar funções de js pelo php $_session['funcao'] = 'funcaojs_()';
?>