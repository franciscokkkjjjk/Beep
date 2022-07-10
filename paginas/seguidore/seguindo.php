<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once '../../issets/script/php/historico.php';    
require_once '../../issets/script/php/conecta.php';
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
    <link rel="icon" href="../../issets/imgs/default/Letra-B-PNG-1.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../issets/style/generic/style.css">
    <link rel="stylesheet" href="../../issets/style/feed/style.css">
    <link rel="stylesheet" href="../../issets/style/toca/style.css">
    <title><?= $_SESSION['nome']?> | Beep</title>
    <style>
        <?php 
            if(!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>
        .menu--pag--img--area {
            background-image: url('../../issets/imgs/profile/<?=$_SESSION['img']?>');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        <?php } else { ?>
            .menu--pag--img--area {
            background-image: url('../../issets/imgs/default/perfil-de-usuario-black.png');
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
                            <img src="../../issets/imgs/default/Letra-B-PNG-1.png">
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
                            <a href="../inicial.php" style="color: #fff;" class="img--opt-feed img--pag--inicial menu--pag--opt--section">
                                Pagina inicial
                            </a>
                            <a href=''class="img--opt-feed img--pag--jogos menu--pag--opt--section">
                                Jogos
                            </a>
                            <a href="" class="img--opt-feed img--pag--solic menu--pag--opt--section">
                              Solicitar jogo
                            </a>
                            <a href="../perfil.php" class="img--opt-feed img--pag--perf menu--pag--opt--section">
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
                    <a href="<?php if(!$pag_anterior == ''){echo $pag_anterior;} else {echo 'inicial.php';}?>" class="seta--back"></a>
                </div>
                <div class="nome--perfil">
                    Seguindo
                </div>
            </div>
            <div class="feed-body-post">
               
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
                    <a href='../../issets/script/php/logout.php' class="opt--menu-header">
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
    
    <script type="text/javascript" src="../../issets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../../issets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../../issets/script/javascript/toca/script.js"></script>
    <!--<script type="text/javascript" src="../issets/script/javascript/default/session_storage.js"></script>-->
    <script>
        const nome = <?php echo '"'.$_SESSION['nome'].'"';?>;
        const email = <?php echo '"'.$_SESSION['email'].'"';?>;
        const username = <?php echo '"'.$_SESSION['username'].'"';?>;
        const img_perfil = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['img'].'"';} else {echo 'null';}?>;
        const img_banner = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['img_banner'].'"';} else{echo 'null';}?>;
        const bio = <?php echo '"'.$_SESSION['bio_user'].'"';?>;
        const dateC = <?php echo '"'.date('d/m/Y', strtotime($_SESSION['data_nas'])).'"';?>;
        const m_nas = <?php echo '"'.date('m', strtotime($_SESSION['data_nas'])).'"';?>;
        const d_nas = <?php echo '"'.date('d', strtotime($_SESSION['data_nas'])).'"';?>;
        const y_nas = <?php echo '"'.date('Y', strtotime($_SESSION['data_nas'])).'"';?>;
    </script>
    
    <script src="../../issets/script/javascript/default/edit_form.js">
    </script>
    <script type="text/javascript" src="../../issets/script/javascript/default/form_creat.js">
    </script>
</body>
</html>