<?php 
    session_start();
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    }  
    require_once '../assets/script/php/conecta.php';
    require_once '../assets/script/php/function/funcoes.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de jogos | Beep</title>
    <link rel="icon" href="../assets/imgs/default/beep_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/feed/style.css">
    <link rel="stylesheet" href="../assets/style/form_solicitacao/style.css">
    <style>
        <?php 
            if(!$_SESSION['img'] == '' and !$_SESSION['img'] == null) {
        ?>
        .menu--pag--img--area {
            background-image: url('../assets/imgs/profile/<?=$_SESSION['img']?>')
        }
        <?php } else { ?>
            .menu--pag--img--area {
            background-image: url('../assets/imgs/default/perfil-de-usuario-black.png');
        }
        <?php }?>
    </style>
</head>
<body>
<div class="feed-area">
        <?php 
            require_once '../assets/script/php/html__generic/nav_menu.php';
        ?>
        <div class="timeline--area">
            <div class="feed-header-body">
                    <h1>
                        Formulário de Solictação de Jogos.
                    </h1>
                    <div class="feed-logo-body menu--header">
                        <div class="menu">
                            <div class="menu--pag--button-menu--area " >
                                <div class="menu--pag--button button--header">
                                    <div class="event--header"></div>
                                </div>
                            </div>
                        </div>
                        <div class="menu--header--body">
                            <a href='<?= pagAtual('caminho');?>../assets/script/php/logout.php' class="opt--menu-header">
                                <div class="img--menu--header logout"></div>
                                <div class="text--menu--header">logout</div>
                            </a>
                        </div>
                </div>
            </div>
            <div class="feed-body-post">
                <div class="form_solicitacao_area">
                    <form action="" method="post">
                    <!-- 
                        --adicionar fotos 
                        --adicionar nomes
                        --adicionar lojas e seus respectivos links
                        --adicionar descriçoes
                     -->
                     <div class="cap_area">
                            <div class="img_cap_solicita">
                                <label for="img_input_s">
                                    <div class="img_buttons add-imagem"></div>
                                </label>
                                <div class="img_buttons remove-imagem "></div>
                            </div>
                        <input type="file" name="img_input_s" id="img_input_s" required style="display: none;">
                     </div>
                     <div class="inputs_area">
                        <div class="input_name_solicita_area">
                            <input type="text" class="input_name_solicita" required name="name_input_s">
                        </div>
                        <div class="input_desc_solicita_area">
                            <div class="plachehold_inpdiv">
                                ....descrição
                            </div>
                            <div class="input_div_desc" contenteditable="true"></div>
                            <input type="hidden" value="" name="des_cap_solicita">
                        </div>
                        <div class="area_loja">
                            <div class="loja_inputs">
                                <div class="name_loja">
                                    <input required type="text" value="" name="name_loja_cap_solicita">
                                </div>
                                <div class="link_loja">
                                    <input required type="text" value="" name="name_loja_cap_solicita">
                                </div>
                            </div>
                        </div>
                     </div>
                     <label for="checkBox">
                        <input id="checkBox" type="checkbox" name="checkBox">
                        Deseja reber notificação por email, caso seu jogo seja cadastrado?
                     </label>
                     <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript">
        
    </script>
</body>
</html>