<?php 
    session_start();
    
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    } 
    require_once '../issets/script/php/historico.php';    
    require_once '../issets/script/php/conecta.php';
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
    <link rel="icon" href="../issets/imgs/default/Letra-B-PNG-1.png">
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
                <a href="perfil.php" class="perfil-link">
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
                    </a>
                    <div class=" event--menu-pag menu--pag--opt--menu--area">
                        <div class="menu--pag--opt">
                            <a href="inicial.php" style="color: #fff;" class="active--tem img--opt-feed img--pag--inicial menu--pag--opt--section">
                                Pagina inicial
                            </a>
                            <a href=''class="img--opt-feed img--pag--jogos menu--pag--opt--section">
                                Jogos
                            </a>
                            <a href="" class="img--opt-feed img--pag--solic menu--pag--opt--section">
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
                                <div class="img--perfil menu--pag--img--area" style="background-image: url(../issets/imgs/profile/<?=$_SESSION['img']?>)"></div>
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
                <?php 
                if(!$postagens == ''){
                    foreach($postagens as $post_segui) {
                        $sql_s_perfil = 'SELECT * FROM users WHERE id_user='.$post_segui['user_publi'];
                        $res_s_perfil = mysqli_query($conexao, $sql_s_perfil);
                        $array_s_perfil = mysqli_fetch_assoc($res_s_perfil);
                ?>
                <div class="post--menu--area">
                    <div class="header--post--area">
                        <div class="post--area--perfil">
                            <div class="img--perfil menu--pag--img--area" style="background-image: url(../issets/imgs/profile/<?= $array_s_perfil['foto_perfil']?>);">

                            </div>
                            <div class="name--area">
                                <?php if($array_s_perfil['username'] == $_SESSION['username']) {?>
                                    <a class="perfil-link" href='perfil.php'>
                                <?php } else {?>        
                                    <a class="perfil-link" href="perfil_user_v.php?username=<?=$array_s_perfil['username']?>">
                                <?php }?>   
                                    <div class="name--name-perfil perfil-link-hover">
                                        <?=$array_s_perfil['nome'];?>
                                    </div>
                                    <div class="name--username-perfil perfil-link-hover">
                                        <?=$array_s_perfil['username'];?>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="post--area--date ">
                            <div class="date--post">
                                <?php 
                                    date_default_timezone_set('America/Sao_Paulo');
                                    date_default_timezone_get();
                                    $hoje = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
                                    $sla = $hoje-strtotime($post_segui['date_publi']);
                                    $secund = $sla/1000;
                                    $minutos = ($sla/60);
                                    $horas = $minutos/60;
                                    $dias = $horas/24;
                                    $meses = $dias/30.5;
                                    $anos = $dias/365.25;
                                    if(round($anos) > 0) {
                                        echo 'há <b>'.round($anos).' anos</b>';
                                    } elseif (round($meses) > 0){
                                        echo 'há <b>'.round($meses).' meses</b>';
                                    } elseif (round($dias) > 0) {
                                        echo 'há <b>'.round($dias).' dias</b>';
                                    } elseif (round($horas) > 0) {
                                        echo 'há <b>'.round($horas).' horas</b>';
                                    } elseif (round($minutos) > 0) {
                                        echo 'há <b>'.round($minutos).' minutos</b>';
                                    } else {
                                        echo '<b>agora</b>';
                                    }
                                ?>
                            </div>
                        </div>  
                        <div class="post--area--menu ">
                            <div class="elipse-img-hover elipse-img"></div>
                        </div>                                                              <!--deve ter o nome e @ do usuario e o menu de denuncia de cada usuario-->
                    </div>
                    <div class="body--post--area">
                        <?php if($post_segui['text_publi'] == ''){

                        } else {?>
                        <div class="post--text"><?=$post_segui['text_publi']?></div>
                        <?php } ?>
                        <?php if(!$post_segui['img_publi'] == ''){
                        ?>
                        <div class="post--img-area">
                            <div class="post--img" style='background-image:url(../issets/imgs/posts/<?=$post_segui['img_publi']?>);'>
                            </div>
                        </div>
                        <?php }?>                                          <!--deve ter oq o usuario publicou-->
                    </div>
                    <div class="interacao--post--area">
                        <div class="curtir interacao--area">
                            Curtir
                        </div>   
                        <div class="comentar interacao--area">
                            comentar
                        </div>
                        <div class="compartilhar interacao--area">
                            compartilhar
                        </div>                                                      <!--deve ter o curtir compartilhar e comentar-->
                    </div>
                </div>
                <?php  }} else {?>
                    <div class="title--empty">não há nada aqui por enquanto ;(</div>
                <?php } ?>
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
                <h1>gurizada online:</h1>

                <?php 
                $sql_user = 'SELECT nome, username FROM users WHERE status_ = 1';
                $resul = mysqli_query($conexao, $sql_user);
                $array_use = mysqli_fetch_all($resul,1);
                foreach($array_use as $user) {
                    echo $user['nome'].': '.$user['username'].'<br>';
                }
                ?>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../issets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/feed/script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/session_storage.js"></script>
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

    <!--<script>let a = true;setInterval(()=>{
        if(a == true){
        a = false;
        document.querySelector('.event').style.transform ='rotate(180deg)';
    } else {
        a = true;
        document.querySelector('.event').style.borderLeft='3px solid salmon';
        document.querySelector('.event').style.borderRight='3px solid salmon';
        document.querySelector('.event').style.transform ='rotate(-180deg)';
    }
    }, 500)</script>-->
</body>
</html>
<!-- <div class="event"></div>-!>