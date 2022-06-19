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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../issets/style/generic/style.css">
    <link rel="stylesheet" href="../issets/style/feed/style.css">
    <title>Pagina inicial | Beep</title>
    <style>
        <?php 
            if(!$_SESSION['img'] == '') {
        ?>
        .menu--pag--img--area {
            background-image: url('../issets/imgs/profile/<?=$_SESSION['img']?>')
        }
        <?php } else { ?>
            .menu--pag--img--area {
            background-image: url('../issets/imgs/default/perfil-de-usuario.png');
        }
        <?php }?>
    </style>
</head>
<body>
    <!--<header>
        <div class="body--header">
            <div class="feed-logo-body">
                <div class="logo--area">
                    <div class="logo">
                        <a href="">
                            <img src="../issets/imgs/default/Letra-B-PNG-1.png">
                        </a>
                    </div>
                </div>
                <div class="menu--area">
                    <div class="menu--button">
                        <div class="seta--menu">
                        </div>
                    </div>
                </div>
            </div>
            <div class="menu--header--body">
                <a href="">
                    <div class="menu--header--opt">
                        
                    </div>
                </a>
                <a href="">
                    <div class="menu--header--opt">
                        
                    </div>
                </a>
                <a href="">
                    <div class="menu--header--opt">
                        
                    </div>
                </a>
                <a href="">
                    <div class="quit menu--header--opt">
                        Logout
                    </div>
                </a>
            </div>
        </div>
    </header>-->
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
                        <div class="menu--pag--button-menu--area">
                            <div class="menu--pag--button">
                                <div class="eventscript--seta"></div>
                            </div>
                        </div>
                    </div>
                    <div class=" event--menu-pag menu--pag--opt--menu--area">
                        <div class="menu--pag--opt">
                            <div style="color: #fff;" class="img--opt-feed img--pag--inicial menu--pag--opt--section">
                            <a href="">Pagina inicial</a>
                            </div>
                            <div class="img--opt-feed img--pag--jogos menu--pag--opt--section">
                            <a href="">Jogos</a>
                            </div>
                            <div class="img--opt-feed img--pag--solic menu--pag--opt--section">
                            <a href="">Solicitar jogo</a>
                            </div>
                            <div class="img--opt-feed img--pag--perf menu--pag--opt--section">
                            <a href="">Perfil</a>
                            </div>
                            <div class="img--opt-feed img--pag--perf menu--pag--opt--section">
                                <a href="../issets/script/php/logout.php">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="timeline--area">
            <div class="feed-header-body">
                <h1>
                    Inicio
                </h1>
            </div>
            <div class="feed-body-post">
                <div class="">
                    <!-- post direto parecido com o que tem no facebook e no twitter(rever)-->
                </div>
                <div class="post--menu--area">
                    <div class="header--post--area">
                        <div class="post--area--perfil">
                            a
                        </div>
                        <div class="post--area--menu">
                            ...
                        </div>                                                              <!--deve ter o nome e @ do usuario e o menu de denuncia de cada usuario-->
                    </div>
                    <div class="body--post--area">
                        --                                                              <!--deve ter oq o usuario publicou-->
                    </div>
                    <div class="interacao--post--area">
                        --                                                              <!--deve ter o curtir compartilhar e comentar-->
                    </div>
                </div>
                
            </div>
        </div>
        <div class="event"></div>
        <div class="area--convite">
            <div class="convite--body">
                a
            </div><!--menu fico por baixo arruma isso kkkk o cara não sabe posicionar o negocio direito kkk-->
        </div>
    </div>
    <script type="text/javascript" src="../issets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/feed/script.js"></script>
    <script>let a = true;setInterval(()=>{
        if(a == true){
        a = false;
        document.querySelector('.event').style.transform ='rotate(180deg)';
    } else {
        a = true;
        document.querySelector('.event').style.borderLeft='3px solid salmon';
        document.querySelector('.event').style.borderRight='3px solid salmon';
        document.querySelector('.event').style.transform ='rotate(-180deg)';
    }
    }, 500)</script>
</body>
</html>