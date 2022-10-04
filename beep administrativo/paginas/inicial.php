<!-- <a href="../assets/script/php/logout_root.php">s</a> -->
<?php 
    session_start();
    if(!isset($_SESSION['id_root'])) {
        header('location:../');
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/imgs/default/beep_logo.png">
    <title>Inicial | Beep Administrativo</title>
</head>
<body>
    <?php 
        if(isset($_SESSION['ative'])) {
            require_once '../assets/script/php/generic_HTML/form_active.php';
        } else {
    ?>
    teste
    <?php
        }
    ?>
</body>
</html>