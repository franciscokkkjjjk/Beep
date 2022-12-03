<?php 
    session_start();
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    }  
    require_once '../assets/script/php/conecta.php';
    require_once '../assets/script/php/function/funcoes.php';
    require_once '../assets/script/php/html__generic/suspenso_.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitação de jogos | Beep</title>
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
                    <form enctype="multipart/form-data"  action="../assets/script/php/solicita_game.php" class="form_event" method="post">
                     <div class="cap_area">
                            <div class="img_cap_solicita">
                                <label for="img_input_s">
                                    <div class="img_buttons add-imagem"></div>
                                </label>
                                <div class="img_buttons remove-imagem" style="display: none;"></div>
                            </div>
                        <input type="file" name="img_input_s" id="img_input_s" class="img_input_s" style="display: none;">
                     </div>
                     <div class="inputs_area">
                        <div class="input_name_solicita_area input_default_soli">
                            <label for="name_input_s">
                                <span class='title_area'>Nome do jogo</span>

                            </label>
                                <input type="text" id="name_input_s" class="input_name_solicita" required name="name_input_s">
                        </div>
                        <div class="input_desc_solicita_area input_default_soli">
                            <label class="input_div" >
                                 <span class='title_area'>Descrição do jogo</span>
                                 
                            </label>
                            <div class="input_div_desc"  contenteditable="true"></div>
                            <input type="hidden" value=""  class='hidden_iD' name="des_cap_solicita">
                        </div>
                        <div class="classInd input_default_soli">
                                    <label for="classI">
                                        <span class='title_area'>Classificação Indicativa</span>
                                    </label>
                                    <select   required  id="classI" name="class_etaria">
                                        <option value="0">L</option>
                                        <option>10</option>
                                        <option>12</option>
                                        <option>14</option>
                                        <option>16</option>
                                        <option>18</option>
                                    </select>
                                </div>
                        <div class="area_loja">
                            <div class="loja_inputs">
                                <div class="name_loja input_default_soli">
                                    <label for="name_loja_cap_solicita">
                                        <span class='title_area'>Nome da loja do jogo</span>
                                    </label>
                                    <input class="name_loja_event" required type="text" id="name_loja_cap_solicita" value="" name="name_loja_cap_solicita">
                                </div>
                                <div class="link_loja input_default_soli">
                                    <label for="link_loja">
                                        <span class='title_area'>Link da loja</span>
                                    </label>
                                    <input id='link_loja' placeholder="https://link_loja" required type="text" value="" id="link_loja" name="name_link_cap_solicita">
                                </div>
                            </div>
                        </div>
                        
                     </div>
                     <label for="checkBox" class="check_area">
                        <input id="checkBox" type="checkbox" name="checkBox">
                        <div class="check_box_text">
                            Deseja receber notificação por email, caso seu jogo seja cadastrado?
                        </div>
                    </label>
                     <button class="button_submit" type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php 
                 if(isset($_SESSION['menssagem'])) {
                    if(isset($_SESSION['fal'])){  unset($_SESSION['fal']);
                ?>
                <div class="mensagem_alert remove_tmp" style="background-color: #f00; color:#fff;"><?= $_SESSION['menssagem']?></div>
                <?php 
                    } else {
                ?>
                <div class="mensagem_alert remove_tmp"><?= $_SESSION['menssagem']?></div>
                <?php }?>
                <script>
                    function remove() {
                    setTimeout(()=>{
                        document.querySelector('.remove_tmp').remove();
                    },4500)
                }
                remove();
                </script>
                <?php 
                unset($_SESSION['menssagem']);
                 }
                ?>
    </div>
    
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/solicita_game/script.js">alert('dsasda')</script>
</body>
</html>