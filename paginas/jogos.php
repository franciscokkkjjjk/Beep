<?php 
    session_start();
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    }  
    require_once '../assets/script/php/conecta.php';
    require_once '../assets/script/php/function/funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista de jogos | Beep</title>
    <link rel="icon" href="../assets/imgs/default/beep_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/feed/style.css">
    <style>
        <?php 
            if(!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>
        .menu--pag--img--area {
            background-image: url('../assets/imgs/profile/<?=$_SESSION['img']?>')
        }
        <?php } else { ?>
            .menu--pag--img--area {
            background-image: url('../assets/imgs/default/perfil-de-usuario-black.png');
        }
        <?php }?>
    </style>
</head>
<body>
<div class="feed-area">
        <?php 
            require_once '../assets/script/php/html__generic/nav_menu.php';
        ?>
        <div class="timeline--area">
           ass
        </div>
        <?php 
            require_once '../assets/script/php/html__generic/recomendado.php';
        ?> 
    </div>
    
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
</body>
</html>