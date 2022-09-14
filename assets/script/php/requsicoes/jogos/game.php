<?php 
    session_start();
    require_once "../../conecta.php";
    if(!isset($_SESSION['id_user'])) {
        header('location:../../../../../');
        die;
    }
    if (isset($_GET['pag'])) {
        $pag = $_GET['pag'];
    } else {
        $pag = 1;
    }
    $limit = 4;
    $offset = $limit * ($pag - 1);
    $sql_game = "SELECT * FROM jogos LIMIT $limit OFFSET $offset";
    $res_game = mysqli_query($conexao, $sql_game);

    $sql_game_user = "SELECT * FROM jogos_possui WHERE id_user=" . $_SESSION['id_user'];
    $res_game_user = mysqli_query($conexao, $sql_game);
    $arra_game_user = mysqli_fetch_all($res_game_user, 1);
    if($res_game) {
    $game_array = mysqli_fetch_all($res_game, 1);
        if(is_null($game_array)) {
           foreach($game_array as $value_game) {
            $possui = false;
                foreach($arra_game_user as $v_game) {
                    if($v_game['id_game'] == $value_game['id_jogos']) {
                        $possui = true;
                    }
                }
            $json[] = [
                'id_game' => $value_game['id_jogos'],
                'nome_jogo' => $value_game['nome_jogo'],
                'capa_game' => $value_game['img_jogo'],
                'faixa_etaria' => $value_game['class_etaria'],
                'possui' => $possui
            ];
           }
        } else {
            $json = [
                'erro' => false,
                'nada' => 'nada por aqui'
            ];
        }
    } else {
        $json = [
            'erro' => true,
            'desc' => 'algo deu errado!'
        ];
    }
    echo json_encode($json);
?>