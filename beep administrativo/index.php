<?php 
    session_start();
    if(isset($_SESSION['id_root'])){
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
        $email = $_SESSION['email_root'];
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
    <link rel="stylesheet" href="assets/style/bibliotecas/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="assets/style/bibliotecas/materialize/css/materialize.css">
    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="stylesheet" href="../assets/style/dream/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Inicio | Beep Administrativo</title>
</head>
<body>
<main>
    <div class="container">
        <div class="body--text">
            <div class="area--text">
                <div class="titulo--beep">
                    <img src="../assets/imgs/default/lOGO_B_ADM.png" style="width:465px;">
                </div>
                <div class="text--beep">
                    <p>
                        Nossos profissionais trabalham dia e noite para garantir a melhor melhor experiência para os usuários.
                    </p>
                </div>
            </div>
        </div>
        <form action="assets/script/php/login_root.php" method="POST">
        <div class="body--form">
            <div class="form--area">
                <div class="tutulo--area--form">
                    Entrar
                </div>
                <div class="input--area--form">
                    <div class="input--form">
                        <input id="email" required class="<?= $erro_email_s?>" value="<?=  $email?>" placeholder="Email" type="email" name="email--user">
                    </div>
                    <?php 
                        if($erroEmail) {
                    ?>
                    <div class="mensagem--erro">
                        <?php echo $_SESSION['mensagem'];
                        session_destroy();
                        ?>
                    </div>
                    <?php }?>
                    <div class="input--form passoword--form">
                        <input id="passoword--user" required class='input--passoword<?= $erro?>' placeholder="Senha" type="password" name="senha--user">
                        <label for="passoword--user">
                            <div class="olho--senha"></div>
                        </label>
                    </div>
                    <?php 
                        if($erroLogin) {
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
                    </div>
                </div>
            </div>
        </div>
        
    </form>
    </div>
    </main>
    <footer>
        a
    </footer>
    <!--Materialize
    <script src="assets/style/bibliotecas/materialize/js/materialize.min.js" text="text/javasctipt"></script>
    <script src="assets/style/bibliotecas/materialize/js/materialize.js" text="text/javasctipt"></script> 
    -->
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/form_script.js"></script>
</body>
</html>