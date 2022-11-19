<?php 
    $pag_c = pagAtual('curtidas_v.php', true);
    $pag_p = pagAtual('perfil_user_v.php', true);
    $pag_g = pagAtual('perfilJogos_v.php', true);
?>
<div class="info--perfil">
    <div class="info--perfil--area">
        <div class="info--perfil--img">
            <div class="fot_user_visit info--perfil--img--position ">
                <div class="event" style="position:absolute; margin-top: 56px;margin-left: 59px;"></div>
            </div>
        </div>
        <div class="info--perfil--user">
            <div class="info--perfil--user--nome">
                <div class="event"></div>
            </div>
            <div class="info--perfil--user--username">

            </div>
        </div>
        <div class="info--button">
            <form method="post" class="form_id_x30">
                <div class="event"></div>
                <input type="hidden" value="" name='iD_x30' class="input_segui_id_x30">
            </form>
            <div class="button_perfil_ elipse-img" aria-label="Menu">
            </div>
            <div class="menu_perfil_" style="display: none; opacity:0.">
                <div class="exit_menu_perfil"></div>
                <div class="body_menu_perfil">
                    <div class="menu_perfil_opt menu_perfil_denuncia">Denunciar</div>
                    <div class="menu_perfil_opt menu_perfil_block" style="display: none;"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="info--bio--perfil">
        <div class="bio">
            <div class="event"></div>
        </div>
        <div class="data_nasc">
            <div class="event"></div>
        </div>
        <div class="segui--indo">
            <a class='seguidores--info area--segui' href="seguidore/seguindo.php?id_user="><span class="num_seguindo">
                    <div class="event min-event event-block"></div>
                </span> seguindo</a>
            <a class='seguidor--info area--segui' href="seguidore/seguidores.php?id_user="><span class="num_seguidores">
                    <div class="event min-event event-block"></div>
                </span> seguidores</a>
        </div>
    </div>
    <div class="menu--info--perfil--area">
        <a class="button--opt--info  publicacoes_user <?= $pag_p?>">
            Publicações
        </a>
        <a class="button--opt--info game_opt <?= $pag_g?>">
            Jogos do usuário
        </a>
        <a class="button--opt--info curtidas_user <?= $pag_c?>">
            Curtidas
        </a>
        <a class="button--opt--info">
            Sobre
        </a>
    </div>
</div>