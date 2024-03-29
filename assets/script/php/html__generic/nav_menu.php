<div class="menu--pag--area">
    <div class="feed-logo-body">
        <div class="logo--area">
            <div class="logo">
                <a href="">
                    <img src="<?= pagAtual('caminho'); ?>../assets/imgs/default/beep_logo.png">
                </a>
            </div>
        </div>
    </div>
    <div class="body--menu-pag">
        <div class="menu--pag-perfil--area">
            <a href="perfil.php" class="perfil-link">
                <div class="menu--pag menu--pag--event01">
                    <div class="menu--pag--img--area">
                    </div>
                    <div class="menu--pag--name-perfil--area">
                        <div class="menu--pag--name-perfil">
                            <?= $_SESSION['nome'] ?>
                        </div>
                        <div class="menu--pag--username-perfil">
                            <?= $_SESSION['username'] ?>
                        </div>
                    </div>
                </div>
            </a>
            <div class=" event--menu-pag menu--pag--opt--menu--area">
                <div class="menu--pag--opt">
                    <a href="<?= pagAtual('caminho'); ?>inicial.php" style="color: #fff;" class="<?= pagAtual('inicial.php') ?> img--opt-feed img--pag--inicial menu--pag--opt--section">
                        <span class="text_title_nav">Pagina inicial<span>
                    </a>
                    <a href="<?= pagAtual('caminho'); ?>pesquisa.php" class="<?= pagAtual('pesquisa.php') ?> img--opt-feed img--pag--pes menu--pag--opt--section">
                        <span class="text_title_nav">Pesquisar</span>
                    </a>
                    <a class="img--opt-feed img--pag--sal menu--pag--opt--section <?= pagAtual('publicacoes_salvas.php') ?>" href='<?= pagAtual('caminho');?>publicacoes_salvas.php'>
                        <span class="text_title_nav">Publicações salvas</span>
                    </a>
                    <a href='<?= pagAtual('caminho'); ?>jogos.php' class="<?= pagAtual('jogos.php') ?> img--opt-feed img--pag--jogos menu--pag--opt--section">
                        <span class="text_title_nav">Jogos</span>
                    </a>
                    <a href="<?= pagAtual('caminho'); ?>solicitacaoJogos.php" class="<?= pagAtual('solicitacaoJogos.php') ?> img--opt-feed img--pag--solic menu--pag--opt--section">
                        <span class="text_title_nav">Solicitar jogo</span>
                    </a>
                    <a href="<?= pagAtual('caminho'); ?>perfil.php" class="<?= pagAtual('perfil.php') . pagAtual('curtidas.php') . pagAtual('perfilJogos.php') ?> img--opt-feed img--pag--perf menu--pag--opt--section">
                        <span class="text_title_nav">Perfil </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>