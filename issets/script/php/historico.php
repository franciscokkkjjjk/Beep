<?php
    $contagem_his = count($_SESSION['historyc']);
    $pag_atual = basename($_SERVER['SCRIPT_NAME']);
    $pag_igual = false;
    if(isset($_SESSION['historyc'][0])){
   for($i = 0; $i < $contagem_his ; $i++){     
   if($_SESSION['historyc'][$i] == $pag_atual) {
    echo '<div>essa foia a ultima pagina</div>';
    $pag_igual = true;
    }} if(!$pag_igual) {
        $_SESSION['historyc'][0][] = [$pag_atual];
    }
    var_dump($_SESSION['historyc']);
} else {
    $_SESSION['historyc'][0] = [$pag_atual];
}
?>