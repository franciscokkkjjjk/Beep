<?php 
    session_start();
    $erro = '';
    $errosenha = false;
    if(isset($_SESSION['mensagem'])) {
        $errosenha = true;
        $erro = 'error--login';
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
    <link rel="stylesheet" href="../issets/style/generic/style.css">
    <link rel="stylesheet" href="../issets/style/dream/style.css">
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
                    <h1>Beep</h1>
                </div>
                <div class="text--beep">
                    <p>
                      Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    </p>
                </div>
            </div>
        </div>
        <form action="../issets/script/php/cadastrar_se_.php" method="POST">
        <div class="body--form">
            <div class="form--area">
                <div class="tutulo--area--form">
                    Cadastrar-se
                </div>
                <div class="input--area--form">
                    <div class="input--form">
                        <input id="nome" required placeholder="Nome" type="text"  name="nome_user">
                    </div>
                    <div class="input--form">
                        <input id="email" required placeholder="Email" type="email" name="email_user">
                    </div>
                    <div class="input--form passoword--form">
                        <input id="passoword--user" required class='<?= $erro?>' placeholder="Senha" type="password" name="senha_user">
                    </div>
                    <div class="input--form passoword--form">
                        <input id="passoword--user--confirm" required class='<?= $erro?>' placeholder="Confirmar senha" type="password">
                    </div>
                    <div class="mensagem--erro">
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
                                    <option></option>
                                </select>
                            </div>
                            <div class="select--date">
                                <label for="dia">
                                    dia
                                </label>
                                <select required id="dia" class="select--sub select--date--dia" name="dia">
                                    <option></option>
                                </select>
                            </div>
                            <div required class="select--date ">
                                <label for="ano">
                                    ano
                                </label>
                                <select required id="ano" class="select--sub select--date--ano" name="ano">
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
    <script src="issets/style/bibliotecas/materialize/js/materialize.min.js" text="text/javasctipt"></script>
    <script src="issets/style/bibliotecas/materialize/js/materialize.js" text="text/javasctipt"></script> 
    -->
    <script type="text/javascript" src="../issets/script/javascript/default/script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/date_script.js"></script>
    <script type="text/javascript" src="../issets/script/javascript/default/valid.js"></script>
</body>
</html>