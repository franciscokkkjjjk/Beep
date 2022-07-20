<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';
    if(isset($_POST['direct'])) {
        date_default_timezone_set('America/Sao_Paulo');
        date_default_timezone_get();
        $data_publi = date('Y-m-d H:i:s');
        $sql_compart_direc = "INSERT INTO publicacoes(user_publi, type, id_publi_interagida, text_publi, img_publi, num_curtidas, num_compartilha, date_publi, num_comentario) VALUES (".$_SESSION['id_user'].", 2, ".$_POST['direct'].",NULL,'',0,0,'$data_publi',0)";
        $res_c_d = mysqli_query($conexao, $sql_compart_direc);
        if($res_c_d) {
            $res = [
                'error' => false
            ];
            echo json_encode($res);
            
        }  else {
            $res = [
                'error' => true
            ];
            echo json_encode($res);
        }
        
    }
    
?>