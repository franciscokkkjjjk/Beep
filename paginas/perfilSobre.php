<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once '../assets/script/php/historico.php';
require_once '../assets/script/php/conect_pdo.php';
require_once '../assets/script/php/conecta.php';
require_once '../assets/script/php/function/funcoes.php';
require_once '../assets/script/php/html__generic/suspenso_.php';

$sql = 'SELECT * FROM users WHERE id_user=' . $_SESSION['id_user'];
$res_perfil = mysqli_query($conexao, $sql);
$array_info = mysqli_fetch_assoc($res_perfil);
$sql_posts = "SELECT * FROM publicacoes WHERE user_publi=" . $_SESSION['id_user'] . " ORDER BY date_publi DESC ";
$res_posts = mysqli_query($conexao, $sql_posts);
$postagens = mysqli_fetch_all($res_posts, 1);
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/imgs/default/beep_logo.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/feed/style.css">
    <link rel="stylesheet" href="../assets/style/toca/style.css">
    <title>
        <?= $_SESSION['nome'] ?> (<?= $_SESSION['username'] ?>)| Beep
    </title>
    <style>
        <?php if (!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>.menu--pag--img--area {
                background-image: url('../assets/imgs/profile/<?= $_SESSION['img'] ?>');
                background-position: center;
                background-size: cover;
                background-repeat: no-repeat;
            }

            <?php
        } else {
            ?>.menu--pag--img--area {
                background-image: url('../assets/imgs/default/perfil-de-usuario-black.png');
            }

            <?php
        }

        ?>?>
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
                    <?= $_SESSION['nome'] ?>
                </div>
            </div>
            <div class="feed-body-post">
                <div class="header--perfil--area">
                    <div class="banner--perfil"
                        style="<?php if (!$_SESSION['img_banner'] == NULL) { ?>background-image: url(../assets/imgs/profile/<?= $_SESSION['img_banner'] ?>);<?php } ?>">

                    </div>
                    <div class="info--perfil">
                        <div class="info--perfil--area">
                            <div class="info--perfil--img">
                                <div class="info--perfil--img info--perfil--img--position menu--pag--img--area ">

                                </div>
                            </div>
                            <div class="info--perfil--user">
                                <div class="info--perfil--user--nome">
                                    <?= $_SESSION['nome']; ?>
                                </div>
                                <div class="info--perfil--user--username">
                                    <?= $_SESSION['username']; ?>
                                </div>
                            </div>
                            <div class="info--button">
                                <div class="button--editar"></div>
                            </div>
                        </div>
                        <div class="info--bio--perfil">
                            <div class="bio">
                                <?= $_SESSION['bio_user'] ?>
                            </div>
                            <div class="data_nasc">
                                <?= date('d /m/Y', strtotime($_SESSION['data_nas'])) ?>
                            </div>
                            <div class="segui--indo">
                                <a class='seguidores--info area--segui' href="seguindo.php"><span class="num_seguindo">
                                        <?= $array_info['t_seguindo'] ?>
                                    </span> seguindo</a>
                                <a class='seguidor--info area--segui' href="seguidores.php"><span
                                        class="num_seguidores">
                                        <?= $array_info['t_seguidores'] ?>
                                    </span> seguidores</a>
                            </div>
                        </div>
                        <div class="menu--info--perfil--area">
                            <a class="button--opt--info" href="perfil.php">
                                Publicações
                            </a>
                            <a class="button--opt--info" href="perfilJogos.php">
                                Jogos do usuário
                            </a>
                            <a class="button--opt--info" href="curtidas.php">
                                Curtidas
                            </a>
                            <a href="perfilSobre.php" class="button--opt--info active_menu_info">
                                Sobre
                            </a>
                        </div>
                    </div>
                </div>
                <div class="posts--ara--perfil">
                    <div class="title_">Redes Sociais</div>
                    <div class="area_sobre">
                        <?php
                        $sql_redes = $pdo->query("SELECT * FROM sobre WHERE id_user=" . $_SESSION['id_user'])->fetch_all(1);
                        if (is_null($sql_redes) or empty($sql_redes)) {

                        } else {
                            foreach ($sql_redes as $sql_redes) {
                        ?>
                        <div class="rede_area">
                            <a target="_blank" href="<?= $sql_redes['username_rede'] ?>" class="rede<?= $sql_redes['type_r'] ?> redes_"> <?= $sql_redes['username_txt'] ?> </a>
                            <a href="" class="button_remove" id='<?="x_".$sql_redes['username_txt']."_".$sql_redes['type_r']?>'>Remover</a>
                        </div>
                        <?php
                            }
                        }
                            ?>
                    </div>
                    <a href="" class="button_area_add_rede button_area_add_link">
                        Adicionar rede social
                    </a>
                </div>
            </div>
            <div class="moda_fast" style="display: none; opacity: 0;">
                <div class="exit_mopda_fast exit_event_rede"></div>
                <div class="modal_fast_body">
                    <form class="form_input" action="#" method="POST">
                        <div class="header-coment">

                            <div class="modal_fast_exit1 exit_event_rede">
                                <div class="menu--exit-img"></div>
                            </div>
                            <div class="name--text-coment">
                                Adicionar rede social
                            </div>
                            <button class="button--postar-rede button-remove">Adiconar</button>
                        </div>
                        <div class="area_inputs">
                            <select name="rede_a">
                                <option value="3">Facebook</option>
                                <option value="2">Instagram</option>
                                <option value="4">Steam</option>
                                <option value="1">Twitter</option>
                            </select>
                            <input type="text" required placeholder="Nome de usuário" value="" name="username_rede">
                        </div>
                    </form>
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
    <script type="text/javascript" src="../assets/script/javascript/default/coment-script.js"></script>
    <script>
        const username = <?php if (isset($_SESSION[' error_username '])) {
          echo "'" . $_SESSION[' username_temp '] . "'";
      } else {
          echo '"' .$_SESSION[' username ']. '"';
      } ?>;
    </script>
    <script type="text/javascript" src="../assets/script/javascript/default/posts/posts.js"></script>
    <script type="text/javascript">

    </script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/toca/script.js"></script>
    <!--<script type="text/javascript" src="../assets/script/javascript/default/session_storage.js"></script>-->
    <script>
        const error_php = <?php if (isset($_SESSION[' error_username '])) {
            echo $_SESSION[' error_username '];
        } else {
            echo "''";
        } ?>;
        const nome = <?php echo '"' .$_SESSION[' nome ']. '"'; ?>;
        const email = <?php echo '"' .$_SESSION[' email ']. '"'; ?>;
        const img_perfil = <?php if (isset($_SESSION[' img '])) {
            echo '"' .$_SESSION[' img ']. '"';
        } else {
            echo ' null ';
        } ?>;
        const img_banner = <?php if (isset($_SESSION[' img '])) {
            echo '"' .$_SESSION[' img_banner ']. '"';
        } else {
            echo ' null ';
        } ?>;
        console.log(img_banner);
        const bio = <?php echo '`' . $_SESSION['bio_user'] . '` '; ?>;
        const dateC = <?php echo '"' .date('d / m / Y ', strtotime($_SESSION[' data_nas '])). '"'; ?>;
        const m_nas = <?php echo '"' .date('m ', strtotime($_SESSION[' data_nas '])). '"'; ?>;
        const d_nas = <?php echo '"' .date('d ', strtotime($_SESSION[' data_nas '])). '"'; ?>;
        const y_nas = <?php echo '"' .date('Y ', strtotime($_SESSION[' data_nas '])). '"'; ?>;

    </script>

    <script src="../assets/script/javascript/default/edit_form.js">
    </script>
    <script type="text/javascript" src="../assets/script/javascript/default/form_creat.js">
    </script>
    <script>
        <?php
        if(isset($_SESSION[' functionPHPJS '])) {
            echo $_SESSION[' functionPHPJS '];
                unset($_SESSION[' functionPHPJS ']);
                unset($_SESSION[' username_temp ']);
                unset($_SESSION[' error_username ']);
            }
        ?> 
    </script>
    <script src="../assets/script/javascript/default/jogos/game.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/toca/script_rede.js"></script>

</body>

</html>