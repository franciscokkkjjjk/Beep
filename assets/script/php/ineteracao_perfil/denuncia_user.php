<?php
if (isset($_POST['dP_xd30'])) {
    session_start();
    require_once '../conecta.php';
    $id_denunciador = $_SESSION['id_user'];

    if (!isset($_POST['dP_xd30'])) {
        $json = [
            'error' => true,
            'mensage' => 'Algo deu errado. O id da denúncia não foi enviado.'
        ];
        echo json_encode($json);
        die;
    }
    $id_user = mysqli_escape_string($conexao, $_POST['dP_xd30']);
    $sql_user = "SELECT * FROM users WHERE id_user=" . $id_user;
    $res_post = mysqli_query($conexao, $sql_user);
    $ass_user = mysqli_fetch_assoc($res_post);
    if (empty($ass_user) or is_null($ass_user)) {
        $json = [
            'error' => true,
            'mensage' => 'O usuario que foi solicitado não pode ser encontrado.'
        ];
        echo json_encode($json);
        die;
    }
    $verify = "SELECT * FROM denuncias_user WHERE id_user_denunciado=" . $id_user . " AND quem_denunciou=" . $_SESSION['id_user'];
    $verify_res = mysqli_query($conexao, $verify);
    $ass_ve = mysqli_fetch_assoc($verify_res);

    if (isset($_POST['dP_xd30_mT'])) { //não faz sentido mas fds
        if ($_POST['dP_xd30_mT'] != null) {
            $motivo_text = mysqli_escape_string($conexao, $_POST['dP_xd30_mT']);
        } else {
            $motivo_text = null;
        }
    } else {
        $motivo_text = null;
    }
    //verificações com apenas uma mensagem
    if (!is_null($ass_ve)) {
        $json = [
            'error' => true,
            'mensage' => 'Você já denunciou esse usuário anteriormente.'
        ];
        echo json_encode($json);
        die;
    }
    // verficacoes com multiplas mensagens:
    $json = [
        'error' => false,
        'mensage' => ''
    ];
    $error = false;
    if (!isset($_POST['dp_xd30_m'])) {
        $error = true;
        $json['mensage'] .= 'Algo deu errado. O motivo não foi enviado.';
    } elseif ($_POST['dp_xd30_m'] >= 0  and $_POST['dp_xd30_m'] < 9) { //rever quantos motivos de denuncias terá 
        $motivo = mysqli_escape_string($conexao, $_POST['dp_xd30_m']);
    } else {
        $error = true;
        $json['mensage'] .= "<br>Algo deu errado com o a denúncia."; //não informar direito para o user
    }
    if ($error) {
        $json['error'] = true;
        echo json_encode($json);
    } else {
        //continua
        $alo_policia = "INSERT INTO denuncias_user(id_user_denunciado, quem_denunciou, motivo, motivo_text) VALUES ($id_user, $id_denunciador, $motivo, '$motivo_text')";
        $oq_ocorreu = mysqli_query($conexao, $alo_policia);
        if ($oq_ocorreu) {
            $json = [
                'error' => false,
                'mensage' => 'Obrigado por denunciar. Sua contribuição é muito importante para nós.'
            ];
            echo json_encode($json);
            die;
        } else {
            $json = [
                'error' => true,
                'mensage' => 'Algo de errado. A denúncia não pode ser realizada.'
            ];
            echo json_encode($json);
            die;
        }
    }
} else {
    $json = [
        'error' => true,
        'mensage' => 'Input inexistente.'
    ];
    echo json_encode($json);
    die;
}
