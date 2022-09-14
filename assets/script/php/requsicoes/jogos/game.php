<?php 
    require_once "../../conecta.php";
    if (isset($_GET['pag'])) {
        $pag = $_GET['pag'];
    } else {
        $pag = 1;
    }
    $limit = 4;
    $offset = $limit * ($pag - 1);
    $sql_game = "SELECT * FROM jogos LIMIT $limit OFFSET $offset";
    $res_game = mysqli_query($conexao, $sql_game);
    if($res_game) {
    $game_array = mysqli_fetch_all($res_game, 1);
        if(is_null($game_array)) {
           foreach($game_array as $value_game) {
            $json[] = [
                'id_game' => $value_game['id_jogos'],
                'nome_jogo' => $value_game['nome_jogo'],
                'faixa_etaria' => $value_game['class_etaria']
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