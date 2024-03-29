<?php
function dateCalc($array_user = null, $a = 'date_publi')
{
    if ($array_user == null) {
        return null;
    } else {
        date_default_timezone_set('America/Sao_Paulo');
        date_default_timezone_get();
        $hoje = mktime(date('H'), date('i'), date('s'), date('m'), date('d'), date('Y'));
        $sla = $hoje - strtotime($array_user[$a]);
        $secund = $sla / 1000;
        $minutos = ($sla / 60);
        $horas = $minutos / 60;
        $dias = $horas / 24;
        $meses = $dias / 30.5;
        $anos = $dias / 365.25;
        if (round($anos) > 0) {
            if (round($anos) > 1) {
                return 'há <b>' . round($anos) . ' anos</b>';
            } else {
                return 'há <b>' . round($anos) . ' ano</b>';
            }
        } elseif (round($meses) > 0) {
            if (round($meses) > 1) {
                return 'há <b>' . round($meses) . ' meses</b>';
            } else {
                return 'há <b>' . round($meses) . ' mês</b>';
            }
        } elseif (round($dias) > 0) {
            if (round($dias) > 1) {
                return 'há <b>' . round($dias) . ' dias</b>';
            } else {
                return 'há <b>' . round($dias) . ' dia</b>';
            }
        } elseif (round($horas) > 0) {
            if (round($horas) > 1) {
                return 'há <b>' . round($horas) . ' horas</b>';
            } else {
                return 'há <b>' . round($horas) . ' hora</b>';
            }
        } elseif (round($minutos) > 0) {
            if (round($minutos) > 1) {
                return 'há <b>' . round($minutos) . ' minutos</b>';
            } else {
                return 'há <b>' . round($minutos) . ' minuto</b>';
            }
        } else {
            return '<b>agora</b>';
        }
    }
}
function perfilDefault($array_user, $diretorio)
{
    if ($array_user == '' and $diretorio == NULL) {
        return "background-image:url('../assets/imgs/default/perfil-de-usuario-black.png');";
    } elseif ($array_user == '' and $diretorio != '') {
        return "background-image:url('../../assets/imgs/default/perfil-de-usuario-black.png');";
    } elseif ($array_user != '' and $diretorio == NULL) {
        return "background-image:url('../assets/imgs/profile/$array_user');" . $diretorio;
    } elseif ($array_user != '' and $diretorio != '') {
        return "background-image:url('../../assets/imgs/profile/$array_user');";
    } elseif ($array_user == null) {
        return null;
    }
}
function pagAtual($area, $versao = false)
{
    $pagina_atual = basename($_SERVER['SCRIPT_NAME']);
    if ($pagina_atual == $area) {
        if ($versao) {
            return 'active_menu_info';
        } else {
            return 'active--tem';
        }
    } else {
        return '';
    }
}

function valid_game($sql, $conexao)
{
    $sql_game_post = "SELECT * FROM jogos WHERE jogos.id_jogos ='" . $sql . "'";
    $res_game_post = mysqli_query($conexao, $sql_game_post);
    $ass_game_post = mysqli_fetch_assoc($res_game_post);

    if (is_null($ass_game_post) or empty($ass_game_post)) {
        return false;
    } else {
        return $ass_game_post;
    }
}

function valid_class_ind($data_user, $data_game): bool
{
    $data_g = $data_game;
    $data_user = strtotime($data_user);
    $hoje = mktime(date('m'), date('d'), date('Y'));
    $data_ = $hoje - $data_user;
    $minutos = ($data_ / 60);
    $horas = $minutos / 60;
    $dias = $horas / 24;
    $anos = $dias / 365.25;
    if (floor($anos) >= $data_g) {
        return true;
    } else {
        return false;
    }
}
