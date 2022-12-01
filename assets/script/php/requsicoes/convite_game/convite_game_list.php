<?php
session_start();
require_once '../../conect_pdo.php';
require_once '../../function/funcoes.php';
date_default_timezone_set('America/Sao_Paulo');
date_default_timezone_get();
if (isset($_POST['x_USERID30'])) {
    $sql_ = $pdo->query('SELECT * FROM users WHERE users.id_user IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin = ' . $_SESSION['id_user'] . ' AND seguidores.user_seguido IN (SELECT seguidores.user_seguin FROM seguidores WHERE seguidores.user_seguido = ' . $_SESSION['id_user'] . ')) AND users.id_user <> ' . $_SESSION['id_user'] . ';');
    if ($sql_) {
        $sql_ = $sql_->fetch_all(1);
    }
    if (!empty($sql_) or !is_null($sql_)) {
        foreach ($sql_ as $value05) {
?>
<div class="opt--recomedado--area" style='background-color: transparent;'>
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
            <?php
            $sql_verify = $pdo->query("SELECT * FROM conviteparajogos WHERE id_user_convidado=" . $_SESSION['id_user'] . " AND id_user_foi_convidado=" . $value05['id_user'] . "")->fetch_assoc();
            if (empty($sql_verify) or is_null($sql_verify)) {
            ?>
            <button type="submit" class="button--seguir button--convidar"
                id="x_CONVIDARXD_30_<?= $value05['id_user'] ?>"></button>
            <?php
            } else {
            ?>
            <button type="submit" class="button--seguir button--convidar_fals"
                id="x_CONVIDARXD_29_<?= $value05['id_user'] ?>"></button>
            <?php
            }
            ?>
        </div>
    </div>
</div>
<?php
        }
    } else {
?>
<div class="nada">Você não possui ninguém que te segue mutuamente. :(</div>
<?php
    }
}
if (isset($_POST['x_CONVIDARXD_30_'])) {
    $id_user = $pdo->real_escape_string($_POST['x_CONVIDARXD_30_']);
    $user = $pdo->query("SELECT * FROM users WHERE id_user=" . $id_user)->fetch_assoc();
    $verify = $pdo->query("SELECT * FROM conviteparajogos WHERE id_user_convidado=" . $_SESSION['id_user'] . " AND id_user_foi_convidado=" . $user['id_user'] . "")->fetch_assoc();
    $verify02 = $pdo->query("SELECT * FROM conviteparajogos WHERE id_user_convidado=" . $_SESSION['id_user'] . "")->fetch_all(1);
    if (count($verify02) >= 8) {
        $json = [
            'error' => true,
            'mensage' => 'O número maximo de convites é 8.'
        ];
        echo json_encode($json);
        die;
    }
    $json = [
        'mensage' => 'Convite enviado com sucesso.',
        'error' => false
    ];
    if (!is_null($verify) or !empty($verify)) {
        $json = [
            'error' => true,
            'mensage' => 'Esse convite já foi enviado anteriormente.'
        ];
        echo json_encode($json);
        die;
    }
    $data_atual = date('Y-m-d H:i:s');
    $sql = $pdo->query("INSERT INTO conviteparajogos(id_user_convidado, id_user_foi_convidado, data_convidado) VALUES (" . $_SESSION['id_user'] . ", " . $user['id_user'] . ", '$data_atual')");
    if (!$sql) {
        $json = [
            'mensage' => "Não foi possivel convidar o usuário para jogar.",
            'error' => true
        ];
    }
    echo json_encode($json);
}
if (isset($_POST['x_CONVIDARXD_29_'])) {
    $id_user = $pdo->real_escape_string($_POST['x_CONVIDARXD_29_']);
    $user = $pdo->query("SELECT * FROM users WHERE id_user=" . $id_user)->fetch_assoc();
    $verify = $pdo->query("SELECT * FROM conviteparajogos WHERE id_user_convidado=" . $_SESSION['id_user'] . " AND id_user_foi_convidado=" . $user['id_user'] . "")->fetch_assoc();
    $json = [
        'mensage' => 'Convite removido com sucesso.',
        'error' => false
    ];
    if (is_null($verify) or empty($verify)) {
        $json = [
            'error' => true,
            'mensage' => 'Esse convite já foi retirado anteriormente.'
        ];
        echo json_encode($json);
        die;
    }
    $sql = $pdo->query("DELETE FROM conviteparajogos WHERE  id_user_convidado=" . $_SESSION['id_user'] . " AND id_user_foi_convidado=" . $user['id_user'] . "");
    echo json_encode($json);
}

if (isset($_POST['x_VERIFYD30'])) {
    if (!isset($_SESSION['num_verify_convite'])) {
        $_SESSION['num_verify_convite'] = 0;
    }
    $sql_verify = $pdo->query("SELECT * FROM conviteparajogos WHERE id_user_foi_convidado=" . $_SESSION['id_user'])->fetch_all(1);
    if (is_null($sql_verify) or empty($sql_verify)) {
        echo '';
        die;
    }
    foreach ($sql_verify as $value06) {
        $sql_user = $pdo->query("SELECT * FROM users WHERE id_user=" . $value06['id_user_convidado'])->fetch_assoc();
        if (is_null($sql_user) or empty($sql_user)) {
            $sql_del = $pdo->query("DELETE FROM conviteparajogos WHERE id_user_foi_convidado=" . $_SESSION['id_user'] . " AND id_user_convidado=" . $value06['id_user_convidado']);
            continue;
        }
?>

<div class="opt--recomedado--area">
    <div class="perfil--area">
        <div class="img--perfil menu--pag--img--area area--recomendado"
            style="background-image:url('<?= pagAtual('caminho') ?>../assets/imgs/profile/background.jpg62cb37f242313.jpg');">
        </div>
        <div class="name--area">
            <a class="perfil-link" href="">
                <div class="name--name-perfil perfil-link-hover" style="color: #fff;">
                    <?= $sql_user['nome'] ?>
                </div>
                <div class="name--username-perfil perfil-link-hover">
                    <?= $sql_user['username'] ?>
                </div>
            </a>
        </div>
    </div>
    <div class="buttom-recomendado-area">
        <div class="buttom--body">
            <form action="<?= pagAtual('caminho'); ?>../assets/script/php/seguir.php" method="post">
                <button type="submit" class="button--seguir button--aceira--convite"></button>
                <input type="hidden" value="" name="iD_x30">
            </form>
        </div>
    </div>
</div>
<?php
    }
}
?>