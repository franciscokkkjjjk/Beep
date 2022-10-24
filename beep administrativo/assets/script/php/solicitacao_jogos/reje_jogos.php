<?php
if (isset($_POST['p_adm305'])) {
    //reijatar significa que a solicitação será cancelada e o jogo excluido.
    //deletar a solicitação pelo id.
    //notificar o usuário que o jogo foi rejeitado.
    session_start();
    require_once '../conecta.php';
    require_once '../function.php';

    $id_soli = mysqli_escape_string($conexao, $_POST['p_adm305']);
    $sql_solic_c = "SELECT * FROM solicita_list WHERE id_solicita=" . $id_soli;
    $res_solic_c = mysqli_query($conexao, $sql_solic_c);
    $ass_s = mysqli_fetch_assoc($res_solic_c);
    if (is_null($ass_s)) {
        $json = [
            'error' => true,
            'mensage' => 'A solicitação rejeitada não existe.'
        ];
        echo json_encode($json);
        die;
    }
    $sql_rejc = "DELETE FROM solicita_list WHERE id_solicita=" . $id_soli;
    $res_rejc = mysqli_query($conexao, $sql_rejc);
    if ($res_rejc) {
        if (!is_null($ass_s['img_jogo'])) {
            if (!(unlink('../../../../../assets/imgs/games/' . $ass_s['img_jogo']))) {
                $json = [
                    'error' => true,
                    'mensage' => 'Não foi possivel deletar a imagem da solicitação.'
                ];
                echo json_encode($json);
                die;
            }
        }
        $sql_user_s = "SELECT * FROM users WHERE id_user=" . $ass_s['id_user_solicita'];
        $res_user_s = mysqli_query($conexao, $sql_user_s);
        $ass_user_s = mysqli_fetch_assoc($res_user_s);
        if (is_null($ass_user_s)) {
            $json['mensage'] .= ["<br>O usuário que fez a solicitação não existe mais."];
        } elseif ($ass_s['notificar']) {
            $mensagem = "
                Salve " . $ass_user_s['nome'] . ",<br><br>
                Infelizmente sua solicitação foi rejeitada.<br>
                Jogo solicitado:" . $ass_s['nome_jogo'] . "<br><br>
                Atenciosamente,<br>
                Equipe da Beep.
            ";
            $assunto = "Solicitação de jogo.";
            $emailSend  = email_send('../', $mensagem, $assunto, $ass_user_s['email']);
            if ($emailSend[0]) {
                $json = [
                    'error' => false,
                    'mensage' => 'Solicitação rejeitada com sucesso.<br>Mensagem enviada com sucesso.'
                ];
            }
        } else {
            $json = [
                'error' => false,
                'mensage' => 'Solicitação rejeitada com sucesso.'
            ];
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
