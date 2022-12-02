<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('location:../');
}
$perfil = $_GET['username'];
if ($perfil == '') {
    header('location:inicial.php');
}
require_once '../assets/script/php/historico.php';
require_once '../assets/script/php/conecta.php';
require_once '../assets/script/php/function/funcoes.php';
require_once '../assets/script/php/html__generic/suspenso_.php';


if ($perfil == $_SESSION['username']) {
    header('location:perfil.php');
}
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
    <title><?= $perfil ?>(Perfil) | Beep</title>
    <style>
        <?php
        if (!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>.menu--pag--img--area {
            background-image: url('../assets/imgs/profile/<?= $_SESSION['img'] ?>');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        <?php } else { ?>.menu--pag--img--area {
            background-image: url('../assets/imgs/default/perfil-de-usuario-black.png');
        }

        <?php } ?>.fot_user_visit {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }
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
                    <div class="event"></div>
                </div>
            </div>
            <div class="feed-body-post">
                <div class="banner--perfil">
                    <div class="event"></div>
                </div>
               <?php 
                require_once '../assets/script/php/html__generic/user_v_generic.php';
               ?>

                <div class="posts--ara--perfil">
                <div class="title_">Redes Sociais</div>
                    <div class="area_sobre">
                        <?php
                        require_once '../assets/script/php/conect_pdo.php';
                        $id_user = $pdo->real_escape_string($_GET['username']);
                        $sql_user = $pdo->query("SELECT * FROM users WHERE username='". $id_user."'")->fetch_assoc();
                        $sql_redes = $pdo->query("SELECT * FROM sobre WHERE id_user=" . $sql_user['id_user'])->fetch_all(1);
                        if (is_null($sql_redes) or empty($sql_redes)) {
                            ?>
                            <div class="nada" style="text-align: center; width: 100%;">Esse usuário não adicionou redes sociais.</div>
                            <?php
                        } else {
                            foreach ($sql_redes as $sql_redes) {
                        ?>
                       
                            <a target="_blank" href="<?= $sql_redes['username_rede'] ?>" class="rede<?= $sql_redes['type_r'] ?> redes_"> <?= $sql_redes['username_txt'] ?> </a>
                        
                        <?php
                            }
                        }
                            ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require_once '../assets/script/php/html__generic/recomendado.php';
        ?>
    </div>
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/coment-script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/posts/posts.js"></script>
    <script type="text/javascript">
        user_(false);
    </script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/toca/script.js"></script>
    <!--<script type="text/javascript" src="../assets/script/javascript/default/session_storage.js"></script>-->
    <script>
        const nome = <?php echo '"' . $_SESSION['nome'] . '"'; ?>;
        const email = <?php echo '"' . $_SESSION['email'] . '"'; ?>;
        const username = <?php echo '"' . $_SESSION['username'] . '"'; ?>;
        const img_perfil = <?php if (isset($_SESSION['img'])) {
                                echo '"' . $_SESSION['img'] . '"';
                            } else {
                                echo 'null';
                            } ?>;
        const banner_pefil = <?php if (isset($_SESSION['banner_pefil'])) {
                                    echo '"' . $_SESSION['banner_pefil'] . '"';
                                } else {
                                    echo 'null';
                                } ?>;
        const bio = <?php echo '`' . $_SESSION['bio_user'] . '`'; ?>;
        const dateC = <?php echo '"' . date('d/m/Y', strtotime($_SESSION['data_nas'])) . '"'; ?>;
        const m_nas = <?php echo '"' . date('m', strtotime($_SESSION['data_nas'])) . '"'; ?>;
        const d_nas = <?php echo '"' . date('d', strtotime($_SESSION['data_nas'])) . '"'; ?>;
        const y_nas = <?php echo '"' . date('Y', strtotime($_SESSION['data_nas'])) . '"'; ?>;
    </script>

    <script src="../assets/script/javascript/default/edit_form.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/form_creat.js"></script>
    <script src="../assets/script/javascript/default/jogos/game.js"></script>
    <script src="../assets/script/javascript/toca/script_user_denuncia.js"></script>
</body>

</html>