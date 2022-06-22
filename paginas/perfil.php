<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../issets/imgs/default/Letra-B-PNG-1.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../issets/style/generic/style.css">
    <link rel="stylesheet" href="../issets/style/feed/style.css">
    <link rel="stylesheet" href="../issets/style/toca/style.css">
    <title><?= $_SESSION['nome']?> | Beep</title>
    <style>
        <?php 
            if(!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>
        .menu--pag--img--area {
            background-image: url('../issets/imgs/profile/<?=$_SESSION['img']?>')
        }
        <?php } else { ?>
            .menu--pag--img--area {
            background-image: url('../issets/imgs/default/perfil-de-usuario-black.png');
        }
        <?php }?>
    </style>
</head>
<body>
    <div class="feed-area">
        <div class="menu--pag--area">
            <div class="feed-logo-body">
                <div class="logo--area">
                    <div class="logo">
                        <a href="">
                            <img src="../issets/imgs/default/Letra-B-PNG-1.png">
                        </a>
                    </div>
                </div>
            </div>
            <div class="body--menu-pag">
                <div  class="menu--pag-perfil--area">
                    <div class="menu--pag menu--pag--event01">
                        <div class="menu--pag--img--area">
                        </div>
                        <div class="menu--pag--name-perfil--area">
                            <div class="menu--pag--name-perfil">
                                <?=$_SESSION['nome']?>
                            </div>
                            <div class="menu--pag--username-perfil">
                                <?= $_SESSION['username'] ?>
                            </div>
                        </div>
                    </div>
                    <div class=" event--menu-pag menu--pag--opt--menu--area">
                        <div class="menu--pag--opt">
                            <a href="inicial.php" style="color: #fff;" class="img--opt-feed img--pag--inicial menu--pag--opt--section">
                                Pagina inicial
                            </a>
                            <a href=''class="img--opt-feed img--pag--jogos menu--pag--opt--section">
                                Jogos
                            </a>
                            <a href="" class="img--opt-feed img--pag--solic menu--pag--opt--section">
                              Solicitar jogo
                            </a>
                            <a href="perfil.php" class="active--tem img--opt-feed img--pag--perf menu--pag--opt--section">
                                Perfil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="timeline--area">
            <div class="feed-header-body">
                <div class="menu--pag--button button--back">
                    <div class="seta--back"></div>
                </div>
                <div class="nome--perfil">
                    <?= $_SESSION['nome']?>
                </div>
            </div>
            <div class="feed-body-post">
               <div class="header--perfil--area">
                <div class="banner--perfil">
                    <?php if(!$_SESSION['img_banner'] == NULL){?>
                    <img src="../issets/imgs/profile/<?= $_SESSION['img_banner']?>">
                    <?php }?>
                </div>
                <div class="info--perfil">
                        <div class="info--perfil--area">
                            <div class="info--perfil--img">
                                <div class="info--perfil--img info--perfil--img--position">
                                    <?php 
                                    if(!$_SESSION['img'] == null) {
                                    ?>
                                        <img src="../issets/imgs/profile/<?=$_SESSION['img']?>">
                                    <?php } else { ?>
                                        <img src="../issets/imgs/default/perfil-de-usuario-black.png">
                                    <?php }?> 
                                </div>
                            </div>
                            <div class="info--perfil--user">
                                <div class="info--perfil--user--nome">
                                    <?=$_SESSION['nome'];?>
                                </div>
                                <div class="info--perfil--user--username">
                                    <?=$_SESSION['username'];?>
                                </div>
                            </div>
                            <div class="info--button">
                                <a href='' class="button--editar">Editar perfil</a>
                            </div>
                        </div>
                </div>
               </div>
            </div>
        </div>
        
        <div class="area--convite">
            <div class="feed-logo-body menu--header">
                <div class="menu">
                    <div class="menu--pag--button-menu--area " >
                        <div class="menu--pag--button button--header">
                            <div class="event--header"></div>
                        </div>
                    </div>
                </div>
                <div class="menu--header--body">
                    <a href='../issets/script/php/logout.php' class="opt--menu-header">
                        <div class="img--menu--header logout"></div>
                        <div class="text--menu--header">logout</div>
                    </a>
                </div>
            </div>
            <div class="convite--body">
                a
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../issets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/feed/script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/toca/script.js"></script>
</body>
</html>