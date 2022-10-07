<form action="assets/script/php/login_root.php" method="POST">
        <div class="body--form">
            <div class="form--area">
                <div class="tutulo--area--form">
                    Cadastrar uma senha
                </div>
                <div class="input--area--form">
                    <div class="input--form">
                        <input id="pass_key" required placeholder="Senha" type="password" name="pass--root">
                    </div>
                    <div class="input--form passoword--form">
                        <input id="passoword--root_c" required class='input--passoword' placeholder="Confirmar senha" type="password" name="senha--root_c">
                    </div>
                    <?php 
                        if(isset($_SESSION['error_pass'])) {
                    ?>
                    <div class="mensagem--erro">
                        <?php echo $_SESSION['mensagem'];
                            unset($_SESSION['mensagem']);
                            unset($_SESSION['error_pass'])
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