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
                    <div class="modal--shared--opt event--repost--coment">
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
                            <div class="coment--area-modal">
                                <div class="area-input-div">
                                    <div class="img--perfil menu--pag--img--area"></div>
                                    <div class="area--inputdiv">
                                        No que você está pensando, <?= $_SESSION['username']?>?
                                    </div>
                                    <input type="hidden" value='' class='input_div_info' name='p_xD30_info_'>
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
                <?php 
                 if(isset($_SESSION['menssagem'])) {
                    if(isset($_SESSION['fal'])){  unset($_SESSION['fal']);
                ?>
                <div class="mensagem_alert remove_tmp" style="background-color: #f00; color:#fff;"><?= $_SESSION['menssagem']?></div>
                <?php 
                    } else {
                ?>
                <div class="mensagem_alert remove_tmp"><?= $_SESSION['menssagem']?></div>
                <?php }?>
                <script>
                    function remove() {
                    setTimeout(()=>{
                        document.querySelector('.remove_tmp').remove();
                    },4500)
                }
                remove();
                </script>
                <?php 
                unset($_SESSION['menssagem']);
                 }
                ?>
                <div class="modal--coment--repost--area" style="opacity: 0; display:none;">
                    <div class="exit--modal--repost--coment"></div>
                    <div class="area--modal--coment--repost">
                        <div class="header--modal--coment--repost">
                            <div class="exit--area--body_coment">
                                <div class="menu--exit-img "></div>
                            </div>
                            <div class="title--coment--repost">Compartilhar com comentário</div>
                            <div class="submit--button--comet--area">
                                <div class="event min-event" style="margin-right: 5px;"></div>
                                <button type="submit">Enviar</button>
                            </div>
                        </div>
                        <div class="body--repost--coment">
                            <div class="area--body--repost--coment">
                                <div class="area--perfil--coment--repost">
                                <a href="perfil.php">
                                        <div class="menu--pag--img--area"></div>
                                </a>
                                </div>
                                <div class="area--divinput--coment--repsot">
                                    <div class="placeholder--editediv">
                                        No que você está pensando, <?= $_SESSION['username']?>?
                                    </div>
                                    <div class="diveditable--coment--repost" contenteditable="true" style="display: none;">
                                    </div>
                                    <input type="hidden" class="input_hidden_coment_compartilhada" value="" name="cC_xd30">
                                </div>
                            </div>
                            <div class="are_img_comentario_repost">
                                <div class="post_img_area"></div>
                            </div>
                            <div class="area--post--respostado" style="display: flex; justify-content:center;">
                                <div class="back--event event-block" style="position: inherit;">
                                    <div class="event"></div>
                                </div>
                                <div class="area--perfil--repostado" style="display: none;">
                                    <div class="perfil--respostado">
                                     <a href="" class="perfil-link repost--link" style="width: 40px;">
                                        <div class="area--perfil--repost">
                                            <div class="menu--pag--img--area img--perfil-reduz"></div>
                                        </div>
                                        <div class="area--name--reost">
                                            <div class="name--name-perfil-comp perfil-link-hover">
                                                <div class="event"></div>
                                            </div>
                                            <div class="name--username-perfil-comp perfil-link-hover">
                                                <div class="event"></div>
                                            </div>
                                        </div>
                                     </a>
                                    </div>
                                    <div class="body--post--comp">
                                        <div class="post--text post--text--comp_2"></div>
                                        <div class="post--img-area post--img-area-com">
                                            <div class="post--img">
                                                <div class="event--post--img"></div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="area--opt--comet--repost">
                                    <label for="midia_compatilhamento_coment">
                                            <div class="opt--menu--item pic" title="Adicionar uma midia"></div>
                                        <input id="midia_compatilhamento_coment" type="file" style="display: none;" class="input_coment_event_mid" name="midia_repost">
                                    </label>
                            </div>
                        </div>
                    </div>
                </div>
