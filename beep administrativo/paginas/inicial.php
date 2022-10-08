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
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="icon" href="../../assets/imgs/default/beep_logo.png">
    <link rel="stylesheet" href="../assets/style/default/style.css">
    <link rel="stylesheet" href="../assets/style/inicial_root/style.css">
    <title>Inicial | Beep Administrativo</title>
</head>
<body>
    <header>
        <div class="logo_beep"></div>
        <div class="menu_name_root">
            <div class="menu_jogos_area body_button_menu">
                <div class="menu_title_button">
                    Jogos
                </div>
                <a href="">
                    <div class="seta_body color_96f">
                        <div class="seta down_seta"></div>
                    </div>
                </a>
            </div>
            <div class="menu_usuarios_area body_button_menu">
                <div class="menu_title_button">
                    Denúncias
                </div>
                <a href="">
                    <div class="seta_body color_96f">
                        <div class="seta down_seta"></div>
                    </div>
                </a>
            </div>
            <div class="menu_show">
            <a href="">
                <div class="seta_body ">
                    <div class="seta down_seta"></div>
                </div>
            </a>
                <div class="menu_area"></div>
            </div>
        </div>
    </header>
</body>
</html>