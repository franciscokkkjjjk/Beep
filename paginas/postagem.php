<?php 
    session_start();
    
    if(!isset($_SESSION['id_user'])) {
        header('location:../');
    } 
    require_once '../assets/script/php/historico.php';    
    require_once '../assets/script/php/conecta.php';
    require_once '../assets/script/php/function/funcoes.php';
    if(!isset($_GET['postagem'])) {
        header('location:inicial.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/imgs/default/beep_logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/feed/style.css">
    <link rel="stylesheet" href="../assets/style/style_posts_completo/style.css">
    <title>Postagem | Beep</title>
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
                <div class="menu--pag--button button--back">
                    <a href="inicial.php" class="seta--back"></a>
                </div>
                Postagem
            </div>
            <div class="feed-body-post">
                <div class="post-completo-area">
                    <div class="post--area-header">
                    <div class="header--post--area">
                                   <div class="post--area--perfil">
                                      <div class="menu--pag--img--area">
                                      </div>
                                    <div class="name--area">        
                                          <a class="perfil-link" href="">        
                                          <div class="name--name-perfil perfil-link-hover">
                                                <div class="event min-event"></div>
                                           </div>
                                           <div class="name--username-perfil perfil-link-hover">
                                                <div class="event min-event"></div>
                                           </div>
                                          </a>
                                       </div>
                                   </div> 
                               <div class="post--area--menu ">
                               <div class="elipse-img-hover elipse-img"></div>
                           </div>                                                              <!--deve ter o nome e @ do usuario e o menu de denuncia de cada usuario-->
                        </div>
                        <div class="body--post-area">
                            <div class="post--text"><div class="event min-event"></div></div>
                            <div class="p-30d_10">
                                <div class="event min-event"></div>
                                  <img class='post--img event--post--img post--img-area' style="display:none;">
                            </div>  
                        </div>
                        <div class="info--post--complete">
                            <div class="interação--info">
                                <div class="curtidas--area">
                                <span class="num--curtidas"><div class="event min-event event-block"></div></span> curtidas
                                </div>
                                <div class="comentarios-area">
                                <span class="num--coment"><div class="event min-event event-block"></div></span> comentários
                                </div>
                                <div class="compartilha-area">
                                    <span class="num--compartilha"><div class="event min-event event-block"></div></span> compartilhamentos
                                </div>
                            </div>
                            <div class="post--game-area">
                                <div class="game">
                                    <div class="event min-event"></div>
                                </div>
                            </div>
                            <div class="post--area--date">
                                   <div class="date--complete">
                                        <div class="event min-event"></div>
                                   </div>
                                   <div class="date--post">
                                        <div class="event min-event"></div>
                                   </div>
                            </div> 
                        </div>
                        <div class="interacao--post--area">
                            <form class="event--curtida event--curtida-comp curtir--hover interac-button">
                                <input type="hidden" value="" name="p-xD30">
                                <button class="curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off">
                                    Curtir
                                </button>
                            </form>
                            <div class="comentar interacao--area">
                                comentar
                            </div>
                            <div  class="compartilhar-hover compartilhar-event-div interac-button  interac-button ">
                                <button class="img-compartilhar-off compartilhar-event img--iteracao img--strong button--remove interacao--area ">    
                                    compartilhar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="post-comentario--area">
                    <div class="coment--area" style="display: none;">
                    <div class="post--area--perfil-coment">
                          <div class="menu--pag--img--area img--perfil img--perfil-red">
                            <div class="back--event postion-none">
                                <div class="event min-event"></div>
                            </div>
                          </div>
                    </div>
                    <div class="body--coment--area">
                        <div class="user--perfil--info name--area">
                            <a class="perfil-link coment-link" style='flex-direction:row;' href=""> 
                                <div class="name--perfil--coment name--name-perfil perfil-link-hover">
                                    <div class="event min-event"></div>
                                </div>
                                <div class="username--perfil--coment name--username-perfil perfil-link-hover">
                                    <div class="event min-event"></div>
                                </div>
                            </a>
                            <div class="time--publi">
                                <div class="date--post"></div>
                                <div class="elipse-img-hover elipse-img elipse--coment"></div>
                            </div>
                        </div>
                        <div class="coment--conteudo">
                            <div class="coment--conteudo--text post--text"><div class="event min-event"></div></div>
                                <div class="post--img-area coment--conteudo--img" style="display:none;">
                                    <div class="post--img" style>
                                    <div class="event--post--img coment--event"></div>
                                </div>
                            </div>  
                        </div>
                        <div class="interacao--post--area interacao--coment">
                            <form class="event--curtida event--curtida-comp curtir--hover interac-button">
                                <input type="hidden" value="" name="p-xD30">
                                <button>
                                    Curtir
                                </button>
                                <div class="post_curtidas area_num" ><div class="event min-event"></div></div>
                            </form>
                            <div class="comentar interacao--area">
                                comentar
                            </div>
                            <div  class="compartilhar-hover compartilhar-event-div interac-button  interac-button ">
                                <button class="img-compartilhar-off compartilhar-event img--iteracao img--strong button--remove interacao--area ">    
                                    compartilhar
                                </button>
                                <div class="post_compartilhadas area_num"><div class="event min-event"></div></div>  
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
        <?php 
            require_once '../assets/script/php/html__generic/recomendado.php';
        ?>
    </div>
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type ="text/javascript" src="../assets/script/javascript/default/coment-script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/event_header.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/posts/posts.js">
    </script>
    <script>
        post_all();
    </script>
    <script>
        const nome = <?php echo '"'.$_SESSION['nome'].'"';?>;
        const email = <?php echo '"'.$_SESSION['email'].'"';?>;
        const username = <?php echo '"'.$_SESSION['username'].'"';?>;
        const img_perfil = <?php echo '"'.$_SESSION['img'].'"';?>;
        const img_banner = <?php echo '"'.$_SESSION['img_banner'].'"';?>;
        const bio = <?php echo '"'.$_SESSION['bio_user'].'"';?>;
        const dateC = <?php echo '"'.date('d/m/Y', strtotime($_SESSION['data_nas'])).'"';?>;
        const m_nas = <?php echo '"'.date('m', strtotime($_SESSION['data_nas'])).'"';?>;
        const d_nas = <?php echo '"'.date('d', strtotime($_SESSION['data_nas'])).'"';?>;
        const y_nas = <?php echo '"'.date('Y', strtotime($_SESSION['data_nas'])).'"';?>;
    </script>
    <script src="../assets/script/javascript/default/edit_form.js">
    </script>
    <script type="text/javascript" src="../assets/script/javascript/default/form_creat.js">
        
    </script>
     
    </body>
</html>