<?php 
    require_once('ponte.php');
    $sql = 'SELECT * FROM `users`';
    $resultado = mysqli_fetch_assoc($conexao, $sql);
?>