<?php 
    session_start();
    $erro_form = '';
    $nome = '';
    $username ='';
    $email = '';
    $erro = false;
    $errorEmail = false;
    $dia_nas = '';
    $mes_nas = '' ;
    $ano_nas = '';
    if(isset($_SESSION['mensagem']) and !isset($_SESSION['erroEmail'])) {
        $erro = true;
    } elseif(isset($_SESSION['erroEmail'])){
        $erro_form = 'error--login';
        $errorEmail = $_SESSION['erroEmail'];
        $email = $_SESSION['email'];
        $nome = $_SESSION['nome'];
        $dia_nas = $_SESSION['dia_nas'];
        $mes_nas = $_SESSION['mes_nas'] ;
        $ano_nas = $_SESSION['ano_nas'];
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
    <!--Materialize
    <link rel="stylesheet" href="assets/style/bibliotecas/materialize/css/materialize.min.css">
    <link rel="stylesheet" href="assets/style/bibliotecas/materialize/css/materialize.css">
    -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="../assets/style/generic/style.css">
    <link rel="icon" href="../assets/imgs/default/beep_logo.png">
    <link rel="stylesheet" href="../assets/style/dream/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <title>Cadastra-se | Beep</title>
</head>
<body>
<option class="opcao--date"></option>
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
        <form action="../assets/script/php/cadastrar_se_.php" method="POST">
        <div class="body--form">
            <div class="form--area">
                <div class="tutulo--area--form">
                    Cadastrar-se
                </div>
                <div class="input--area--form">
                    <div class="input--form">
                        <input id="nome" value="<?= $nome?>" required placeholder="Nome" type="text"  name="nome_user">
                    </div>
                    <div class="input--form">
                        <input id="email" value="<?= $email?>" class="<?= $erro_form?>" required placeholder="Email" type="email" name="email_user">
                    </div>
                    
                        <?php 
                        if($errorEmail){
                        ?>
                    <div class="mensagem--erro">
                        <?= $_SESSION['mensagem'];?>
                    </div>
                    <?php 
                    session_destroy();
                    }
                    ?>
                    <div class="input--form passoword--form">
                        <input id="passoword--user" required class='' placeholder="Senha" type="password" name="senha_user">
                    </div>
                    <div class="input--form passoword--form">
                        <input id="passoword--user--confirm" required class='' placeholder="Confirmar senha" type="password">
                    </div>
                    <div class="mensagem--erro senha--erro">
                    </div>
                    <div class="mensagem--erro">
                        <?php 
                        if($erro){
                            echo $_SESSION['mensagem'];
                            session_destroy();
                        }
                        ?>
                    </div>
                </div>
                <div class="input--form date--form--area">
                        <div class="title--form">
                            data de nascimento
                        </div>
                        <div class="area--selection--date">
                            <div class="select--date">
                                <label for="mes">
                                    mês
                                </label>
                                <select required id="mes" class="select--sub select--date--mes" name="mes">
                                    <?php 
                                       if(!$mes_nas == ''){
                                    ?>
                                    <option disabled>Anterior</option>
                                    <option><?=$mes_nas?></option>
                                    <option disabled></option>
                                    <?php }?>
                                    <option></option>
                                </select>
                            </div>
                            <div class="select--date">
                                <label for="dia">
                                    dia
                                </label>
                                <select required id="dia" class="select--sub select--date--dia" name="dia">
                                    <?php 
                                       if(!$dia_nas == ''){
                                    ?>
                                    <option disabled>Anterior</option>
                                    <option><?=$dia_nas?></option>
                                    <option disabled></option>
                                    <?php }?>
                                    <option></option>
                                </select>
                            </div>
                            <div required class="select--date ">
                                <label for="ano">
                                    ano
                                </label>
                                <select required id="ano" class="select--sub select--date--ano" name="ano">
                                    <?php 
                                        if(!$ano_nas == ''){
                                    ?>
                                    <option disabled>Anterior</option>
                                    <option><?=$ano_nas?></option>
                                    <option disabled></option>
                                    <?php }?>
                                    <option></option>
                                </select>
                            </div>
                        </div>
                    </div>
                <div class="buttons--area">
                    <div class="entrar--area">
                        <button type="submit">Cadastrar-se</button>
                    </div>
                    <div class="area--button--eC">
                        <div class="button-C">
                            <a href="../">Voltar</a>
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
    <script src="assets/style/bibliotecas/materialize/js/materialize.min.js" text="text/javasctipt"></script>
    <script src="assets/style/bibliotecas/materialize/js/materialize.js" text="text/javasctipt"></script> 
    -->
    <script type="text/javascript" src="../assets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/scriptAll.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/date_script.js"></script>
    <script type="text/javascript" src="../assets/script/javascript/default/valid.js"></script>
</body>
</html>