<?php
session_start();
if (isset($_POST['x5edU'])) {
    date_default_timezone_set('America/Sao_Paulo');
    date_default_timezone_get();
    $motivos_values = [ // colocar em uma tabela no banco;
        "Conteúdo explícito",
        "Discurso de ódio",
        "Assédio",
        "Spam"
    ];
    $json = array();
    require_once '../conect_pdo.php';
    $id_denunciado = $pdo->escape_string($_POST['x5edU']); //passar o id da publi em vez do id da denuncia
    $denunciada = $pdo->query("SELECT * FROM denuncias_user WHERE id_denuncia_ = $id_denunciado");
    $denunciada =  $denunciada->fetch_assoc()['id_user_denunciado'];
    $denunciada = $pdo->query("SELECT * FROM denuncias_user WHERE id_user_denunciado=$denunciada");
    $dun = $denunciada->fetch_all(1);

    if (is_null($dun)) {
        $json = [
            'error' => true,
            'mensage' => 'essa denuncia não existe mais.'
        ];
        echo json_encode($json);
        die;
    }
    foreach ($dun as $m) {
        $motivos[] = $m['motivo'];
    }
    $selecionada = key(array_count_values($motivos));
    for ($i = 0; $i < 4; $i++) {
        if ($i + 1 == $selecionada) {
            $selecionada = $motivos_values[$i];
        }
    }

    $json['motivos'] = [
        //fazer uma query para verificar isso
        'mais_selecionados' => $selecionada,
        'qt_denuncias' => count($dun), //fazer uma query para verificar isso (nem kkkk)
    ];
    //verifica quais denuncias foram mais selecionadas
    foreach ($dun as $v0) {
        $selecionado_ind = 0;
        for ($i = 0; $i < 4; $i++) { //verfica o motivo que foi selecionado
            if ($i + 1 == $v0["motivo"]) {
                $selecionado_ind = $motivos_values[$i];
            }
        }
        $denunciador = $pdo->query("SELECT * FROM users WHERE id_user=" . $v0['quem_denunciou']);
        $json['motivos']['info_motivo'][] = [
            'motivo' => $selecionado_ind,
            'motivo_text' => $v0['motivo_text'],
            'denunciador' => $denunciador->fetch_assoc()['username']
        ];
    }

    $postagem_d = $pdo->query("SELECT * FROM users WHERE id_user=" . $dun[0]['id_user_denunciado']);
    $post = $postagem_d->fetch_assoc();
    if (is_null($post)) {
        $json = [
            'error' => true,
            'mensage' => 'O usuário denúnciado requisitado não existe mais.'
        ];
        echo json_encode($json);
        die;
    } else {
        if ($post['tempo_suspensao'] == null) {
            $cal_t = 'Indeterminado.';
        } else {
            $cal_t = strtotime($post['tempo_suspensao']) - strtotime(date('Y-m-d H:i:s'));
            if ($cal_t <= 0) {
                if (!$pdo->query("UPDATE users SET tempo_suspensao=null, status_=0 WHERE id_user=" . $dun[0]['id_user_denunciado'])) {
                    $cal_t = 'Está fora da supensão.';
                }
                $post['status_'] = 0;
            } else {
                $cal_t = floor(((($cal_t / 60) / 60) / 24));
                if ($cal_t > 1) {
                    $cal_t .= ' dias';
                } else {
                    $cal_t .= ' dia';
                }
            }
        }
        $json['usuario_denunciado'] = [
            'id_usuario' => $post['id_user'],
            'date_nasc' => date("d-m-Y", strtotime($post['data_nas'])),
            'email' => $post['email'],
            'nome' => $post['nome'],
            'username' => $post['username'],
            'bio' => $post['bio'],
            'midia_user' => $post['foto_perfil'],
            'midia_banner' => $post['banner_pefil'],
            'status_' => $post['status_'],
            'temp_sus' => $cal_t
        ];
    }


    echo json_encode($json);
} else {
    $json = [
        'error' => true,
        'mensage' => 'sese'
    ];
    echo json_encode($json);
}
