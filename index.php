<?php 
    session_start();
    $erro = '';
    $erro_email_s = '';
    $erroEmail = false;
    $erroLogin = false;
    $email = '';
    if(isset($_SESSION['mensagem'])) {
        if(isset($_SESSION['erro_email'])){
            $erroEmail = true;
            $erro_email_s = 'error--login';
        } else {
            $erroLogin = true;
            $erro = 'error--login';
        }
        $email = $_SESSION['email'];
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Materialize
    <link rel="stylesheet" href="issets/style/bibliotecas/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="issets/style/bibliotecas/materialize/css/materialize.css">
    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="issets/style/generic/style.css">
    <link rel="stylesheet" href="issets/style/dream/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Inicio | Beep</title>
</head>
<body>
<main>
    <div class="container">
        <div class="body--text">
            <div class="area--text">
                <div class="titulo--beep">
                    <h1>Beep</h1>
                </div>
                <div class="text--beep">
                    <p>
                      Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>
                </div>
            </div>
        </div>
        <form action="issets/script/php/login.php" method="POST">
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
                        <input id="passoword--user" required class='<?= $erro?>' placeholder="Senha" type="password" name="senha--user">
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
    <footer>
        a
    </footer>
    <!--Materialize
    <script src="issets/style/bibliotecas/materialize/js/materialize.min.js" text="text/javasctipt"></script>
    <script src="issets/style/bibliotecas/materialize/js/materialize.js" text="text/javasctipt"></script> 
    -->
    <script type="text/javascript" src="/issets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="/issets/script/javascript/default/form--script.js"></script>
</body>
</html>