<?php
session_start();
require_once '../conect_pdo.php';
if(!isset($_SESSION['id_user'])) {
    die;
}
$user = $pdo->query("SELECT * FROM users WHERE username='".$_SESSION['username']."'")->fetch_assoc();
if(is_null($user) or empty($user)) {
    die;
}
$json = [
 'active' => $user['data_active'],
];
echo json_encode($json);
?>