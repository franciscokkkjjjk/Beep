<?php
    $contagem_his = count($_SESSION['historyc']);
    $pag_atual = basename($_SERVER['SCRIPT_NAME']);
    $pag_igual = false;
    if(isset($_SESSION['historyc'][0])){
   for($i = 0; $i < $contagem_his ; $i++){     
   if($_SESSION['historyc'][$contagem_his-1][0] == $pag_atual) {
    $pag_igual = true;
    }} if(!$pag_igual) {
        $_SESSION['historyc'][] = [$pag_atual];
    }
} else {
    $_SESSION['historyc'][] = [$pag_atual];
}
?>