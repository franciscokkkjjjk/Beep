<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once '../assets/script/php/historico.php';    
require_once '../assets/script/php/conecta.php';
require_once '../assets/script/php/function/funcoes.php';
require_once '../assets/script/php/html__generic/suspenso_.php';

$sql = 'SELECT * FROM users WHERE id_user='.$_SESSION['id_user'];
$res_perfil = mysqli_query($conexao, $sql);
$array_info = mysqli_fetch_assoc($res_perfil);
$sql_posts = "SELECT * FROM publicacoes WHERE user_publi=".$_SESSION['id_user']." ORDER BY date_publi DESC ";
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
    <link rel="stylesheet" href="../assets/style/toca/style.css">
    <title><?= $_SESSION['nome']?> | Beep</title>
    <style>
        <?php 
            if(!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>
        .menu--pag--img--area {
            background-image: url('../assets/imgs/profile/<?=$_SESSION['img']?>');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
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
                <div class="menu--pag--button button--back">
                    <a href="inicial.php" class="seta--back"></a>
                </div>
                <div class="nome--perfil">
                    <?= $_SESSION['nome']?>
                </div>
            </div>
            <div class="feed-body-post">
               <div class="header--perfil--area">
                <div class="banner--perfil" style="<?php if(!$_SESSION['img_banner'] == NULL){?>background-image: url(../assets/imgs/profile/<?= $_SESSION['img_banner']?>);<?php }?>">

                </div>
                <div class="info--perfil">
                        <div class="info--perfil--area">
                            <div class="info--perfil--img">
                                <div class="info--perfil--img info--perfil--img--position menu--pag--img--area ">
                            
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
                                <div class="button--editar"></div>
                            </div>
                        </div>
                        <div class="info--bio--perfil">
                            <div class="bio">
                                <?=$_SESSION['bio_user']?>
                            </div>
                            <div class="data_nasc">
                                <?=date('d/m/Y', strtotime($_SESSION['data_nas']))?>
                            </div>
                            <div class="segui--indo">
                                <a class='seguidores--info area--segui'href="seguidore/seguindo.php"><span class="num_seguindo"><?=$array_info['t_seguindo']?></span> seguindo</a>
                                <a class='seguidor--info area--segui'href="seguidore/seguidores.php"><span class="num_seguidores"><?=$array_info['t_seguidores']?></span> seguidores</a>
                            </div>
                        </div>
                        <div class="menu--info--perfil--area">
                            <a class="button--opt--info active_menu_info">
                                Publicações
                            </a>
                            <a class="button--opt--info" href="perfilJogos.php">
                                Jogos do usuário                                
                            </a>
                            <a class="button--opt--info" href="curtidas.php">
                                Curtidas  
                            </a>    
                            <a class="button--opt--info">
                                Sobre                                
                            </a>
                        </div>
                </div>
               </div>
               <div class="posts--ara--perfil">
               <div class="back--event" style=" top:auto;    margin-top: 18px;">
                    <div class="event"></div>
                </div>
                <?php require_once '../assets/script/php/html__generic/posts_template.php';?>
                </div>
            </div>
        </div>
            <?php 
                require_once '../assets/script/php/html__generic/recomendado.php';
            ?>
        </div>
    </div>
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/scriptAll.js"></script>
    <script type ="text/javascript" src="../assets/script/javascript/default/coment-script.js"></script>
    <script>
          const username = <?php if(isset($_SESSION['error_username'])) { echo "'" . $_SESSION['username_temp'] . "'"; } else {echo '"'.$_SESSION['username'].'"';}?>;
    </script>
    <script type="text/javascript" src="../assets/script/javascript/default/posts/posts.js"></script>
    <script type="text/javascript">
        seguidores_session();
        user_session();
    </script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/toca/script.js"></script>
    <!--<script type="text/javascript" src="../assets/script/javascript/default/session_storage.js"></script>-->
    <script>
        const error_php = <?php if(isset($_SESSION['error_username'])) {echo $_SESSION['error_username'];} else {echo "''";} ?>;
        const nome = <?php echo '"'.$_SESSION['nome'].'"';?>;
        const email = <?php echo '"'.$_SESSION['email'].'"';?>;
        const img_perfil = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['img'].'"';} else {echo 'null';}?>;
        const img_banner = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['img_banner'].'"';} else{echo 'null';}?>;
        console.log(img_banner);
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
    <script>
        <?php 
            if(isset($_SESSION['functionPHPJS'])) {
                echo $_SESSION['functionPHPJS'];
                unset($_SESSION['functionPHPJS']);
                unset($_SESSION['username_temp']);
                unset($_SESSION['error_username']);
            }
        ?> 
    </script>
    <script src="../assets/script/javascript/default/jogos/game.js"></script>

    </body>
</html>