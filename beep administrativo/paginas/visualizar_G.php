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
    <div class="loading">
        <div class="img_lo"></div>
    </div>
<div class="a_xd30">
    <div class="modal_confirm" style="display: none;">
            <div class="event_modal_confirm"></div>
            <div class="modal_">    
                <div class="modal_mensage">
                    Você realmente quer adicionar o jogo sem nenhuma verificação?
                </div>
                <div class="modal_buttons">
                    <div class="confirm_modal">
                        
                    </div>
                    <div class="reject_modal">
                        
                    </div>
                </div>
            </div>
    </div>
</div>
    <header>
      <div class="container row">
        <div class="logo_beep"></div>
        <div class="menu_name_root">
            <a href="inicial.php" class="a_nav">
                <div class="menu_jogos_area body_button_menu">
                        <div class="menu_title_button">
                            Jogos
                        </div>
                </div>
            </a>
            <div class="menu_usuarios_area body_button_menu feed-area">
                <div class="menu_title_button">
                    Denúncias
                </div>
                <a href="" class="a_nav seta_body">
                        <div class="seta down_seta"></div>
                </a>
            </div>
            <div class="menu_show">
            <a href="" class="a_nav seta_body">
                    <div class="seta down_seta"></div>
            </a>
                <div class="menu_area"></div>
            </div>
        </div>
      </div>
    </header>
    <main>
      <div class="container border_c">
            <div class="title_solicitacao">
                Beep testes
            </div>
            <div class="conteudo_b_I">
                <div class="img_area">
                    <img src="../../assets/imgs/posts/62cb2ec3e077e.jpg">
                </div>
                <div class="buttons_area">
                    <div class="buttons_acpt button_a buttons_d border_c"></div>
                    <div class="buttons_rej button_b buttons_d  border_c"></div>
                    <div class="buttons_edit button_d buttons_d border_c"></div>
                </div>
            </div>
            <div class="info_cont">
                <div class="C_1">
                    <div class="descricao_game conteudo_C">
                        <div class="title_C">Teste D</div>
                        <div class="text_C">
                            ....
                        </div>
                    </div>
                    <div class="lojas_game conteudo_C">
                        <div class="title_C">Teste D</div>
                        <div class="text_C">
                            ....
                        </div>
                    </div>
                </div>
                <div class="C_1">
                <div class="quem_game conteudo_C">
                        <div class="title_C">Teste D</div>
                        <div class="text_C">
                            ....
                        </div>
                    </div>
                    <div class="not_game conteudo_C">
                        <div class="title_C">Teste D</div>
                        <div class="text_C">
                            true
                        </div>
                    </div>
                </div>
            </div>
      </div>
    </main>
   
    <script type="text/javascript" src="../../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/all_R/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/visualizar/script.js"></script>
</body>
</html>