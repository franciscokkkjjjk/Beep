<?php 
    session_start();
    require_once '../../conecta.php';
    if(isset($_GET['id_game'])) {
        $sql_verify = "SELECT * FROM jogos_possui WHERE id_user=".$_SESSION['id_user']." AND id_game=".$_GET['id_game'];
        $res_verify = mysqli_query($conexao, $sql_verify);
        $assoc_verify = mysqli_fetch_assoc($res_verify);
        if($assoc_verify != null) {
            $sql_rm = "DELETE FROM jogos_possui WHERE id_user=".$_SESSION['id_user']." AND id_game=".$_GET['id_game'];
            $res_rm = mysqli_query($conexao, $sql_rm);
            if($res_rm) {
                $json = [
                    'error' => false,
                    'mensage' => 'O jogo foi removido da conta com sucesso.'
                ];
            } else {
                $json = [
                    'error' => true,
                    'mensage' => 'Algo deu errado! Tente novamente.'
                ];
            }
        } else {
            $json = [
                'error' => true,
                'mensage' => 'O jogo já foi removido da conta.'
            ];
        }
        
        echo json_encode($json);
    }