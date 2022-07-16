<?php
function dateCalc($array_user){
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();
    $hoje = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
    $sla = $hoje - strtotime($array_user['date_publi']);
    $secund = $sla / 1000;
    $minutos = ($sla / 60);
    $horas = $minutos / 60;
    $dias = $horas / 24;
    $meses = $dias / 30.5;
    $anos = $dias / 365.25;
    if (round($anos) > 0) {
        echo 'há <b>' . round($anos) . ' anos</b>';
    } elseif (round($meses) > 0) {
        echo 'há <b>' . round($meses) . ' meses</b>';
    } elseif (round($dias) > 0) {
        echo 'há <b>' . round($dias) . ' dias</b>';
    } elseif (round($horas) > 0) {
        echo 'há <b>' . round($horas) . ' horas</b>';
    } elseif (round($minutos) > 0) {
        echo 'há <b>' . round($minutos) . ' minutos</b>';
    } else {
        echo '<b>agora</b>';
    }
}
function perfilDefault($array_user, $dir) {
    if($array_user == '') {
        return "background-image:url($dir../issets/imgs/default/perfil-de-usuario-black.png);";
    } else {
        return "background-image:url($dir../issets/imgs/profile/$array_user);";
    }
}
?>