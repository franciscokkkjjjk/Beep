<?php
if(isset($_POST['p_adm305'])) {
    //reijatar significa que a solicitação será cancelada e o jogo excluido.
    //deletar a solicitação pelo id.
    //notificar o usuário que o jogo foi rejeitado.
    session_start();
    require_once '../conecta.php';
    $id_soli = mysqli_escape_string($conexao, $_POST['p_adm305']);
    $sql_solic_c = "SELECT * FROM solicita_list WHERE id_solicita=" . $id_soli;
    $res_solic_c = mysqli_query($conexao, $sql_solic_c);
    $ass_s = mysqli_fetch_assoc($res_solic_c);
    if(is_null($ass_s)) {
        $json = [
            'error' => true,
            'mensage' => 'A solicitação rejeitada não existe mais.'
        ];
        echo json_encode($json);
        die;
    }
    $sql_rejc = "DELETE FROM solicita_list WHERE id_solicita=" . $id_soli;
    $res_rejc = mysqli_query($conexao, $sql_rejc);
    if($res_rejc) {
        if(!(unlink('../../../../../assets/imgs/games/' . $ass_s['img_jogo']))) {
            $json = [
                'error' => true,
                'mensage' => 'Não foi possivel deletar a imagem da solicitação.'
            ];
            echo json_encode($json);
            die;
        }
        
    } else {
        $json = [
            'error' => true,
            'mensage' => 'Não foi possivel rejeitar a solicitação. Tente novamente.'
        ]; 
    }
} else {
    $json = [
        'error' => true,
        'mensage' => 'Algo deu errado.'
    ];
}
echo json_encode($json);
?>