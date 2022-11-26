<?php
session_start();
if (!isset($_SESSION['id_root'])) {
    header('location:../');
    die;
}
if (isset($_SESSION['id_root']) && isset($_SESSION['ative'])) {
    header('location:../');
    die;
}
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
    <link rel='stylesheet' href="../../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/default/style.css">
    <link rel="stylesheet" href="../assets/style/inicial_root/style.css">
    <link rel="stylesheet" href="../assets/style/visualizar/style.css">
    <link rel="stylesheet" href="../assets/style/visualizar/d_style.css">
    <style>
        .container {
            min-height: auto !important;
        }
    </style>
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
        <div class="container border_c feed-area post_d">
            <div class="title_solicitacao">
                Informações da Postagem denunciada <span class="quarentena"></span>
            </div>
            <div class="conteudo_b_I">
                <div class="img_area">
                    <div class='title_midia'>Foto de perfil </div>
                </div>
                <div class="img_area banner_">
                    <div class='title_midia'>Banner de perfil </div>

                </div>
                <div class="buttons_area">
                    <nav>
                        <a href="" class="a_nav buttons_sus button_a buttons_d border_c"></a>
                    </nav>
                    <nav>
                        <a href="" class="a_nav">
                            <div class="buttons_edit button_d buttons_d border_c"></div>
                        </a>
                    </nav>
                    <nav>
                        <a href="" class="a_nav button_C">
                            <div class="buttons_visualizar_p button_d buttons_d border_c"></div>
                        </a>
                    </nav>
                </div>
            </div>
            <div class="info_cont ">
                <div class="C_1">
                    <div class="conteudo_1 conteudo_C">
                        <div class="title_C">Nome do usuário</div>
                        <div class="text_C">

                        </div>
                    </div>
                    <div class="conteudo2 conteudo_C">
                        <div class="title_C">Data de nascimento</div>
                        <div class="text_C">

                        </div>
                    </div>
                    <div class="conteudo3 conteudo_C">
                        <div class="title_C">E-mail</div>
                        <div class="text_C">

                        </div>
                    </div>
                </div>
                <div class="C_1">

                    <div class="conteudo4 conteudo_C">
                        <div class="title_C">Bio do usuário.</div>
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
        <div class="container border_c feed-area motivos_info">
            <div class="title_solicitacao">
                Motivos pelo quais foi denúnciado
            </div>
            <div class="info_cont m_area">
                <div class="C_1">
                    <div class="conteudo_1 conteudo_C">
                        <div class="title_C">Motivo mais selecionado</div>
                        <div class="text_C">

                        </div>
                    </div>
                    <div class="conteudo2 conteudo_C">
                        <div class="title_C">Quantidade de denúncias</div>
                        <div class="text_C">

                        </div>
                    </div>

                    <div class="motivos_area">
                        <div class="motivo_ conteudo_C">
                            <div class="title_C motivo_title00">Usuário que denúnciou:</div>
                            <div class="text_C motivo_text00">
                            </div>
                            <div class="title_C motivo_title01">Motivo selecionado</div>
                            <div class="text_C motivo_text01">aaaaaaaaaaaaaaaa

                            </div>
                            <div class="title_C motivo_title02">O que aconteceu:</div>
                            <div class="text_C motivo_text02">
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="area_publicações_user">

        </div>
    </main>
    <div class="area_publicação" style="display: none; opacity:0;">
        <div class="area_fundo"></div>
        <div class="header_ultra_pag">
            <div class="close_pag">
                <div class="area_exit_"></div>
            </div>
        </div>
        <div class="feed-body-post">
            <?php
            require_once '../../assets/script/php/html__generic/posts_template.php';
            ?>
        </div>
    </div>
    <div class="modal_sus" style="">
        <div class="modal_exit" style="background-color:#0000008f;position: fixed;width:100%;height:100%;top:0px;left:0px;"></div>
        <div class="modal_sus_defato">
            <div class="modal_sus_header">
                <div class="modal_area_exit">
                    <div class="button_exit modal_exit"></div>
                </div>
                <button class="button_enviar_sus">Suspender</button>
            </div>
            <div class="modal_sus_body">
                <div class="title_modal_sus">
                    Tempo de suspenão:
                </div>
                <select>
                    <option value="1">1 dia</option>
                    <option value="15">15 dias</option>
                    <option value="30">30 dias</option>
                    <option value="60">60 dias</option>
                    <option value="100">100 dias</option>
                    <option value="200">200 dias</option>
                    <option value="300">300 dias</option>
                    <option value="365">365 dias</option>
                    <option value="NULL">indeterminado</option>
                </select>
            </div>
        </div>
    </div>
    <?php
    if (isset($_SESSION['mensagem'])) {
    ?>
        <div class="session mensagem_alert" style='<?= isset($_SESSION['error']) ? 'background-color: #B22222;' : '' ?>'><?= $_SESSION['mensagem'] ?></div>
        <script>
            setTimeout(() => {
                document.querySelector('.session').remove();
            }, 2500)
        </script>
    <?php
        unset($_SESSION['mensagem']);
        unset($_SESSION['error']);
    }
    ?>
    <script type="text/javascript" src="../../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/all_R/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/generic_/script.js"></script>
    <script type="text/javscript" src="../assets/script/javascript/visualizar/posts_.js"></script>
    <script type='text/javascript' src="../assets/script/javascript/visualizar/scriptD_U.js"></script>
</body>

</html>