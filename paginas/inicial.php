<?php 
    session_start();
    
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    }  
    require_once '../assets/script/php/historico.php';    
    require_once '../assets/script/php/conecta.php';
    require_once '../assets/script/php/function/funcoes.php';
    require_once '../assets/script/php/html__generic/suspenso_.php';

    $sql_posts = "SELECT * FROM publicacoes WHERE user_publi IN (SELECT user_seguido FROM seguidores WHERE user_seguin=".$_SESSION['id_user'].") ORDER BY date_publi DESC ";
    $res_posts = mysqli_query($conexao,$sql_posts);
    $postagens = mysqli_fetch_all($res_posts,1);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/imgs/default/beep_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/feed/style.css">
    <title>Pagina inicial | Beep</title>
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
            <div class="feed-header-body">
                <h1>
                    Inicio
                </h1>
            </div>
            <div class="feed-body-post">
            <form action="../assets/script/php/posts.php" method="post" enctype="multipart/form-data">
                    <div class="form--post--area">
                        <div class="area--form01">
                            <div class="form--post--perfil">
                                <div class="img--perfil menu--pag--img--area"></div>
                            </div>  
                            <div class="form--post--text">
                                <div class="form--inpudiv--event">
                                    <span class='placeholder--div event--placeholder'>O que ta rolando, <?=$_SESSION['nome']?>?</span>
                                </div>
                                <div class="img--post">
                                </div>
                            </div>
                            <button class="button--post--form" type="submit">Postar</button>    
                            <input type="hidden" value="" class='form--event--diviput' name="post_text">
                        </div>
                        <div class="area--form02">
                            <div class="menu--post--item">
                                <div class="area--opt">
                                    <label for="img--post">
                                        <div class="opt--menu--item pic" aria-label="Adicionar uma imagem."></div>
                                    <input id="img--post" type="file" style="display: none;" class="input_img_event" name="img_post">
                                    </label>
                                    <div class="opt--menu--item game_img opt--menu--item--margin-left event_modal_game" aria-label="Adicionar um jogo.">
                                        
                                    </div>
                                </div>
                                <div class="area_game_publi">
                                    
                                </div>
                                <input type="hidden" value="" class="game_publi" name="game_">
                                <div class="remove_game_publi" style="display:none;">
                                    Remover
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="back--event">
                    <div class="event"></div>
                </div>
                <?php require_once '../assets/script/php/html__generic/posts_template.php';?>
            </div>
        </div>
        <?php 
            require_once '../assets/script/php/html__generic/recomendado.php';
        ?> 
    </div>
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/scriptAll.js"></script>
    <script type ="text/javascript" src="../assets/script/javascript/default/coment-script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/posts/posts.js">
    
    </script>
    <script>
        posts();
        verficar_posts();
    </script>
    <script type="text/javascript" src="../assets/script/javascript/feed/script.js"></script>
    <script>
        const nome = <?php echo '"'.$_SESSION['nome'].'"';?>;
        const email = <?php echo '"'.$_SESSION['email'].'"';?>;
        const username = <?php echo '"'.$_SESSION['username'].'"';?>;
        const img_perfil = <?php echo '"'.$_SESSION['img'].'"';?>;
        const img_banner = <?php echo '"'.$_SESSION['img_banner'].'"';?>;
        const bio = <?php echo '`'.$_SESSION['bio_user'].'`';?>;
        const dateC = <?php echo '"'.date('d/m/Y', strtotime($_SESSION['data_nas'])).'"';?>;
        const m_nas = <?php echo '"'.date('m', strtotime($_SESSION['data_nas'])).'"';?>;
        const d_nas = <?php echo '"'.date('d', strtotime($_SESSION['data_nas'])).'"';?>;
        const y_nas = <?php echo '"'.date('Y', strtotime($_SESSION['data_nas'])).'"';?>;
    </script>
    <script src="../assets/script/javascript/default/edit_form.js">
    </script>
    <script type="text/javascript" src="../assets/script/javascript/default/form_creat.js">
    </script>
    <script src="../assets/script/javascript/default/jogos/game.js"></script>
    </body>
</html>