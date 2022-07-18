<div class="menu--pag--area">
            <div class="feed-logo-body">
                <div class="logo--area">
                    <div class="logo">
                        <a href="">
                            <img src="<?= pagAtual('caminho');?>../issets/imgs/default/beep_logo.png">
                        </a>
                    </div>
                </div>
            </div>
            <div class="body--menu-pag">
                <div  class="menu--pag-perfil--area">
                <a href="perfil.php" class="perfil-link">
                    <div class="menu--pag menu--pag--event01">
                        <div class="menu--pag--img--area">
                        </div>
                        <div class="menu--pag--name-perfil--area">
                            <div class="menu--pag--name-perfil" >
                                <?=$_SESSION['nome']?>
                            </div>
                            <div class="menu--pag--username-perfil">
                                <?= $_SESSION['username'] ?>
                            </div>
                        </div>
                    </div>
                    </a>
                    <div class=" event--menu-pag menu--pag--opt--menu--area">
                        <div class="menu--pag--opt">
                            <a href="<?= pagAtual('caminho');?>inicial.php" style="color: #fff;" class="<?= pagAtual('inicial.php')?> img--opt-feed img--pag--inicial menu--pag--opt--section">
                                Pagina inicial
                            </a>
                            <a href=''class="<?= pagAtual('jogos.php')?> img--opt-feed img--pag--jogos menu--pag--opt--section">
                                Jogos
                            </a>
                            <a onclick="" class="img--opt-feed img--pag--solic menu--pag--opt--section">
                              Solicitar jogo
                            </a>
                            <a href="<?= pagAtual('caminho');?>perfil.php" class="<?= pagAtual('perfil.php')?> img--opt-feed img--pag--perf menu--pag--opt--section">
                                Perfil
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>