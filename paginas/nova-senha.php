<?php
session_start();
if (isset($_SESSION['id_user'])) {
    header('location: inicial.php');
} else {
    $erro = '';
    $erro_email_s = '';
    $erroEmail = false;
    $erroLogin = false;
    $email = '';
    if (isset($_SESSION['mensagem'])) {
        if (isset($_SESSION['erro_email'])) {
            $erroEmail = $_SESSION['erro_email'];
            $erro_email_s = 'error--login';
        } else {
            $erroLogin = true;
            $erro = 'error--login';
        }
        $email = $_SESSION['email'];
    }
}
// verificar se o email e token batem com banco
$email = $_GET['email'];
$token = $_GET['token'];

require_once "../assets/script/php/conecta.php";

$sql = "SELECT * FROM pass_recuperar WHERE "
    . "email='$email' AND token='$token'";
$resultSet = mysqli_query($conexao, $sql);
$reset = mysqli_fetch_assoc($resultSet);
if (!is_null($reset)) {
    // verificar se jah está expirado
    $hoje = new DateTime();
    $dataExpiracao = new DateTime($reset['dataExpiracao']);
    if ($hoje < $dataExpiracao) { // ainda é válida
        // continua...
    } else { // expirou o pedido de recuperação
        $_SESSION['mensagem'] = "Pedido de recuperação de senha expirado! "
            . "Realize o pedido de recuperação de senha novamente.";
    }
} else { // se não existe esse pedido de reset
    $_SESSION['mensagem'] = "Pedido de recuperação de senha inválido!";
    header('location: recuperar_senha.php');
}
// exibir o formulario de redefinição de senha
// encaminha para o arquivo que redefine a senha
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Chewy&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
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
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <title>Nova senha | Beep</title>
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
                            Com a beep você pode se divertir com seus amigos, e conhecer pessoas novas. Além de ampliar
                            sua perspectiva sobre jogos.
                        </p>
                    </div>
                </div>
            </div>
            <form action="" method="POST">
                <div class="body--form">
                    <div class="form--area">
                        <div class="tutulo--area--form">
                            Redefinir senha
                        </div>
                        <div class="input--area--form">
                            <div class="input--form">
                                <input id="passoword--user" required class="<?= $erro_email_s ?>" value=""
                                    placeholder="Senha" type="password" name="senha">
                            </div>
                            <div class="mensagem--erro"></div>
                            <div class="input--form">
                                <input id="passoword--user--confirm" required class="<?= $erro_email_s ?>" value=""
                                    placeholder="Confirmar senha" type="password" name="senha_">
                                <input type="hidden" name="token" value="<?= $token ?>">
                                <input type="hidden" name="email" value="<?= $email ?>">
                            </div>
                            <div class="mensagem--erro"></div>
                            <?php
                            if ($erroEmail) {
                            ?>
                            <div class="mensagem--erro">
                                <?php echo $_SESSION['mensagem'];
                                session_destroy();
                                ?>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="buttons--area">
                            <div class="entrar--area">
                                <button type="submit">Recuperar senha</button>
                            </div>
                            <div class="area--button--eC">
                                <div class="button-C">
                                    <a href="../index.php">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div class="loading_" style="display:none">
            <div class="body_loading">
                <div class="event"></div>
                <div class="loding aguar">Aguarde</div>
                <div class="loding foi" style="display: none;"></div>
            </div>
        </div>
    </main>

    <!--Materialize
    <script src="../assets/style/bibliotecas/materialize/js/materialize.min.js" text="text/javasctipt"></script>
    <script src="../assets/style/bibliotecas/materialize/js/materialize.js" text="text/javasctipt"></script> 
    -->
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/valid.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/senha_C.js"></script>

</body>

</html>