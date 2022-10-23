<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once '../../assets/script/php/conecta.php';
require_once '../../assets/script/php/function/funcoes.php';
$user_vist = isset($_GET['id_user']);
if($user_vist) {
    $sql_pag_anterior = 'SELECT username FROM users WHERE id_user='.$_GET['id_user'];
} else {
    $sql_pag_anterior = 'SELECT username FROM users WHERE id_user='.$_SESSION['id_user'];
}
$resultado_anterior = mysqli_query($conexao, $sql_pag_anterior);
$array_anterior = mysqli_fetch_assoc($resultado_anterior);
if(!$user_vist) {
    $atual = $_SESSION['id_user'];
    $sql_seguindo = "SELECT * FROM users WHERE id_user IN (SELECT user_seguin FROM seguidores WHERE user_seguido=".$_SESSION['id_user'].")";
    $res_seguindo = mysqli_query($conexao, $sql_seguindo);
    $seguindo = mysqli_fetch_all($res_seguindo,1);
} else {
    $atual = $_GET['id_user'];
    $sql_seguindo = "SELECT * FROM users WHERE id_user IN (SELECT user_seguin FROM seguidores WHERE user_seguido=".$_GET['id_user'].")";
    $res_seguindo = mysqli_query($conexao, $sql_seguindo);
    $seguindo = mysqli_fetch_all($res_seguindo,1);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../../assets/imgs/default/beep_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/style/generic/style.css">
    <link rel="stylesheet" href="../../assets/style/feed/style.css">
    <link rel="stylesheet" href="../../assets/style/toca/style.css">
    <link rel="stylesheet" href="../../assets/style/toca/list_seg.css">
    <title>Seguidores | Beep</title>
    <style>
        <?php 
            if(!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>
        .menu--pag--img--area {
            background-image: url('../../assets/imgs/profile/<?=$_SESSION['img']?>');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
        <?php } else { ?>
            .menu--pag--img--area {
            background-image: url('../../assets/imgs/default/perfil-de-usuario-black.png');
        }
        <?php }?>
        
    </style>
</head>
<body>
    <div class="feed-area">
        <?php 
            require_once '../../assets/script/php/html__generic/nav_menu.php';
        ?>
        <div class="timeline--area">
            <div class="feed-header-body">
                <div class="menu--pag--button button--back">
                    <a href="../perfil_user_v.php?username=<?= $array_anterior['username']?>" class="seta--back"></a>
                </div>
                <div class="nome--perfil">
                    Seguidores
                </div>
            </div>
            <div class="feed-body-post">
                <?php foreach($seguindo as $array_s_perfil) { if($array_s_perfil['id_user'] == $atual){} else{?>
                <div class="area--seguindo">
                    <div class="area--seguindo-0">
                            <div class="name--area">
                                    <div class="img--perfil--seguir">
                                        <div class="img_segui" style="<?= perfilDefault($array_s_perfil['foto_perfil'],'a')?>"></div>
                                    </div>     
                                    <a class="perfil-link" href="../perfil_user_v.php?username=<?=$array_s_perfil['username']?>">
                                    <div class="name--name-perfil perfil-link-hover">
                                        <?=$array_s_perfil['nome'];?>
                                    </div>
                                    <div class="name--username-perfil perfil-link-hover">
                                        <?=$array_s_perfil['username'];?>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="area--seguindo-1">

                        </div>
                    </div>
                    <?php }}?>
               </div>
            </div>
            <?php 
                require_once '../../assets/script/php/html__generic/recomendado.php';
            ?>
    </div>
    
    <script type="text/javascript" src="../../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/toca/script.js"></script>
    <!--<script type="text/javascript" src="../assets/script/javascript/default/session_storage.js"></script>-->
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
    
    <script src="../../assets/script/javascript/default/edit_form.js">
    </script>
    <script type="text/javascript" src="../../assets/script/javascript/default/form_creat.js">
    </script>
</body>
</html>