<?php
session_start();
require_once '../../conect_pdo.php';
if (isset($_SESSION['id_root'])) {
    if (isset($_POST['x_GAMEP30'])) {
        $pes = $pdo->real_escape_string($_POST['x_GAMEP30']);
        $sql = $pdo->query("SELECT * FROM solicita_list WHERE nome_jogo LIKE '%" . $pes . "%' OR id_solicita  LIKE '" . $pes . "'");
        if ($sql) {
            $sql->fetch_all(1);
            foreach ($sql as $values) {
?>
<div class="corpo_list">
    <div class="list_area">
        <div class="area_list_info_1">
            <div class="list_img" style="background-image: url('../../assets/imgs/games/<?= $values['img_jogo'] ?>'">
            </div>
            <div class="list_title">
                <?= $values['nome_jogo'] ?>
            </div>
        </div>
        <div class="area_list_info_2">
            <div class="button_c button_int" id="x_DREQ_30_<?= $values['id_solicita'] ?>">
                <div class="img_"></div>
            </div>
        </div>
    </div>
</div>
<?php
            }
        }
    }
    if (isset($_POST['x_USERD30'])) {
        $id_user = $pdo->real_escape_string($_POST['x_USERD30']);
        $values = $pdo->query("SELECT * FROM denuncias_user WHERE id_user_denunciado LIKE '$id_user'");
        if ($values) {
            $values = $values->fetch_assoc();
            if (!is_null($values)) {
                $sql_user = $pdo->query("SELECT * FROM users WHERE id_user=" . $values['id_user_denunciado'])->fetch_assoc();
?>
<div class="corpo_list">
    <div class="list_area">
        <div class="area_list_info_1">
            <div class="list_img"
                style="background-image: url('../../assets/imgs/profile/<?= $sql_user['foto_perfil'] ?>'">
            </div>
            <div class="list_title">
                <?= $sql_user['id_user'] ?>
            </div>
        </div>
        <div class="area_list_info_2">
            <div class="button_c button_int" id="x_DREQ_30_<?= $values['id_denuncia_'] ?>">
                <div class="img_"></div>
            </div>
        </div>
    </div>
</div>
<?php
            }
        }
    }
    if (isset($_POST['x_POSTD30'])) {
        $id_user = $pdo->real_escape_string($_POST['x_POSTD30']);
        $values = $pdo->query("SELECT * FROM denuncias WHERE post_denunciado='$id_user'");
        if ($values) {
            $values = $values->fetch_assoc();
            if (!is_null($values)) {
                $sql_user = $pdo->query("SELECT * FROM publicacoes WHERE id_publi=" . $values['post_denunciado'])->fetch_assoc();
?>
<div class="corpo_list">
    <div class="list_area">
        <div class="area_list_info_1">
            <div class="list_img"
                style="background-image: url('../../assets/imgs/posts/<?= $sql_user['img_publi'] ?>'">
            </div>
            <div class="list_title">
                <?= $sql_user['id_publi'] ?>
            </div>
        </div>
        <div class="area_list_info_2">
            <div class="button_c button_int" id="x_DREQ_30_<?= $values['id_denuncia'] ?>">
                <div class="img_"></div>
            </div>
        </div>
    </div>
</div>
<?php
            }
        }
    }
    // if(isset($_POST['']))
}
?>