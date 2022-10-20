<!-- <a href="../assets/script/php/logout_root.php">s</a> -->
<?php 
    session_start();
    if(!isset($_SESSION['id_root'])) {
        header('location:../');
        die;
    }
    if(isset($_SESSION['id_root']) && isset($_SESSION['ative'])) {
        header('location:../');
        die;
    }
    // if(isset($_SESSION['ative']) and isset($_SESSION['id_root'])) { 
    //     header('location:inicial.php');
    //     die;
    // }
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Chewy&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="icon" href="../../assets/imgs/default/beep_logo.png">
    <link rel="stylesheet" href="../assets/style/default/style.css">
    <link rel="stylesheet" href="../assets/style/edit/style.css">
    <title>Inicial | Beep Administrativo</title>
</head>

<body>
    <?php 
        require_once '../assets/script/php/generic_HTML/header_default.php';
    ?>
    <main>
        <div class="container">
            <div class="title_main">
                Formulário de edição
            </div>
            <form action="" method="" enctype="multipart/form-data">
                <div class="corpo_list feed-area">
                    <div class="body_area_f">
                        <div class="area_1">
                            <div class="img_area">
                                <div class="img_"
                                    style='background-image:url(../../assets/imgs/games/a7ff90157a71005aa1e43832e637d3b0a862a361.png);'>
                                    <div class='img_edit_area'>
                                        <label for="img_edit">
                                            <div class="event_form_edit add_img"></div>
                                        </label>
                                        <div class="event_form_edit rm_img"></div>
                                        <input required type="file" name="img_edit" id='img_edit'>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="area_2">
                            <div class="nome_slec">
                                <label for="nome_j" class="input_div_area n_game">
                                    <div class="header_area_input">
                                        <span class="name">Nome do jogo</span>
                                        <div class="number_v"><span class='user'>0</span><span
                                                class='sistem'>/300</span></div>
                                    </div>
                                    <input type="text" required name="nome_j" id="nome_j" class="nome_j input_default">
                                </label>
                                <label for="cass_d" class="input_div_area cass_d">
                                    <div class="header_area_input">
                                        <span class="name">Classificação indicativa</span>
                                        <div class="number_v"><span class='user'>0</span><span
                                                class='sistem'>/300</span></div>
                                    </div>
                                    <select class="input_default" required id="cass_d" name="class_etaria">
                                        <option value="0">L</option>
                                        <option>10</option>
                                        <option>12</option>
                                        <option>14</option>
                                        <option>16</option>
                                        <option>18</option>
                                    </select>
                                </label>
                            </div>
                            <label class="inputdiv" id='inputdiv'>
                                <div class="input_div_area desc_area">
                                        <div class="header_area_input">
                                            <span class="name">Descrição do jogo</span>
                                            <div class="number_v"><span class='user'>0</span><span
                                                    class='sistem'>/300</span></div>
                                        </div>
                                    <div class="input_div_desc" contenteditable="true"></div>
                                </div>
                            </label>
                            <input class="input_default hidden_iD" required type="hidden" value=""
                                name="des_cap_solicita">
                            <div class="area_loja">
                            <label for="loja" class="input_div_area loja_area">
                                    <div class="header_area_input">
                                        <span class="name">Loja</span>
                                        <div class="number_v"><span class='user'>0</span><span
                                                class='sistem'>/300</span></div>
                                    </div>
                                <input required class="input_default" id='loja' type="text" name="loja">
                            </label>
                            <label for='l_loja' class="input_div_area l_loja">
                                    <div class="header_area_input">
                                        <span class="name">Link da loja</span>
                                        <div class="number_v"><span class='user'>0</span><span
                                                class='sistem'>/300</span></div>
                                    </div>
                                <input class="input_default" required id='l_loja' type="text" name="loja_link">
                            </label>
                            </div>
                            <button type="submit">Enviar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="error_custom">
            kkkkkkk to doido
        </div>
    </main>

    <script type="text/javascript" src="../../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/edit/script.js"></script>
</body>

</html>