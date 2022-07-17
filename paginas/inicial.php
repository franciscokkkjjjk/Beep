<?php 
    session_start();
    
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    } 
    require_once '../issets/script/php/historico.php';    
    require_once '../issets/script/php/conecta.php';
    require_once '../issets/script/php/function/funcoes.php';
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
    <link rel="icon" href="../issets/imgs/default/beep_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../issets/style/generic/style.css">
    <link rel="stylesheet" href="../issets/style/feed/style.css">
    <title>Pagina inicial | Beep</title>
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
                            <img src="../issets/imgs/default/beep_logo.png">
                        </a>
                    </div>
                </div>
            </div>
            <div class="body--menu-pag">
                <div  class="menu--pag-perfil--area">
                <a href="perfil.php" class="perfil-link">
                    <div class="menu--pag menu--pag--event01">
                        <div class="menu--pag--img--area">
                        </div>
                        <div class="menu--pag--name-perfil--area">
                            <div class="menu--pag--name-perfil" >
                                <?=$_SESSION['nome']?>
                            </div>
                            <div class="menu--pag--username-perfil">
                                <?= $_SESSION['username'] ?>
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class=" event--menu-pag menu--pag--opt--menu--area">
                        <div class="menu--pag--opt">
                            <a href="inicial.php" style="color: #fff;" class="active--tem img--opt-feed img--pag--inicial menu--pag--opt--section">
                                Pagina inicial
                            </a>
                            <a href=''class="img--opt-feed img--pag--jogos menu--pag--opt--section">
                                Jogos
                            </a>
                            <a onclick="teste()" class="img--opt-feed img--pag--solic menu--pag--opt--section">
                              Solicitar jogo
                            </a>
                            <a href="perfil.php" class="img--opt-feed img--pag--perf menu--pag--opt--section">
                                Perfil
                            </a>
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
            <form action="../issets/script/php/posts.php" method="post" enctype="multipart/form-data">
                    <div class="form--post--area">
                        <div class="area--form01">
                            <div class="form--post--perfil">
                                <div class="img--perfil menu--pag--img--area"></div>
                            </div>  
                            <div class="form--post--text">
                                <div class="form--inpudiv--event">
                                    <span class='placeholder--div event--placeholder'>O que ta rolando, <?=$_SESSION['nome']?>?</span>
                                    <div id="inputdiv"  contenteditable="true" class="inputdiv--form--post">
                                    </div>
                                </div>
                                <div class="img--post">
                                </div>
                            </div>
                            <button class="button--post--form" type="submit">Postar</button>     <!-- post direto parecido com o que tem no facebook e no twitter(rever)-->
                            <input type="hidden" value="" class='form--event--diviput' name="post_text">
                        </div>
                        <div class="area--form02">
                            <div class="menu--post--item">
                                <div class="area--opt">
                                    <label for="img--post">
                                        <div class="opt--menu--item pic" title="Adicionar uma imagem"></div>
                                    <input id="img--post" type="file" style="display: none;" class="input_img_event" name="img_post">
                                    </label>
                                </div>
                            </div>
                        </div>
                        </div>
                </form>
                <div class="event"></div>
                <div class="post_clone" style="display: none;">
                <div class="post--menu--area" >
                    <div class="header--post--area">
                        <div class="post--area--perfil">
                            <div class="img--perfil menu--pag--img--area">
                            </div>
                            <div class="name--area">        
                                    <a class="perfil-link" href="">        
                                    <div class="name--name-perfil perfil-link-hover">
                                    </div>
                                    <div class="name--username-perfil perfil-link-hover">

                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="post--area--date ">
                            <div class="date--post">
                            </div>
                        </div>  
                        <div class="post--area--menu ">
                            <div class="elipse-img-hover elipse-img"></div>
                        </div>                                                              <!--deve ter o nome e @ do usuario e o menu de denuncia de cada usuario-->
                    </div>
                    <div class="body--post--area">
                        <div class="post--text"></div>
                        <div class="post--img-area" style="display: none;">
                            <div class="post--img" >
                                <div class="event--post--img"></div>
                            </div>
                        </div>                                        <!--deve ter oq o usuario publicou-->
                    </div>
                    <div class="interacao--post--area">
                        <form  class="p-xD30">
                            <input type="hidden" value="" name="p-xD30">
                            <button class="curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off">
                                    Curtir
                            </button>
                            </lable> 
                        </form>
                        <div class="comentar interacao--area">
                            comentar
                        </div>
                        <div class="compartilhar interacao--area">
                            compartilhar
                        </div>                                                      <!--deve ter o curtir compartilhar e comentar-->
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
                
            </div>
            <div class="convite--body pessoas Recomendados-body">
                <div class="title--recomendados">
                    Recomendados
                </div>
                <div class="body--recomendado">
                <?php 
                    $sql_seguidores_user = "SELECT * 
                                            FROM users 
                                            WHERE id_user 
                                                IN (SELECT seguidores.user_seguido 
                                                    FROM seguidores WHERE user_seguin=".$_SESSION['id_user']." AND seguidores.user_seguido <> ". $_SESSION['id_user'].")
                                                    ORDER BY t_seguidores DESC";

                    $sql_seguidores_seguidores = "SELECT * FROM users WHERE id_user IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin = ".$_SESSION['id_user']." AND seguidores.user_seguido <> ".$_SESSION['id_user'].") AND seguidores.user_seguido <> ".$_SESSION['id_user'].") AND id_user <> ".$_SESSION['id_user']." LIMIT 4";
                    $all_users = 'SELECT * FROM users WHERE id_user <> '.$_SESSION['id_user'].' ORDER BY t_seguidores DESC';

                    $resul_seguidores_user = mysqli_query($conexao, $sql_seguidores_user);
                    $resul_seguidores_seguidores = mysqli_query($conexao, $sql_seguidores_seguidores);
                    $resul_all_users = mysqli_query($conexao, $all_users);

                    $array_seguidores_user = mysqli_fetch_all($resul_seguidores_user, 1);
                    $array_seguidores_seguidores = mysqli_fetch_all($resul_seguidores_seguidores, 1);
                    $array_all_users = mysqli_fetch_all($resul_all_users, 1);
                    $array_ante = array();
                    $quantidade = 0;
                    foreach($array_seguidores_seguidores as $value01) {
                        $seguindo = false;
                        foreach($array_seguidores_user as $value02) {
                            if($value01['username'] == $value02['username']) {
                                $seguindo = true;
                          }
                        }
                        if(!$seguindo) {?>
                            <div class="opt--recomedado--area">
                                        <div class="perfil--area">
                                        <div class="img--perfil menu--pag--img--area area--recomendado" style="<?=perfilDefault($value01['foto_perfil'], '')?>">
                                        </div>
                                        <div class="name--area">
                                        <a class="perfil-link" href="perfil_user_v.php?username=<?=$value01['username']?>"> 
                                                <div class="name--name-perfil perfil-link-hover">
                                                <?=$value01['nome']?>
                                                </div>
                                                <div class="name--username-perfil perfil-link-hover">
                                                    <?=$value01['username']?>
                                                </div>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="buttom-recomendado-area">
                                            <div class="buttom--body">
                                                <form action="../issets/script/php/seguir.php" method="post">
                                                    <button type="submit" class="button--seguir"></button>
                                                <input type="hidden" value="<?= $value01['id_user']?>" name="iD_x30">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                            $quantidade++; 
                            $array_ante['username'] = $value01['username'];
                            ?>
                  <?php }
                    }
                        foreach($array_ante as $value03) {
                            if($quantidade < 4) {
                            $seguindo_01 = false;
                            foreach($array_all_users as $value04) {
                                    if($array_ante['username'] == $value04['username']){
                                        $seguindo_01 = true;
                                    }
                                }
                                if($seguindo_01) { ?>
                                    <div class="opt--recomedado--area">
                                        <div class="perfil--area">
                                        <div class="img--perfil menu--pag--img--area area--recomendado" style="<?=perfilDefault($value04['foto_perfil'], '')?>">
                                        </div>
                                        <div class="name--area">
                                        <a class="perfil-link" href="perfil_user_v.php?username=<?=$value04['username']?>"> 
                                                <div class="name--name-perfil perfil-link-hover">
                                                <?=$value04['nome']?>
                                                </div>
                                                <div class="name--username-perfil perfil-link-hover">
                                                    <?=$value04['username']?>
                                                </div>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="buttom-recomendado-area">
                                            <div class="buttom--body">
                                                <form action="../issets/script/php/seguir.php" method="post">
                                                    <button type="submit" class="button--seguir"></button>
                                                <input type="hidden" value="<?= $value04['id_user']?>" name="iD_x30">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                $quantidade++;
                            }
                        } if($quantidade == 0) {
                            foreach($array_all_users as $value05) {
                                if($quantidade < 4) {
                                    $sql_user = "SELECT t_seguindo FROM users WHERE id_user=".$_SESSION['id_user'];
                                    $res_query_user = mysqli_query($conexao, $sql_user);
                                    $array_query_user = mysqli_fetch_array($res_query_user);
                                    $total = $array_query_user[0];
                                    if($total == 0) {?>
                                        <div class="opt--recomedado--area">
                                                <div class="perfil--area">
                                                <div class="img--perfil menu--pag--img--area area--recomendado" style="<?=perfilDefault($value05['foto_perfil'], '')?>">
                                                </div>
                                                <div class="name--area">
                                                <a class="perfil-link" href="perfil_user_v.php?username=<?=$value05['username']?>"> 
                                                        <div class="name--name-perfil perfil-link-hover">
                                                        <?=$value05['nome']?>
                                                        </div>
                                                        <div class="name--username-perfil perfil-link-hover">
                                                            <?=$value05['username']?>
                                                        </div>
                                                    </a>
                                                </div>
                                                </div>
                                                <div class="buttom-recomendado-area">
                                                    <div class="buttom--body">
                                                        <form action="../issets/script/php/seguir.php" method="post">
                                                            <button type="submit" class="button--seguir"></button>
                                                        <input type="hidden" value="<?= $value05['id_user']?>" name="iD_x30">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php  $quantidade++;
                                    } else {
                                        $seguindo = false;
                                        foreach($array_seguidores_user as $value06) {
                                            if($value05['username'] == $value06['username']) {
                                                $seguindo = true;
                                            }
                                        }
                                        if(!$seguindo) { ?>
                                            <div class="opt--recomedado--area">
                                                <div class="perfil--area">
                                                <div class="img--perfil menu--pag--img--area area--recomendado" style="<?=perfilDefault($value05['foto_perfil'], '')?>">
                                                </div>
                                                <div class="name--area">
                                                <a class="perfil-link" href="perfil_user_v.php?username=<?=$value05['username']?>"> 
                                                        <div class="name--name-perfil perfil-link-hover">
                                                        <?=$value05['nome']?>
                                                        </div>
                                                        <div class="name--username-perfil perfil-link-hover">
                                                            <?=$value05['username']?>
                                                        </div>
                                                    </a>
                                                </div>
                                                </div>
                                                <div class="buttom-recomendado-area">
                                                    <div class="buttom--body">
                                                        <form action="../issets/script/php/seguir.php" method="post">
                                                            <button type="submit" class="button--seguir"></button>
                                                        <input type="hidden" value="<?= $value05['id_user']?>" name="iD_x30">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                          <?php  $quantidade++;
                                        } 
                                    }
                                }
                            }
                        }

                    ?>
                </div>
                <div class="mais--recomendados">
                    <a class="link" style="color: #f0f0f0;" href="">Ver mais</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../issets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/posts/posts.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/feed/script.js"></script>
    <script>
        const nome = <?php echo '"'.$_SESSION['nome'].'"';?>;
        const email = <?php echo '"'.$_SESSION['email'].'"';?>;
        const username = <?php echo '"'.$_SESSION['username'].'"';?>;
        const img_perfil = <?php echo '"'.$_SESSION['img'].'"';?>;
        const img_banner = <?php echo '"'.$_SESSION['img_banner'].'"';?>;
        const bio = <?php echo '"'.$_SESSION['bio_user'].'"';?>;
        const dateC = <?php echo '"'.date('d/m/Y', strtotime($_SESSION['data_nas'])).'"';?>;
        const m_nas = <?php echo '"'.date('m', strtotime($_SESSION['data_nas'])).'"';?>;
        const d_nas = <?php echo '"'.date('d', strtotime($_SESSION['data_nas'])).'"';?>;
        const y_nas = <?php echo '"'.date('Y', strtotime($_SESSION['data_nas'])).'"';?>;
    </script>
    <script src="../issets/script/javascript/default/edit_form.js">
    </script>
    <script type="text/javascript" src="../issets/script/javascript/default/form_creat.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/creat_modal_img.js"></script>
    <script>let a = true;
        setInterval(()=>{
        if(a == true){
        a = false;
        document.querySelector('.event').style.position = 'absolute';
        document.querySelector('.event').style.right = '50%';
        document.querySelector('.event').style.top = '30%';
        document.querySelector('.event').style.borderBottom = '3px solid #000';
        document.querySelector('.event').style.borderTop = '3px solid #000';
        document.querySelector('.event').style.borderLeft='3px solid #53ffff';
        document.querySelector('.event').style.borderRight='3px solid #53ffff';
    } else {
        a = true;
        document.querySelector('.event').style.borderBottom = '3px solid #53ffff';
        document.querySelector('.event').style.borderTop = '3px solid #53ffff';
        document.querySelector('.event').style.borderLeft='3px solid #000';
        document.querySelector('.event').style.borderRight='3px solid #000';
        
    }
    }, 250)</script>
</body>
</html>

   <!--<script>document.querySelector('.feed-new-input-placeholder').addEventListener('click', function(obj){
    obj.target.style.display = 'none';
    document.querySelector('.feed-new-input').style.display = 'block';
    document.querySelector('.feed-new-input').focus();
    document.querySelector('.feed-new-input').innerText = '';
});

document.querySelector('.feed-new-input').addEventListener('blur', function(obj) {
    let value = obj.target.innerText.trim();
    if(value == '') {
        obj.target.style.display = 'none';
        document.querySelector('.feed-new-input-placeholder').style.display = 'block';
    }
});</script>-->

    
<!-- <div class="event"></div>-->
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