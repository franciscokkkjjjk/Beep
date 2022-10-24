<?php 
    session_start();
    if(!isset($_SESSION['id_root'])) {
        die;
    } else {
    require_once '../conecta.php';
    $sql_game_l = "SELECT * FROM solicita_list";
    $res_game_l = mysqli_query($conexao, $sql_game_l);
    if($res_game_l) {
        $all_game_l = mysqli_fetch_all($res_game_l, 3);
        if(!isset($all_game_l[0])) {
            $json[] = [
                'erro' => false, 
                'id' => null,
                'title' => 'Não há nenhuma solicitação de jogo ainda.',
                'img' => null
            ];
        } else {
            foreach($all_game_l as $v) {
                $json[] = [
                    'erro' => false,
                    'id' => $v['id_solicita'],
                    'title' =>  $v['nome_jogo'],
                    'img' => $v['img_jogo'],
                ];
    
            }
        }
    } else {
        $json = [
            'erro' => true,
            'desc' => 'Não foi possivel listar os posts'
        ];
    }
    echo json_encode($json);
}
?>
