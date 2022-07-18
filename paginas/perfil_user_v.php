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
require_once '../issets/script/php/function/funcoes.php';


if($perfil == $_SESSION['username']) {
    header('location:perfil.php');
}
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
    <link rel="stylesheet" href="../issets/style/toca/style.css">
    <title><?= $perfil?> | Beep</title>
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
        .fot_user_visit {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
    </style>
</head>
<body>
    <div class="feed-area">
        <?php 
            require_once '../issets/script/php/html__generic/nav_menu.php';
        ?>
        <div class="timeline--area">
            <div class="feed-header-body">
                <div class="menu--pag--button button--back">
                    <a href="inicial.php" class="seta--back"></a>
                </div>
                <div class="nome--perfil">
                    <div class="event"></div>
                </div>
            </div>
            <div class="feed-body-post">
                <div class="banner--perfil" >
                    <div class="event"></div>
                </div>
                <div class="info--perfil">
                        <div class="info--perfil--area">
                            <div class="info--perfil--img">
                                <div class="fot_user_visit info--perfil--img--position ">
                                     <div class="event" style="position:absolute; margin-top: 56px;margin-left: 59px;"></div>
                                </div>
                            </div>
                            <div class="info--perfil--user">
                                <div class="info--perfil--user--nome">
                                    <div class="event"></div>
                                </div>
                                <div class="info--perfil--user--username">
                                
                                </div>
                            </div>
                            <div class="info--button">
                                    <form  method="post" class="form_id_x30">
                                        <div class="event"></div>
                                    <input type="hidden" value="" name='iD_x30' class="input_segui_id_x30">
                                    </form>
                            </div>
                        </div>
                        <div class="info--bio--perfil">
                            <div class="bio">
                                <div class="event"></div>
                            </div>
                            <div class="data_nasc">
                                <div class="event"></div>
                            </div>
                            <div class="segui--indo">
                                <a class='seguidores--info area--segui'href="seguidore/seguindo.php?id_user="><span class="num_seguindo"></span> seguindo</a>
                                <a class='seguidor--info area--segui'href="seguidore/seguidores.php?id_user="><span class="num_seguidores"></span> seguidores</a>
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
                <div class="back--event" style="position:fixed; top:auto;bottom:5%;">
                    <div class="event"></div>
                </div>
                <?php require_once '../issets/script/php/html__generic/posts_template.php';?>
                </div>
            </div>
            
          </div>
        
          <?php 
                require_once '../issets/script/php/html__generic/recomendado.php';
            ?>
    </div>
    <script type="text/javascript" src="../issets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/posts/posts.js"></script>
    <script type="text/javascript">
        user_();
    </script>
    <script type="text/javascript" src="../issets/script/javascript/default/perfil_vist/perfil_users.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/toca/script.js"></script>
    <!--<script type="text/javascript" src="../issets/script/javascript/default/session_storage.js"></script>-->
    <script>
        const nome = <?php echo '"'.$_SESSION['nome'].'"';?>;
        const email = <?php echo '"'.$_SESSION['email'].'"';?>;
        const username = <?php echo '"'.$_SESSION['username'].'"';?>;
        const img_perfil = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['img'].'"';} else {echo 'null';}?>;
        const banner_pefil = <?php if(isset($_SESSION['banner_pefil'])){echo '"'.$_SESSION['banner_pefil'].'"';} else{echo 'null';}?>;
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
    <script type="text/javascript" src="../issets/script/javascript/default/creat_modal_img.js"></script>
    <script type="text/javascript">
        document.querySelector('.button--seguindo').addEventListener('click', (e)=>{
            e.preventDefault();
            if(confirm('deseja mesmo parar de seguir esse usuário?')){
                document.querySelector('.submit--form').submit();
            }
        }, true)
    </script>            
</body>
</html>