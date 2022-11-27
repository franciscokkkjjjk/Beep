<?php
require_once '../conect_pdo.php';
session_start();
if (isset($_POST['x_AUTO30'])) {
    $pesquisa = $pdo->escape_string($_POST['x_AUTO30']);
    $sql_auto_c_rand = $pdo->query("SELECT * FROM users WHERE users.username LIKE '%" . $pesquisa . "%' ORDER BY RAND() LIMIT 6")->fetch_all(1);
    foreach ($sql_auto_c_rand as $value) {
?>
        <div class="teste"><?= $value['username']?></div>
<?php
    }
}
?>