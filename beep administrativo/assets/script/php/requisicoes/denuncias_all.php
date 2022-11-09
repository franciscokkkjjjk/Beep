<?php
session_start();
if ($_POST['x5edP']) {
    $motivos_values = [ // colocar em uma tabela no banco;
        "Conteúdo explícito",
        "Discurso de ódio", 
        "Assédio",
        "Spam"
    ];
    $json = array();
    //pegar todas as denuncias com as suas motivações (Foreach)X
    //pegar a publicação que foi denunciadaX
    //pegar informações da publicação interagida (caso haja) (type 4 pega a original (mas não há))
    //pegar informações completas do usuário que foi denunciado;
    //pegar o username do usuário que realizou a publicação interagida (caso haja)  
    require_once '../conect_pdo.php';
    $id_denunciada = $pdo->escape_string($_POST['x5edP']);//passar o id da publi em vez do id da denuncia
    $denunciada = $pdo->query("SELECT * FROM denuncias WHERE id_denuncia= $id_denunciada");
    $denunciada =  $denunciada->fetch_assoc()['post_denunciado'];
    $denunciada = $pdo->query("SELECT * FROM denuncias WHERE post_denunciado=$denunciada");
    $dun = $denunciada->fetch_all(1);
    if(is_null($dun)) {
        $json = [
            'error' => true,
            'mensage' => 'essa denuncia não existe mais.'
        ];
        echo json_encode($json);
        die;
    }
    foreach($dun as $m) {
        $motivos[] = $m['motivo'];
    }
    $selecionada = key(array_count_values($motivos));
    for($i = 0; $i < 4; $i++) {
        if($i + 1 == $selecionada) {
            $selecionada = $motivos_values[$i];
        }
    }
    
    $json['motivos'] = [
        //fazer uma query para verificar isso
        'mais_selecionados' => $selecionada,
        'qt_denuncias' => count($dun), //fazer uma query para verificar isso
    ];
    //verifica quais denuncias foram mais selecionadas
    foreach($dun as $v0) {
        $selecionado_ind = 0;
        for($i = 0; $i < 4; $i++) {//verfica o motivo que foi selecionado
            if($i + 1 == $v0["motivo"]) {
                $selecionado_ind = $motivos_values[$i];
            }
        }
        $denunciador = $pdo->query("SELECT * FROM users WHERE id_user=" . $v0['denunciador']);
        $json['motivos']['info_motivo'][] = [
            'motivo' => $selecionado_ind,
            'motivo_text' => $v0['motivo_text'],
            'denunciador' => $denunciador->fetch_assoc()['username'] 
        ];
    }

    $postagem_d = $pdo->query("SELECT * FROM publicacoes WHERE id_publi=" . $dun[0]['post_denunciado']);
    $post = $postagem_d->fetch_assoc();
    if(is_null($post)) {
        $json = [
            'error' => true,
            'mensage' => 'A postagem denúnciada requisitada não existe mais.'
        ];
        echo json_encode($json);
        die;
    } else {
        $user_publi = $pdo->query("SELECT * FROM users WHERE id_user='" . $post['user_publi'] . "'")->fetch_assoc();
        $json['posts_info']['postagem_denunciada'] = [
            'id_publicacao' => $post['id_publi'],
            'date_p' => date("d-m-Y", strtotime($post['date_publi'])) ." as " . date("H:i:s", strtotime($post['date_publi'])),
            'user_publi' => $user_publi['username'],
            'text_publi' => $post['text_publi'],
            'midia_publi' => $post['img_publi'],
            'querent' => $post['quarentena']
        ];
        $json['posts_info']['userPubliDenunciada'] = [
            "id_user" => $user_publi['id_user'],
            'username' => $user_publi['username'],
            "bio" => $user_publi['bio'],
            "data_nas" => date("d-m-Y", strtotime($user_publi['data_nas'])),
            "foto_perfil" => $user_publi["foto_perfil"],
            "nome" => $user_publi['nome']
        ];
        if($post['type'] == 2 or $post['type'] == 1) {
            $query_inter = $pdo->query("SELECT * FROM publicacoes WHERE id_publi='" . $post['id_publi_interagida'] . "'")->fetch_assoc();
            $user_publi_ = $pdo->query("SELECT * FROM users WHERE id_user='" . $query_inter['user_publi'] . "'")->fetch_assoc();
            $json['posts_info']['postagem_denunciada']['id_interagida'] = $post['id_publi_interagida'];
            $json['posts_info']['postagem_interagida'] = [
                'id_I' => $query_inter['id_publi'],
                'date_I' => $query_inter['date_publi'],
                'user_publi_I' => $user_publi_['username'],
                'text_publi_I' => $query_inter['text_publi'],
                'midia_publi_I' => $query_inter['img_publi']
            ];
        }
        
    }

    echo json_encode($json);
}
