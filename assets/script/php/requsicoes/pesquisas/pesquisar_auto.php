<?php
require_once '../../conect_pdo.php';
session_start();
require_once '../../function/funcoes.php';
if (isset($_POST['x_AUTO30'])) {
    $pesquisa = $pdo->escape_string($_POST['x_AUTO30']);
    $sql_auto_c_rand = $pdo->query("SELECT * FROM users WHERE users.username LIKE '%" . $pesquisa . "%' OR users.nome LIKE '%" . $pesquisa . "%' ORDER BY RAND() LIMIT 6")->fetch_all(1);
    foreach ($sql_auto_c_rand as $value) {
?>
        <div class="area_users" id="<?= $value['username']?>">
            <div class="user_generic">
                <div class="perfil-link" href="">
                    <div class="perfil--area">
                        <div class="img--perfil menu--pag--img--area area--recomendado" style="<?= perfilDefault($value['foto_perfil'], NULL) ?> ">
                        </div>
                        <div class="name--area">
                            <a class="perfil-link">
                                <div class="name--name-perfil ">
                                    <!-- nome --><?= $value['nome'] ?>
                                </div>
                                <div class="name--username-perfil">
                                    <!-- username --> <?= $value['username'] ?>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
                $sql_user_seguindo = $pdo->query("SELECT * FROM seguidores WHERE user_seguin=" . $_SESSION['id_user'] . " AND user_seguido=" . $value['id_user'] . "")->fetch_assoc();
                if (!is_null($sql_user_seguindo) and !empty($sql_user_seguindo)) {
                ?>
                    <div class="perfil_seguindo">
                        seguindo
                    </div>
                <?php
                }
                ?>
            </div>
        </div>

<?php
    }
}
?>
<div class="pesquisar_completa" aria-valuetext="<?= $pesquisa ?>">
    Pesquisar por <span><?= $pesquisa ?></span>
</div>