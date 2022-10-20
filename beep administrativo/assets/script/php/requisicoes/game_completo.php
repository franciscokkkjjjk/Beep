<?php
if(isset($_POST['x_25_SP'])) {
    session_start();
    require_once '../conecta.php';

     $id_game_s = mysqli_escape_string($conexao, $_POST['x_25_SP']);
     $sql_game = "SELECT * FROM solicita_list WHERE id_solicita=" . $id_game_s;
     $res_game = mysqli_query($conexao, $sql_game);
     if($res_game) {
        $ass_game = mysqli_fetch_assoc($res_game);
        if(is_null($ass_game)) {
            $json = [
                'error' => true,
            ];
        }  else {
            $json = [
                'error' => false,
                'id_user_solictante' => $ass_game['id_user_solicita'],
                'id' => $ass_game['id_solicita'],
                'conteudo1' => $ass_game['nome_jogo'],
                'conteudo2' => $ass_game['desc_jogo'],
                'loja' => $ass_game['loja'],
                'midia' => $ass_game['img_jogo'],
                'link_l' => $ass_game['link_loja'],
                'conteudo3' => $ass_game['class_etaria'],
                'conteudo5' => date('d/m/Y', strtotime($ass_game['data_solicitado'])),
                'conteudo4' => $ass_game['notificar']
            ];
        }
     } else {
        $json = [
            'error' => true,
            'mensage' => 'Erro na requisição.'
        ];
     }
    // $json['mensage'] .= '';
    echo json_encode($json);

}

?>