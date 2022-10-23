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
    <link rel="stylesheet" href="../assets/style/inicial_root/style.css">
    <title>Inicial | Beep Administrativo</title>
</head>

<body>
    <div class="loading">
        <div class="img_lo"></div>
    </div>
    <?php 
        require_once '../assets/script/php/generic_HTML/header_default.php';
    ?> 
    <main>
        <div class="container border_c feed-area">
            <div class="title_solicitacao">
                Beep testes
            </div>
            <div class="conteudo_b_I">
                <div class="img_area">

                </div>
                <div class="buttons_area">
                    <nav>
                        <a href="" class="a_nav buttons_acpt button_a buttons_d border_c"></a>
                    </nav>
                    <nav>
                        <a href="" class="a_nav buttons_rej button_b buttons_d  border_c"></a>
                    </nav>
                    <nav>
                        <a href="" class="a_nav">
                            <div class="buttons_edit button_d buttons_d border_c"></div>
                        </a>
                    </nav>
                </div>
            </div>
            <div class="info_cont">
                <div class="C_1">
                    <div class="conteudo_1 conteudo_C">
                        <div class="title_C"></div>
                        <div class="text_C">

                        </div>
                    </div>
                    <div class="conteudo2 conteudo_C">
                        <div class="title_C"></div>
                        <div class="text_C">

                        </div>
                    </div>
                </div>
                <div class="C_1">
                    <div class="conteudo3 conteudo_C">
                        <div class="title_C"></div>
                        <div class="text_C">

                        </div>
                    </div>
                    <div class="conteudo4 conteudo_C">
                        <div class="title_C"></div>
                        <div class="text_C">

                        </div>
                    </div>
                    <div class="conteudo5 conteudo_C">
                        <div class="title_C"></div>
                        <div class="text_C">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php 
        require_once '../assets/script/php/generic_HTML/extras.php';
    ?>
        <?php 
            if(isset($_SESSION['mensagem'])) {
        ?>
            <div class="session mensagem_alert" style='<?= isset($_SESSION['error']) ? 'background-color: #B22222;' : '' ?>'><?=$_SESSION['mensagem']?></div>
            <script>
                setTimeout(()=>{
                    document.querySelector('.session').remove();
                }, 2500)
            </script>
        <?php
        unset($_SESSION['mensagem']);
        unset($_SESSION['error']);
            } 
        ?>
    <script type="text/javascript" src="../../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/all_R/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/visualizar/script.js"></script>
</body>

</html>