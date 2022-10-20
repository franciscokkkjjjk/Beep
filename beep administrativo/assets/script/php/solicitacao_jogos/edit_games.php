<?php 
    if(isset($_POST['x5Hidden'])) {
        session_start();
        require_once '../conecta.php';
        require_once '../function.php'; 
        function falha($o) {
            $_SESSION['error'] = true;
            $_SESSION['mensagem'] = 'Falha. '.$o.' não foi enviado. Por favor renicie a pagina e tente novamente.';
            header('location:../../../../paginas/edit.php');
            die;
        }
        function falha2($oa) {
            $_SESSION['error'] = true;
            $_SESSION['mensagem'] = $oa;
            header('location:../../../../paginas/edit.php');
            die;
        }
        $id_s = mysqli_escape_string($conexao, $_POST['x5Hidden']);
        if($id_s == '') {
            falha('O id da solicitação');
        }
        $sql_antiga = "SELECT * FROM solicita_list WHERE id_solicita=" . $id_s;
        $res_antiga = mysqli_query($conexao, $sql_antiga);
        $ass_antiga = mysqli_fetch_assoc($res_antiga);
        if(is_null($ass_antiga)) {
            $_SESSION['error'] = true;
            $_SESSION['mensagem'] = 'A solicitação editada não existe mais.';
            header('location:../../../../paginas/edit.php');
            die;
        }
        $nome_game = mysqli_escape_string($conexao, $_POST['nome_j']);
        if($nome_game == '') {
            falha('O nome do jogo');
        }
        if($_POST['class_etaria'] >= 0) {
            $class_i = mysqli_escape_string($conexao, $_POST['class_etaria']);
        } else {
            $class_i = 0;
        }
        $descr = mysqli_escape_string($conexao, $_POST['des_cap_solicita']);
        if($descr == '') {
            falha('A descrição do jogo'); //como o js verifica ante de mandar, torna um pouco dificil de mandar vazio, mas provavelmente com o comando qs('form').submit() deve enviar vazio(ele realmente manda).
        }
        $loja = mysqli_escape_string($conexao, $_POST['loja']);
        if($loja == '') {
            falha('O nome da loja');
        }
        $l_loja = mysqli_escape_string($conexao, $_POST['loja_link']);
        if($l_loja == '') {
            falha('O link da loja');
        }
        if($_FILES['img_edit']['name'] == "") {
            $img = $ass_antiga['img_jogo'];
        } else {
            $up = true;
            $local = '../../../../../assets/imgs/games/';
            $extensao = explode("/", getimagesize($_FILES['img_edit']['tmp_name'])['mime'])[1];
            $novoNome = bin2hex(random_bytes(20)) . '.' . $extensao; 
            $img = $novoNome;
            if($_FILES['img_edit']['size'] > 20971520) {
                $up = false;
                falha2('Por favor insira uma imagem menor que 20MB.');
            }
            if(getimagesize($_FILES['img_edit']['tmp_name'])[2] != IMAGETYPE_JPEG && getimagesize($_FILES['img_edit']['tmp_name'])[2] != IMAGETYPE_JPEG2000 && getimagesize($_FILES['img_edit']['tmp_name'])[2] != IMAGETYPE_PNG && getimagesize($_FILES['img_edit']['tmp_name'])[2] != IMAGETYPE_BMP &&  getimagesize($_FILES['img_edit']['tmp_name'])[2] != IMAGETYPE_GIF){
                $up = false;
                falha2('A Beep aceita apenas formato gif, png, jpeg, jpg e jfif para solicitação de jogos.');
            }
            if($up) {
                if(move_uploaded_file($_FILES['img_edit']['tmp_name'], $local . $novoNome)) {
                    if(!unlink('../../../../../assets/imgs/games/' . $ass_antiga['img_jogo'])) {
                        $_SESSION['mensagem'] .= "<br>Não foi possivel deletar a imagem antiga. Chame o suporte.";
                    }
                } else {
                    falha2("Não foi possivel cadastrar a imagem. Tente novamente.");
                }
            }
        }
        $sql_upt = "UPDATE solicita_list SET 
        nome_jogo='$nome_game', 
        img_jogo='$img',
        desc_jogo='$descr',
        loja='$loja',
        link_loja='$l_loja',
        class_etaria='$class_i'
         WHERE id_solicita=" . $id_s;
        $res_upt = mysqli_query($conexao, $sql_upt);
        if($res_upt) {
            $_SESSION['mensagem'] .= 'Solicitação editada com sucesso.';
            header('location:../../../../paginas/visualizar_G.php');
        } else {
            unlink('../../../../../assets/imgs/games/' . $img);
            falha2("Não foi possivel editar a solicitação.");
        }
         
    } else {
        $_SESSION['mensagem'] = 'Falha. O id da solicitação não foi enviado. Por favor renicie a pagina e tente novamente.';
        header('location:../../../../paginas/edit.php');
            die;
    }
?>