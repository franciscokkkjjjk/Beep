<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
$perfil = $_GET['username'];
if($perfil == '') {
    header('location:inicial.php');
}
require_once '../issets/script/php/historico.php';    
require_once '../issets/script/php/conecta.php';
$sql_perfil = "SELECT * FROM users WHERE username='$perfil'";
$res_perfil = mysqli_query($conexao, $sql_perfil);
$array_info = mysqli_fetch_assoc($res_perfil);
if($array_info == '') {
    header('location:inicial.php');
}
$sql_posts = "SELECT * FROM publicacoes WHERE user_publi=".$array_info['id_user']." ORDER BY date_publi DESC ";
$res_posts = mysqli_query($conexao,$sql_posts);
$postagens = mysqli_fetch_all($res_posts,1);
$sql_seguir = 'SELECT * FROM seguidores WHERE user_seguin='.$_SESSION['id_user'];
$res_seguir = mysqli_query($conexao, $sql_seguir);
$array_seguidor = mysqli_fetch_all($res_seguir, 1);
$seguindo = false;
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
    <title><?= $array_info['nome']?> | Beep</title>
    <style>
        <?php 
            if(!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>
        .menu--pag--img--area {
            background-image: url('../issets/imgs/profile/<?=$_SESSION['img']?>');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        <?php } else { ?>
            .menu--pag--img--area {
            background-image: url('../issets/imgs/default/perfil-de-usuario-black.png');
        }
        <?php }?>
        <?php 
            if(!$array_info['foto_perfil'] == '' and !$array_info['foto_perfil'] == null) {
        ?>
        .fot_user_visit {
            background-image: url('../issets/imgs/profile/<?=$array_info['foto_perfil']?>');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        <?php } else { ?>
            .fot_user_visit {
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
                        <a href="inicial.php">
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
                <div class="menu--pag--button button--back">
                    <a href="inicial.php" class="seta--back"></a>
                </div>
                <div class="nome--perfil">
                    <?= $array_info['nome']?>
                </div>
            </div>
            <div class="feed-body-post">
                <div class="banner--perfil" style="<?php if(!$array_info['banner_pefil'] == NULL){?>background-image: url(../issets/imgs/profile/<?= $array_info['banner_pefil']?>);<?php }?>">
                </div>
                <div class="info--perfil">
                        <div class="info--perfil--area">
                            <div class="info--perfil--img">
                                <div class="fot_user_visit info--perfil--img--position menu--pag--img--area ">
                            
                                </div>
                            </div>
                            <div class="info--perfil--user">
                                <div class="info--perfil--user--nome">
                                    <?=$array_info['nome'];?>
                                </div>
                                <div class="info--perfil--user--username">
                                    <?=$array_info['username'];?>
                                </div>
                            </div>
                            <div class="info--button">
                                <?php foreach($array_seguidor as $value_seguir) {
                                        if($value_seguir['user_seguido'] == $array_info['id_user']) { $seguindo = true;
                                    ?>
                                    <form action="../issets/script/php/" method="post">
                                        <button class="button--seguindo button-remove curso-pointer"></button>
                                <?php }} if(!$seguindo) {?>
                                    <form action="../issets/script/php/seguir.php" method="post">
                                        <button class="button--seguir button-remove curso-pointer"></button>
                                    
                                <?php }?>
                                    <input type="hidden" value="<?= $array_info['id_user']?>" name='iD_x30'>
                                    </form>
                            </div>
                        </div>
                        <div class="info--bio--perfil">
                            <div class="bio">
                                <?=$array_info['bio']?>
                            </div>
                            <div class="data_nasc">
                                <?=date('d/m/Y', strtotime($array_info['data_nas']))?>
                            </div>
                            <div class="segui--indo">
                                <a class='seguidores--info area--segui'href=""><span><?=$array_info['t_seguindo']?></span> seguindo</a>
                                <a class='seguidor--info area--segui'href=""><span><?=$array_info['t_seguidores']?></span> seguidores</a>
                            </div>
                        </div>
                        <div class="menu--info--perfil--area">
                            <a class="button--opt--info active_menu_info">
                                Publicações
                            </a>
                            <a class="button--opt--info">
                                Jogos do usuario                                
                            </a>
                            <a class="button--opt--info">
                                Curtidas  
                            </a>    
                            <a class="button--opt--info">
                                Sobre                                
                            </a>
                        </div>
                    </div>
                
                <div class="posts--ara--perfil">
                <?php foreach($postagens as $post_segui){?>
                        <div class="post--menu--area">
                        <div class="header--post--area">
                            <div class="post--area--perfil">
                                <div class="img--perfil menu--pag--img--area" style="background-image: url(../issets/imgs/profile/<?= $array_info['foto_perfil']?>);">

                                </div>
                                <div class="name--area">
                                        <div class="name--name-perfil">
                                            <?=$array_info['nome'];?>
                                        </div>
                                        <div class="name--username-perfil">
                                            <?=$array_info['username'];?>
                                        </div>
                                </div>
                            </div>
                            <div class="post--area--date">
                                <div class="date--post">
                                    <?php 
                                        date_default_timezone_set('America/Sao_Paulo');
                                        date_default_timezone_get();
                                        $hoje = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
                                        $sla = $hoje-strtotime($post_segui['date_publi']);
                                        $secund = $sla/60;
                                        $minutos = ($sla/60)-182;
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
                    <?php }?>
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
                <h1>gurizada online:</h1>

                <?php 
                $sql_user = 'SELECT nome, username FROM users WHERE status_ = 1';
                $resul = mysqli_query($conexao,$sql_user);
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
    <script type="text/javascript" src="../issets/script/javascript/toca/script.js"></script>
    <!--<script type="text/javascript" src="../issets/script/javascript/default/session_storage.js"></script>-->
    <script>
        const nome = <?php echo '"'.$_SESSION['nome'].'"';?>;
        const email = <?php echo '"'.$_SESSION['email'].'"';?>;
        const username = <?php echo '"'.$_SESSION['username'].'"';?>;
        const img_perfil = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['img'].'"';} else {echo 'null';}?>;
        const banner_pefil = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['banner_pefil'].'"';} else{echo 'null';}?>;
        const bio = <?php echo '"'.$_SESSION['bio_user'].'"';?>;
        const dateC = <?php echo '"'.date('d/m/Y', strtotime($_SESSION['data_nas'])).'"';?>;
        const m_nas = <?php echo '"'.date('m', strtotime($_SESSION['data_nas'])).'"';?>;
        const d_nas = <?php echo '"'.date('d', strtotime($_SESSION['data_nas'])).'"';?>;
        const y_nas = <?php echo '"'.date('Y', strtotime($_SESSION['data_nas'])).'"';?>;
    </script>
    
    <script src="../issets/script/javascript/default/edit_form.js">
    </script>
    <script type="text/javascript" src="../issets/script/javascript/default/form_creat.js">
    </script>
</body>
</html>