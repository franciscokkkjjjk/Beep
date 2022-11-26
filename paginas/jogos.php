<?php 
    session_start();
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    }  
    require_once '../assets/script/php/conecta.php';
    require_once '../assets/script/php/function/funcoes.php';
    require_once '../assets/script/php/html__generic/suspenso_.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de jogos | Beep</title>
    <link rel="icon" href="../assets/imgs/default/beep_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/feed/style.css">
    <link rel="stylesheet" href="../assets/style/jogos/style.css">
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
    <?php 
        require_once '../assets/script/php/html__generic/game_templet.php';
    ?>
<div class="feed-area">
        <?php 
            require_once '../assets/script/php/html__generic/nav_menu.php';
        ?>
        <div class="timeline--area">
            <div class="feed-header-body">
                    <h1>
                        Lista de Jogos da Beep
                    </h1>
                    <div class="feed-logo-body menu--header">
                        <div class="menu">
                            <div class="menu--pag--button-menu--area " >
                                <div class="menu--pag--button button--header">
                                    <div class="event--header"></div>
                                </div>
                            </div>
                        </div>
                        <div class="menu--header--body">
                            <a href='<?= pagAtual('caminho');?>../assets/script/php/logout.php' class="opt--menu-header">
                                <div class="img--menu--header logout"></div>
                                <div class="text--menu--header">logout</div>
                            </a>
                        </div>
                </div>
            </div>
            <div class="feed-body-post">
                    <div class="area_game">
                    
                    </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/jogos/game.js"></script>
    <script type="text/javascript">
        game(1);
    </script>
</body>
</html>