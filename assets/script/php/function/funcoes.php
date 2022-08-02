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
        if(round($anos) > 1) {
            return 'há <b>' . round($anos) . ' anos</b>';
        } else {
            return 'há <b>' . round($anos) . ' ano</b>';
        }
    } elseif (round($meses) > 0) {
        if(round($meses) > 1) {
            return 'há <b>' . round($meses) . ' meses</b>';
        } else {
            return 'há <b>' . round($meses) . ' mês</b>';
        }
    } elseif (round($dias) > 0) {
        if(round($dias) > 1) {
            return 'há <b>' . round($dias) . ' dias</b>';
        } else {
            return 'há <b>' . round($dias) . ' dia</b>';
        }
    } elseif (round($horas) > 0) {
        if(round($horas) > 1){
            return 'há <b>' . round($horas) . ' horas</b>';
        } else {
            return 'há <b>' . round($horas) . ' hora</b>';
        }
    } elseif (round($minutos) > 0) {
        if(round($minutos) > 1) {
            return 'há <b>' . round($minutos) . ' minutos</b>';
        } else {
            return 'há <b>' . round($minutos) . ' minuto</b>';
        }
        
    } else {
        return '<b>agora</b>';
    }
}
function perfilDefault($array_user, $diretorio) {
    if($array_user == '' and $diretorio == '') {
        return "background-image:url('../assets/imgs/default/perfil-de-usuario-black.png');";
    } elseif ($array_user == '' and $diretorio != '') {
        return "background-image:url('../../assets/imgs/default/perfil-de-usuario-black.png');";
    } elseif ($array_user != '' and $diretorio == '') {
        return "background-image:url('../assets/imgs/profile/$array_user');". $diretorio;
    } elseif ($array_user != '' and $diretorio != '') {
        return "background-image:url('../../assets/imgs/profile/$array_user');";
    }
}
function pagAtual($area) {
    $pagina_atual = basename($_SERVER['SCRIPT_NAME']);
    if($pagina_atual == $area) {
        return 'active--tem';
    } elseif ($pagina_atual == 'seguindo.php' or $pagina_atual == 'seguidores.php'  and $area == 'caminho') {
        return '../';
    }
}
?>