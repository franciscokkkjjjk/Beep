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
    <title>Lista | Beep Administrativo</title>
</head>
<body>
    <?php 
        require_once '../assets/script/php/generic_HTML/header_default.php';
    ?> 
    <main>
        <div class="container"> 
            <div class="title_main">
                Jogos
            </div>    
            <div class="corpo_list feed-area">
                <div class="list_area">
                    <div class="area_list_info_1">
                        <div class="list_img">
                            <div class="event"></div>
                        </div>
                        <div class="list_title">
                            <div class="event"></div>
                        </div>
                    </div>
                    <div class="area_list_info_2">
                        <nav>
                            <a href="" class="a_nav button_c button_int">
                                <div class=" img_">
                                </div>
                            </a>
                        </nav>
                    </div>
                </div>
                </div>
        </div>
    </main>
    <?php 
        require_once '../assets/script/php/generic_HTML/extras.php';
    ?>
    <script type="text/javascript" src="../../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/all_R/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/inicial/script.js"></script>
    </script>
</body>
</html>