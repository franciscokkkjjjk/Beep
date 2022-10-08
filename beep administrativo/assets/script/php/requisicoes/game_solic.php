<?php 
    session_start();
    if(!isset($_SESSION['id_root'])) {
        die;
    }
    require_once '../conecta.php';
    $sql_game_l = "SELECT * FROM solicita_list";
    $res_game_l = mysqli_query($conexao, $sql_game_l);
    if($res_game_l) {
        $all_game_l = mysqli_fetch_all($res_game_l, 3);
        foreach($all_game_l as $v) {
            $json[] = [
                'erro' => false,
                '' 
            ];

        }
    } else {
        $json = [
            'erro' => true,
            'desc' => 'Não foi possivel listar os posts'
        ];
    }
    echo json_encode($json);
?>
