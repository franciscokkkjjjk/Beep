<div class="area--convite">
            <div class="feed-logo-body menu--header">
                <div class="menu">
                    <div class="menu--pag--button-menu--area " >
                        <div class="menu--pag--button button--header">
                            <div class="event--header"></div>
                        </div>
                    </div>
                </div>
                <div class="menu--header--body">
                    <a href='<?= pagAtual('caminho');?>../assets/script/php/logout.php' class="opt--menu-header">
                        <div class="img--menu--header logout"></div>
                        <div class="text--menu--header">logout</div>
                    </a>
                </div>
            </div>
            <div class="convite--body">
                
            </div>
            <div class="convite--body pessoas Recomendados-body">
                <div class="title--recomendados">
                    Recomendados
                </div>
                <div class="body--recomendado">
                <?php 
                    $sql_seguidores_user = "SELECT * 
                                            FROM users 
                                            WHERE id_user 
                                                IN (SELECT seguidores.user_seguido 
                                                    FROM seguidores WHERE user_seguin=".$_SESSION['id_user']." AND seguidores.user_seguido <> ". $_SESSION['id_user'].")
                                                    ORDER BY t_seguidores DESC";
                    $sql_seguidores_seguidores = "SELECT * FROM users WHERE id_user IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin IN (SELECT seguidores.user_seguido FROM seguidores WHERE seguidores.user_seguin = ".$_SESSION['id_user']." AND seguidores.user_seguido <> ".$_SESSION['id_user'].") AND seguidores.user_seguido <> ".$_SESSION['id_user'].") AND id_user <> ".$_SESSION['id_user']." LIMIT 4";
                    $all_users = 'SELECT * FROM users WHERE id_user <> '.$_SESSION['id_user'].' ORDER BY t_seguidores DESC';

                    $resul_seguidores_user = mysqli_query($conexao, $sql_seguidores_user);
                    $resul_seguidores_seguidores = mysqli_query($conexao, $sql_seguidores_seguidores);
                    $resul_all_users = mysqli_query($conexao, $all_users);

                    $array_seguidores_user = mysqli_fetch_all($resul_seguidores_user, 1);
                    $array_seguidores_seguidores = mysqli_fetch_all($resul_seguidores_seguidores, 1);
                    $array_all_users = mysqli_fetch_all($resul_all_users, 1);
                    $array_ante = array();
                    $quantidade = 0;
                    foreach($array_seguidores_seguidores as $value01) {
                        $seguindo = false;
                        foreach($array_seguidores_user as $value02) {
                            if($value01['username'] == $value02['username']) {
                                $seguindo = true;
                          }
                        }
                        
                        if(!$seguindo) {?>
                            <div class="opt--recomedado--area">
                                        <div class="perfil--area">
                                        <div class="img--perfil menu--pag--img--area area--recomendado" style="<?=  perfilDefault($value01['foto_perfil'], pagAtual('caminho'))?>">
                                        </div>
                                        <div class="name--area">
                                        <a class="perfil-link" href="<?= pagAtual('caminho');?>perfil_user_v.php?username=<?=$value01['username']?>"> 
                                                <div class="name--name-perfil perfil-link-hover">
                                                <?=$value01['nome']?>
                                                </div>
                                                <div class="name--username-perfil perfil-link-hover">
                                                    <?=$value01['username']?>
                                                </div>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="buttom-recomendado-area">
                                            <div class="buttom--body">
                                                <form action="<?= pagAtual('caminho');?>../assets/script/php/seguir.php" method="post">
                                                    <button type="submit" class="button--seguir"></button>
                                                <input type="hidden" value="<?= $value01['id_user']?>" name="iD_x30">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                            $quantidade++; 
                            $array_ante['username'] = $value01['username'];
                            ?>
                  <?php }
                    }
                        foreach($array_ante as $value03) {
                            if($quantidade < 4) {
                            $seguindo_01 = false;
                            foreach($array_all_users as $value04) {
                                    if($array_ante['username'] == $value04['username']){
                                        $seguindo_01 = true;
                                    }
                                }
                                if($seguindo_01) { ?>
                                    <div class="opt--recomedado--area">
                                        <div class="perfil--area">
                                        <div class="img--perfil menu--pag--img--area area--recomendado" style="<?=perfilDefault($value04['foto_perfil'], pagAtual('caminho'))?>">
                                        </div>
                                        <div class="name--area">
                                        <a class="perfil-link" href="<?= pagAtual('caminho');?>perfil_user_v.php?username=<?=$value04['username']?>"> 
                                                <div class="name--name-perfil perfil-link-hover">
                                                <?=$value04['nome']?>
                                                </div>
                                                <div class="name--username-perfil perfil-link-hover">
                                                    <?=$value04['username']?>
                                                </div>
                                            </a>
                                        </div>
                                        </div>
                                        <div class="buttom-recomendado-area">
                                            <div class="buttom--body">
                                                <form action="../assets/script/php/seguir.php" method="post">
                                                    <button type="submit" class="button--seguir"></button>
                                                <input type="hidden" value="<?= $value04['id_user']?>" name="iD_x30">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                $quantidade++;
                            }
                        } if($quantidade == 0) {
                            foreach($array_all_users as $value05) {
                                if($quantidade < 4) {
                                    $sql_user = "SELECT t_seguindo FROM users WHERE id_user=".$_SESSION['id_user'];
                                    $res_query_user = mysqli_query($conexao, $sql_user);
                                    $array_query_user = mysqli_fetch_array($res_query_user);
                                    $total = $array_query_user[0];
                                    if($total == 0) {?>
                                        <div class="opt--recomedado--area">
                                                <div class="perfil--area">
                                                <div class="img--perfil menu--pag--img--area area--recomendado" style="<?=perfilDefault($value05['foto_perfil'], pagAtual('caminho'))?>">
                                                </div>
                                                <div class="name--area">
                                                <a class="perfil-link" href="<?= pagAtual('caminho');?>perfil_user_v.php?username=<?=$value05['username']?>"> 
                                                        <div class="name--name-perfil perfil-link-hover">
                                                        <?=$value05['nome']?>
                                                        </div>
                                                        <div class="name--username-perfil perfil-link-hover">
                                                            <?=$value05['username']?>
                                                        </div>
                                                    </a>
                                                </div>
                                                </div>
                                                <div class="buttom-recomendado-area">
                                                    <div class="buttom--body">
                                                        <form action="../assets/script/php/seguir.php" method="post">
                                                            <button type="submit" class="button--seguir"></button>
                                                        <input type="hidden" value="<?= $value05['id_user']?>" name="iD_x30">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php  $quantidade++;
                                    } else {
                                        $seguindo = false;
                                        foreach($array_seguidores_user as $value06) {
                                            if($value05['username'] == $value06['username']) {
                                                $seguindo = true;
                                            }
                                        }
                                        if(!$seguindo) { ?>
                                            <div class="opt--recomedado--area">
                                                <div class="perfil--area">
                                                <div class="img--perfil menu--pag--img--area area--recomendado" style="<?=perfilDefault($value05['foto_perfil'], pagAtual('caminho'))?>">
                                                </div>
                                                <div class="name--area">
                                                <a class="perfil-link" href="<?= pagAtual('caminho');?>perfil_user_v.php?username=<?=$value05['username']?>"> 
                                                        <div class="name--name-perfil perfil-link-hover">
                                                        <?=$value05['nome']?>
                                                        </div>
                                                        <div class="name--username-perfil perfil-link-hover">
                                                            <?=$value05['username']?>
                                                        </div>
                                                    </a>
                                                </div>
                                                </div>
                                                <div class="buttom-recomendado-area">
                                                    <div class="buttom--body">
                                                        <form action="../assets/script/php/seguir.php" method="post">
                                                            <button type="submit" class="button--seguir"></button>
                                                        <input type="hidden" value="<?= $value05['id_user']?>" name="iD_x30">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                          <?php  $quantidade++;
                                        } 
                                    }
                                }
                            }
                        }

                    ?>
                </div>
                <div class="mais--recomendados">
                    <a class="link" style="color: #f0f0f0;" href="">Ver mais</a>
                </div>
            </div>
        </div>
        <div class="modal-area">
                <div class="modal--event"></div>
                <div class="modal--shared">
                        <div class="modal--shared--opt event-direct">
                            compartilhar
                        </div>
                    <div class="modal--shared--opt">
                        compartilhar com comentario
                    </div>
                </div>
              </div>
            <div class="modal-coment modal-coment-coment" style="display: none; opacity:0;">
                    <div class="modal-event-coment"></div>
                    <div class="body-modal-coment">
                        <div class="header-coment">
                            <div class="button-exit">
                                <div class="menu--exit-img"></div>
                            </div>
                            <div class="name--text-coment">
                                Comentário
                            </div>
                            <button class="button--postar-coment button-remove" type="submit">Postar</button>
                        </div>
                        <div class="body--coment">
                            <div class="coment--area">
                                <div class="area-input-div">
                                    <div class="img--perfil menu--pag--img--area"></div>
                                    <div class="area--inputdiv">
                                        Escreva aqui... (provisorio)
                                    </div>
                                </div>
                                <div class="area--img">
                                    <div class="img--coment img--post">
                                        
                                    </div>
                                </div>
                                
                                <div class="area--menu">
                                <div class="menu--post--item coment--menu">
                                    <div class="area--reposta ">
                                        Em resposta a <a class="resposat info--perfil--user--username name--username-perfil perfil-link-hover"><div class="event min-event event-block"></div></a>
                                    </div>
                                    <div class="area--opt">
                                        <label for="img--post-coment">
                                            <div class="opt--menu--item pic" title="Adicionar uma imagem"></div>
                                        <input id="img--post-coment" type="file" style="display: none;" class="input_coment_event_img" name="img_post">
                                        </label>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>