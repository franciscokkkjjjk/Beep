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
                            
                        </div>
                    </div>
                </div>
                <button type="submit">Enviar</button>
            </form>
        </div>

    </main>

    <script type="text/javascript" src="../../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/default/script.js"></script>
</body>

</html>