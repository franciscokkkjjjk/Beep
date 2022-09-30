<?php 
    session_start();
    require_once 'conecta.php';
    if(getimagesize($_FILES['img_input_s']['tmp_name']) == false) {
        $_SESSION['menssagem'] = 'Por favor insira uma imagem real.';
        $_SESSION['fal'] = true;
        header('location: ../../../paginas/solicitacaoJogos.php');
        die;
    } else {
        $up = true;
        $local = '../../imgs/games/';
        $extensao = explode("/", getimagesize($_FILES['img_input_s']['tmp_name'])['mime'])[1];
        $novoNome = bin2hex(random_bytes(20)) . '.' . $extensao; 
        if($_FILES['img_input_s']['size'] > 20971520) {
            $up = false;
            $_SESSION['menssagem'] = 'Por favor insira uma imagem menor que 20MB.';
            $_SESSION['fal'] = true;
            header('location: ../../../paginas/solicitacaoJogos.php');
            die;
        }
        if(getimagesize($_FILES['img_input_s']['tmp_name'])[2] != IMAGETYPE_JPEG && getimagesize($_FILES['img_input_s']['tmp_name'])[2] != IMAGETYPE_JPEG2000 && getimagesize($_FILES['img_input_s']['tmp_name'])[2] != IMAGETYPE_PNG && getimagesize($_FILES['img_input_s']['tmp_name'])[2] != IMAGETYPE_BMP &&  getimagesize($_FILES['img_input_s']['tmp_name'])[2] != IMAGETYPE_GIF){
            $up = false;
            $_SESSION['menssagem'] = 'A Beep aceita apenas formato gif, png, jpeg, jpg e jfif para solicitação de jogos.';
            $_SESSION['fal'] = true;
            header('location: ../../../paginas/solicitacaoJogos.php');
            die;
        }
        if($up) {
            if(move_uploaded_file($_FILES['img_input_s']['tmp_name'], $local . $novoNome)) {
                $name = addslashes($_POST['name_input_s']);
                $desc = addslashes($_POST['des_cap_solicita']);
                $loja = addslashes($_POST['name_loja_cap_solicita']);
                $linkLoja = addslashes($_POST['name_link_cap_solicita']);
                if(isset($_POST['checkBox'])) {
                    $check = true;
                } else {
                    $check = false;
                }
                $classI = $_POST['class_etaria'];
                date_default_timezone_set('America/Sao_Paulo');
                date_default_timezone_get();
                $data_expedido = date('Y-m-d H:i:s');
                $sql_add = "INSERT INTO solicita_list( id_user_solicita, nome_jogo, img_jogo, desc_jogo, loja, link_loja, class_etaria, data_solicitado, notificar) VALUES (". $_SESSION['id_user'].",'$name','$novoNome','$desc','$loja','$linkLoja','$classI','$data_expedido', '$check' )";
                $res_add = mysqli_query($conexao, $sql_add);
                if($res_add) {
                    $_SESSION['menssagem'] = 'Viva! Sua solicitação foi enviada com sucesso.';
                    header('location: ../../../paginas/solicitacaoJogos.php');
                    die;
                } else {
                    $_SESSION['menssagem'] = 'Ocorreu um erro. Sua solicitação não pode ser enviada.';
                    header('location: ../../../paginas/solicitacaoJogos.php');
                    unlink($local . $novoNome);
                    die;
                }
            }
        }

    }
?>