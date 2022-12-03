<?php 
    session_start();
    if(isset($_SESSION['id_user'])){
        header('location:paginas/inicial.php');
    } else {
    $erro = '';
    $erro_email_s = '';
    $erroEmail = false;
    $erroLogin = false;
    $email = '';
    if(isset($_SESSION['mensagem'])) {
        if(isset($_SESSION['erro_email'])){
            $erroEmail = $_SESSION['erro_email'];
            $erro_email_s = 'error--login';
        } else {
            $erroLogin = true;
            $erro = 'error--login';
        }
        $email = $_SESSION['email'];
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/imgs/default/beep_logo.png">
    <!--Materialize
    <link rel="stylesheet" href="../assets/style/bibliotecas/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="../assets/style/bibliotecas/materialize/css/materialize.css">
    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/dream/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Login | Beep</title>
</head>
<body>
<main>
    <div class="container">
        <div class="body--text">
            <div class="area--text">
                <div class="titulo--beep">
                    <img src="../assets/imgs/default/Beep_logo_title.png">
                </div>
                <div class="text--beep">
                    <p>
                    Com a beep você pode se divertir com seus amigos, e conhecer pessoas novas. Além de ampliar sua perspectiva sobre jogos.
                    </p>
                </div>
            </div>
        </div>
        <form action="#" method="POST">
        <div class="body--form">
            <div class="form--area">
                <div class="tutulo--area--form">
                    Recuperar senha
                </div>
                <div class="input--area--form">
                    <div class="input--form">
                        <input id="email" required class="<?= $erro_email_s?>" value="<?=  $email?>" placeholder="Email" type="email" name="email">
                    </div>
                    <div class="mensagem--erro"></div>
                    <?php 
                        if($erroEmail) {
                    ?>
                    <div class="mensagem--erro">
                        <?php echo $_SESSION['mensagem'];
                        session_destroy();
                        ?>
                    </div>
                    <?php }?>
                </div>
                <div class="buttons--area">
                    <div class="entrar--area">
                        <button type="submit">Entrar</button>
                    </div>
                    <div class="area--button--eC">
                        <div class="button-e">
                            <a href="" >Esqueceu a senha?</a>
                        </div>
                        <div class="button-C">
                            <a href="paginas/cadastrar_se.php">Criar conta</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
    </form>
    </div>
    </main>

    <!--Materialize
    <script src="../assets/style/bibliotecas/materialize/js/materialize.min.js" text="text/javasctipt"></script>
    <script src="../assets/style/bibliotecas/materialize/js/materialize.js" text="text/javasctipt"></script> 
    -->
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/senha.js"></script>
</body>
</html>