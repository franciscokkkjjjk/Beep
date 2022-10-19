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
                'id_S' => $ass_game['id_user_solicita'],
                'nome_S' => $ass_game['nome_jogo'],
                'desc_jogo_S' => $ass_game['desc_jogo'],
                'n_loja_S' => $ass_game['loja'],
                'l_loja_S' => $ass_game['link_loja'],
                'clas_eta_S' => $ass_game['class_etaria'],
                'd_solicita' => date('d/m/Y', strtotime($ass_game['data_solicitado'])),
                'not_S' => $ass_game['notificar']
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