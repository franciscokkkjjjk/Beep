<?php 
    session_start();
    require_once '../conecta.php';
    require_once '../function/funcoes.php';
    if(isset($_POST['direct'])) {
        date_default_timezone_set('America/Sao_Paulo');
        date_default_timezone_get();
        $data_publi = date('Y-m-d H:i:s');
        $id_postI = $_POST['direct'];
        $sql_post = 'SELECT * FROM publicacoes WHERE id_publi='.$id_postI;
        $res_postI = mysqli_query($conexao, $sql_post);
        $ass_postI = mysqli_fetch_assoc($res_postI);
        if($ass_postI['type'] == '4') {
            $sql_compart_direc = "INSERT INTO publicacoes(user_publi, type, id_publi_interagida, text_publi, img_publi, num_curtidas, num_compartilha, date_publi, num_comentario) VALUES (".$_SESSION['id_user'].", 4, ".$ass_postI['id_publi_interagida'].",NULL,'',0,0,'$data_publi',0)";
            $res_c_d = mysqli_query($conexao, $sql_compart_direc);
            if($res_c_d) {
                $sql_post_inter = 'SELECT * FROM publicacoes WHERE id_publi='.$ass_postI['id_publi_interagida'];
                $res_post_inter = mysqli_query($conexao, $sql_post_inter);
                $ass_post_inter = mysqli_fetch_assoc($res_post_inter);
                $cal = intval($ass_post_inter['num_compartilha'])+1;
                $upd_num = "UPDATE publicacoes SET num_compartilha=$cal WHERE id_publi=".$ass_postI['id_publi_interagida'];
                $res_num = mysqli_query($conexao, $upd_num);
                if($res_num) {
                    $res = [
                        'error' => false
                    ];
                    echo json_encode($res);
                }
            }
        } else {
            $sql_compart_direc = "INSERT INTO publicacoes(user_publi, type, id_publi_interagida, text_publi, img_publi, num_curtidas, num_compartilha, date_publi, num_comentario) VALUES (".$_SESSION['id_user'].", 4, ".$_POST['direct'].",NULL,'',0,0,'$data_publi',0)";
            $res_c_d = mysqli_query($conexao, $sql_compart_direc);

            $sql_num_compatilhamento = 'SELECT * FROM publicacoes WHERE publicacoes.id_publi='.$_POST['direct'];
            $res_num_compartilhamento = mysqli_query($conexao, $sql_num_compatilhamento);
            $assoc_num_compartilhamento = mysqli_fetch_assoc($res_num_compartilhamento);
            $calc = intval($assoc_num_compartilhamento['num_compartilha'])+1;
            $upd_num = "UPDATE publicacoes SET num_compartilha=$calc WHERE id_publi=".$_POST['direct'];
            $res_num = mysqli_query($conexao, $upd_num);
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
        
    }
    
?>