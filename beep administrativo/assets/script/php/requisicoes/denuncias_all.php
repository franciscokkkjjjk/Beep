<?php
session_start();
if ($_POST['x5edP']) {
    $json = array();
    //pegar todas as denuncias com as suas motivações (Foreach)
    //pegar a publicação que foi denunciada
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
    $json['motivos'] = [
        'mais selecionados' => 1, //fazer uma query para verificar isso
        'qt_denuncias' => 1, //fazer uma query para verificar isso
    ];
    foreach($dun as $v0) {
        $denunciador = $pdo->query("SELECT * FROM users WHERE id_user=" . $v0['denunciador']);
        $json['motivos']['info_motivo'][] = [
            'motivo' => $v0['motivo'],
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
        $json['posts_info']['postagem_denunciada'] = [
            ''
        ];
        if($post['type'] == 2 or $post['type'] == 1) {
            $json['posts_info']['postagem_interagida'] = [
                ''
            ];
        }
        
    }

    $json = [
        'error' => false,
        'mensage' => $postagem_d->fetch_assoc()
    ];
    echo json_encode($json);
}
