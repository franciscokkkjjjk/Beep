<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header('location:../');
}
require_once '../assets/script/php/historico.php';
require_once '../assets/script/php/conecta.php';
require_once '../assets/script/php/function/funcoes.php';
require_once '../assets/script/php/html__generic/suspenso_.php';

$sql_posts = "SELECT * FROM publicacoes WHERE user_publi IN (SELECT user_seguido FROM seguidores WHERE user_seguin=" . $_SESSION['id_user'] . ") ORDER BY date_publi DESC ";
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
    <title>Pagina inicial | Beep</title>
    <style>
        <?php if (!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>.menu--pag--img--area {
                background-image: url('../assets/imgs/profile/<?= $_SESSION['img'] ?>')
            }

            <?php
        } else {
            ?>.menu--pag--img--area {
                background-image: url('../assets/imgs/default/perfil-de-usuario-black.png');
            }

            <?php
        }

        ?>
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
                    Recomendados
                </h1>
            </div>
            <div class="feed-body-post" style="color:#fff;">
                <?php
                $sql_seguidores_user = "SELECT * 
                                        FROM users 
                                        WHERE id_user 
                                        IN (
                                            SELECT seguidores.user_seguido 
                                            FROM seguidores 
                                            WHERE user_seguin=" . $_SESSION['id_user'] . " AND seguidores.user_seguido <> " . $_SESSION['id_user'] . "
                                            )
                                            ORDER BY RAND()";
                $sql_seguidores_seguidores = "SELECT * FROM users WHERE id_user IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin = " . $_SESSION['id_user'] . " AND seguidores.user_seguido <> " . $_SESSION['id_user'] . ") AND seguidores.user_seguido <> " . $_SESSION['id_user'] . ") AND id_user <> " . $_SESSION['id_user'] . " ORDER BY RAND()";
                $all_users = 'SELECT * FROM users WHERE id_user <> ' . $_SESSION['id_user'] . ' ORDER BY t_seguidores DESC';

                $resul_seguidores_seguidores = mysqli_query($conexao, $sql_seguidores_seguidores);
                $array_seguidores_seguidores = mysqli_fetch_all($resul_seguidores_seguidores, 1);

                $resul_all_users = mysqli_query($conexao, $all_users);
                $array_all_users = mysqli_fetch_all($resul_all_users, 1);

                $resul_seguidores_user = mysqli_query($conexao, $sql_seguidores_user);
                $array_seguidores_user = mysqli_fetch_all($resul_seguidores_user, 1);


                $array_ante = array();
                $quantidade = 0;
                foreach ($array_seguidores_seguidores as $value01) {
                    $seguindo = false;
                    if ($quantidade <= 40) {
                        foreach ($array_seguidores_user as $value02) {
                            if ($value01['username'] == $value02['username']) {
                                $seguindo = true;
                            }
                        }

                        if (!$seguindo) {
                ?>
                <div class="opt--recomedado--area">
                    <div class="perfil--area">
                        <div class="img--perfil menu--pag--img--area area--recomendado"
                            style="<?= perfilDefault($value01['foto_perfil'], pagAtual('caminho')) ?>">
                        </div>
                        <div class="name--area">
                            <a class="perfil-link"
                                href="<?= pagAtual('caminho'); ?>perfil_user_v.php?username=<?= $value01['username'] ?>">
                                <div class="name--name-perfil perfil-link-hover">
                                    <?= $value01['nome'] ?>
                                </div>
                                <div class="name--username-perfil perfil-link-hover">
                                    <?= $value01['username'] ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="buttom-recomendado-area">
                        <div class="buttom--body">
                            <form action="<?= pagAtual('caminho'); ?>../assets/script/php/seguir.php" method="post">
                                <button type="submit" class="button--seguir"></button>
                                <input type="hidden" value="<?= $value01['id_user'] ?>" name="iD_x30">
                            </form>
                        </div>
                    </div>
                </div>
                <?php
                            $quantidade++;
                            $array_ante[]['username'] = $value01['username'];
                ?>
                <?php }
                    }
                }
                foreach ($array_all_users as $value03) {
                    if ($quantidade <= 40) {
                        $seguindo_01 = false;
                        $aux = $value03['username'];
                        foreach ($array_ante as $value04) {
                            if ($value04['username'] == $aux) {
                                $seguindo_01 = true;
                            }
                        }
                        foreach ($array_seguidores_user as $v_aux) {
                            if ($v_aux['username'] == $aux) {
                                $seguindo_01 = true;
                            }
                        }

                        if (!$seguindo_01) { ?>
                <div class="opt--recomedado--area">
                    <div class="perfil--area">
                        <div class="img--perfil menu--pag--img--area area--recomendado"
                            style="<?= perfilDefault($value03['foto_perfil'], pagAtual('caminho')) ?>">
                        </div>

                        <div class="name--area">
                            <a class="perfil-link"
                                href="<?= pagAtual('caminho'); ?>perfil_user_v.php?username=<?= $value03['username'] ?>">
                                <div class="name--name-perfil perfil-link-hover">
                                    <?= $value03['nome'] ?>
                                </div>
                                <div class="name--username-perfil perfil-link-hover">
                                    <?= $value03['username'] ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="buttom-recomendado-area">
                        <div class="buttom--body">
                            <form action="../assets/script/php/seguir.php" method="post">
                                <button type="submit" class="button--seguir"></button>
                                <input type="hidden" value="<?= $value03['id_user'] ?>" name="iD_x30">
                            </form>
                        </div>
                    </div>
                </div>
                <?php $quantidade++;
                        }
                    }
                }
                if ($quantidade == 0) {
                    foreach ($array_all_users as $value05) {
                        if ($quantidade <= 40) {
                            $sql_user = "SELECT t_seguindo FROM users WHERE id_user=" . $_SESSION['id_user'];
                            $res_query_user = mysqli_query($conexao, $sql_user);
                            $array_query_user = mysqli_fetch_array($res_query_user);
                            $total = $array_query_user[0];
                            if ($total == 0) { ?>
                <div class="opt--recomedado--area">
                    <div class="perfil--area">
                        <div class="img--perfil menu--pag--img--area area--recomendado"
                            style="<?= perfilDefault($value05['foto_perfil'], pagAtual('caminho')) ?>">
                        </div>
                        <div class="name--area">
                            <a class="perfil-link"
                                href="<?= pagAtual('caminho'); ?>perfil_user_v.php?username=<?= $value05['username'] ?>">
                                <div class="name--name-perfil perfil-link-hover">
                                    <?= $value05['nome'] ?>
                                </div>
                                <div class="name--username-perfil perfil-link-hover">
                                    <?= $value05['username'] ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="buttom-recomendado-area">
                        <div class="buttom--body">
                            <form action="../assets/script/php/seguir.php" method="post">
                                <button type="submit" class="button--seguir"></button>
                                <input type="hidden" value="<?= $value05['id_user'] ?>" name="iD_x30">
                            </form>
                        </div>
                    </div>
                </div>
                <?php $quantidade++;
                            } else {
                                $seguindo = false;
                                foreach ($array_seguidores_user as $value06) {
                                    if ($value05['username'] == $value06['username']) {
                                        $seguindo = true;
                                    }
                                }
                                if (!$seguindo) { ?>
                <div class="opt--recomedado--area">
                    <div class="perfil--area">
                        <div class="img--perfil menu--pag--img--area area--recomendado"
                            style="<?= perfilDefault($value05['foto_perfil'], pagAtual('caminho')) ?>">
                        </div>
                        <div class="name--area">
                            <a class="perfil-link"
                                href="<?= pagAtual('caminho'); ?>perfil_user_v.php?username=<?= $value05['username'] ?>">
                                <div class="name--name-perfil perfil-link-hover">
                                    <?= $value05['nome'] ?>
                                </div>
                                <div class="name--username-perfil perfil-link-hover">
                                    <?= $value05['username'] ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="buttom-recomendado-area">
                        <div class="buttom--body">
                            <form action="../assets/script/php/seguir.php" method="post">
                                <button type="submit" class="button--seguir"></button>
                                <input type="hidden" value="<?= $value05['id_user'] ?>" name="iD_x30">
                            </form>
                        </div>
                    </div>
                </div>
                <?php $quantidade++;
                                }
                            }
                        }
                    }
                }

                ?>
            </div>
        </div>
        <?php
        require_once '../assets/script/php/html__generic/recomendado.php';
        ?>
    </div>
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/coment-script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/posts/posts.js">

    </script>
    <script>
        posts();
        verficar_posts();
    </script>
    <script type="text/javascript" src="../assets/script/javascript/feed/script.js"></script>
    <script>
        const nome = <?php echo '"' .$_SESSION[' nome ']. '"'; ?>;
        const email = <?php echo '"' .$_SESSION[' email ']. '"'; ?>;
        const username = <?php echo '"' .$_SESSION[' username ']. '"'; ?>;
        const img_perfil = <?php echo '"' .$_SESSION[' img ']. '"'; ?>;
        const img_banner = <?php echo '"' .$_SESSION[' img_banner ']. '"'; ?>;
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
    <script src="../assets/script/javascript/default/jogos/game.js"></script>
</body>

</html>