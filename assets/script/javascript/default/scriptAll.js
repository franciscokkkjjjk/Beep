// const nome = <?php echo '"'.$_SESSION['nome'].'"';?>;
// const email = <?php echo '"'.$_SESSION['email'].'"';?>;
// const img_perfil = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['img'].'"';} else {echo 'null';}?>;
// const img_banner = <?php if(isset($_SESSION['img'])){echo '"'.$_SESSION['img_banner'].'"';} else{echo 'null';}?>;
// console.log(img_banner);
// const bio = <?php echo '`'.$_SESSION['bio_user'].'`';?>;
// const dateC = <?php echo '"'.date('d/m/Y', strtotime($_SESSION['data_nas'])).'"';?>;
// const m_nas = <?php echo '"'.date('m', strtotime($_SESSION['data_nas'])).'"';?>;
// const d_nas = <?php echo '"'.date('d', strtotime($_SESSION['data_nas'])).'"';?>;
// const y_nas = <?php echo '"'.date('Y', strtotime($_SESSION['data_nas'])).'"';?>;

function post_not(timeline) {
    let nada = document.createElement('div');
    nada.classList.add('nada');
    if (timeline == 0) {
        nada.innerHTML = 'Por enquanto não há nada por aqui. :(';
    }
    if (timeline == 'coment') {
        nada.innerHTML = 'Seja o primeiro a interagir com esse usuário!';
    }
    if (timeline == 1) {
        nada.innerHTML = 'Esse usuário não fez nenhuma publicação. :(';
    }
    if (timeline == 2) {
        nada.innerHTML = 'Esse usuário não curtiu nenhuma publicação. :(';
    }
    if (timeline == 3) {
        nada.innerHTML = "OPS! Parece que nenhum jogo foi cadastrado ainda. Solicite o cadastro de um jogo em <a href='solicitacaoJogos.php'>aqui</a>.";
        document.querySelector('.feed-body-post').style.gridTemplateColumns = 'none';
    }
    if (timeline == 4) {
        nada.innerHTML = "Esse usuário não possue nenhum jogo. :(";
    }
    if (timeline == 5) {
        nada.innerHTML = 'Nada foi encontrado. :(';
    }
    document.querySelector('.feed-body-post').appendChild(nada);
}

function showImg_form(e, a, c) {
    let inpu = e;
    let exit = document.createElement('div');
    exit.setAttribute('class', 'exit--previu');
    let exit_img = document.createElement('div');
    exit_img.setAttribute('class', 'menu--exit-img');
    exit.appendChild(exit_img);
    return e.onchange = function () {
        let midia;
        let img = e.files[0];
        console.log(img);
        let seguir;
        console.log(img.type);
        if (img.type == 'image/jpeg' || img.type == 'image/gif' || img.type == 'image/png' || img.type == 'image/jfif') {
            console.log('é uma img');
            seguir = true
            midia = document.createElement('img');
        } else if (img.type == 'video/mp4') {
            console.log('isso é um video');
            midia = document.createElement('video');
            midia.setAttribute('controls', '');
            seguir = true;
        } else {
            seguir = false;
        }
        if (seguir) {
            let src = URL.createObjectURL(img);
            midia.setAttribute('src', src);
            a.appendChild(exit);
            a.appendChild(midia);
            console.log(e.value);
            qs('.button--post--form').disabled = false;
            qs('.button--post--form').style.backgroundColor = '#53ffff';
            qs('.button--post--form').style.cursor = 'pointer';
            exit.addEventListener('click', (e = e) => {
                inpu.value = '';
                midia.remove();
                exit.remove();
                if (c) {
                    let value = qs('.inputdiv--form--post');
                    if (value != undefined) {
                        if (value.innerText.trim() == '' && inpu.value == '') {
                            qs('.inputdiv--form--post').innerText = '';
                            qs('.button--post--form').disabled = true;
                            qs('.button--post--form').style.backgroundColor = '';
                            qs('.button--post--form').style.cursor = '';
                            qs('.button--post--form').style.cursor = '';
                        }
                    } else {
                        if (qs('.input_img_event').value == '') {
                            qs('.button--post--form').disabled = true;
                            qs('.button--post--form').style.backgroundColor = '';
                            qs('.button--post--form').style.cursor = '';
                            qs('.button--post--form').style.cursor = '';
                        }
                    }

                }
            }, true)
        } else {
            let alerta = {
                mensage: 'A Beep aceita apenas formato gif, mp4, png, jpeg, jpg e jfif.',
                error: true
            }
            if (document.getElementById('img--post-coment') != undefined) {
                document.getElementById('img--post-coment').value = '';
            }
            document.getElementById('img--post').value = '';
            alert_mensage(alerta);
        }
    }

}
let timer;

function alert_mensage(json) {
    if (json.reset != undefined) {
        window.location.reload()
        return;
    }
    let creat_mensage = document.createElement('div');
    creat_mensage.classList.add('mensagem_alert');
    if (json.mensage != undefined) {
        creat_mensage.innerHTML = json.mensage;
        if (qs('.mensagem_alert') == undefined) {
            if (json.error) {
                creat_mensage.style.backgroundColor = '#f00';
                creat_mensage.style.color = '#fff';
            }
            qs('.feed-area').appendChild(creat_mensage);
        } else {
            qs('.mensagem_alert').innerHTML = json.mensage;
            if (json.error) {
                qs('.mensagem_alert').style.backgroundColor = '#f00';
                qs('.mensagem_alert').style.color = '#fff';
            } else {
                qs('.mensagem_alert').style.backgroundColor = '';
                qs('.mensagem_alert').style.color = '';
            }
            clearTimeout(timer);

        }
        timer = setTimeout(() => {
            if (qs('.mensagem_alert') != undefined) {
                qs('.mensagem_alert').remove();
            }
        }, 4000);
    }
}

function img_viw_modal(area_add, input_file, remove_a) { //adiciona uma imagem em algum lugar
    let file_input = input_file;
    let anterior_;
    file_input.onchange = () => {
        let seguir = false;
        let img = input_file.files[0];
        let src = URL.createObjectURL(img);
        console.log(img.type);
        if (img.type == 'image/jpeg' || img.type == 'image/gif' || img.type == 'image/png' || img.type == 'image/jfif') {
            seguir = true;
        } else {
            console.log('o de')
            console.log(anterior_);
            if (anterior_ == undefined) {
                input_file.value = '';
            } else {
                qs(remove_a).style.display = 'none';
                input_file.value = '';
                qs(area_add).style.backgroundImage = '';
                console.log(input_file.files[0]);
            }
            seguir = false;
            let res = {
                'error': true,
                'mensage': "A beep não aceita o formato do arquivo que foi inserido."
            }
            alert_mensage(res);
        }

        if (seguir) {
            anterior_ = input_file.files[0];
            console.log(anterior_);
            let area_img = document.querySelector(area_add);
            if (area_img != undefined) {
                area_img.style.backgroundImage = `url(${src})`;
                let remove = qs(remove_a);
                if (remove != undefined) {
                    remove.style.display = 'block';
                    remove.onclick = () => {
                        remove.style.display = 'none';
                        input_file.value = '';
                        qs(area_add).style.backgroundImage = '';

                    }
                }
            }
        }
    }
}

function input_ac(e, a) {
    e.addEventListener('focus', () => {
        a.classList.add('active--input'); //
        a.classList.add('color_font_input_act');
    })
    e.addEventListener('blur', () => {
        a.classList.remove('active--input');
        a.classList.remove('color_font_input_act');
    })
    return;
}

function input_div_puts(input_div, input_hidden) {
    input_div.onblur = (e) => {
        let value_input = e.target.innerText;
        console.log(value_input);
        input_hidden.value = value_input;
        console.log(value_input);
    }
}

function mensagem_element(elementDom, mensagem) { //gera uma caixa de dialago customizada kkkkk ele segue a mesma logica da caixa de dialago do compartilhar
    let area = document.createElement('div');
    area.classList.add('error_custom');
    area.textContent = mensagem;
    let heightA = area.getBoundingClientRect().height;
    const ele = elementDom.getBoundingClientRect();
    const yE = ele.y;
    const heightE = ele.height;
    let scroll = window.scrollY;
    const position = yE + scroll + heightE + 10;
    area.style.top = position + 'px';
    area.style.left = ele.left + 'px';
    setTimeout(() => {
        area.remove();
    }, 1500)
    document.body.appendChild(area);
    return ele;
}

//pega a posição relativa de um elemento e coloca outro elemento em baixo. -------o modal de denuncias depende disso-----
function relativ_a_b(relative, modal_, remover, raiz) {
    remover.onclick = () => {
        modal_.style.opacity = '0';
        setTimeout(() => {
            raiz.remove();
        })
    }
    let button = relative.getBoundingClientRect();
    let posiY = window.scrollY + button.y + button.height;
    let posi_x = button.left + window.scrollX - (button.width * 2);


    modal_.style.left = posi_x + "px";
    modal_.style.top = posiY + "px";
    setTimeout(() => {
        modal_.style.opacity = '1';

    }, 25);
    qs('.feed-area').appendChild(raiz);
}

// gera o modal de denuncia
let modal_aux_q_D_c;
if (qs('.q_D_modal_area') != undefined) {
    let modal_aux_q_D = qs('.q_D_modal_area');
    modal_aux_q_D_c = modal_aux_q_D.cloneNode(true);
    modal_aux_q_D.remove();
}
//fecha modals
function ext(area_hidden) {
    area_hidden.style.opacity = '0';
    setTimeout(() => {
        area_hidden.style.display = 'none';
        area_hidden.remove();
        qs('html').style = '';
    }, 250)
}

// modal de denuncia + requisição
function q_D_modal_show(id, url) {
    let modal_q_D = modal_aux_q_D_c;
    input_div_puts(modal_q_D.querySelector('.input_div'), modal_q_D.querySelector('.hidden_in_info_'));
    modal_q_D.querySelector('.q_D_button_body').onclick = async (e) => {
        e.preventDefault();
        let f = new FormData();
        f.append('dP_xd30', id);
        let valueF;
        qsAll('.q_D_radio').forEach(e => {
            if (e.checked == true) {
                valueF = e.value;
            }
        })
        if (valueF == undefined) {
            mensagem_element(qsAll('.q_D_body_R_area')[0], "Por favor marque um destes campos.")
        } else {
            f.append('dp_xd30_m', valueF);
            f.append('dP_xd30_mT', qs('.hidden_in_info_').value);
            let req_ = await fetch(url, {
                method: "POST",
                body: f
            })
            let res = await req_.json();
            qsAll('.q_D_radio').forEach(e => {
                if (e.checked == true) {
                    e.checked = false;
                }
            });
            qs('.input_div').innerHTML = '';
            qs('.hidden_in_info_').value = '';
            ext(modal_q_D);
            alert_mensage(res);
        }
    };

    modal_q_D.querySelectorAll('.q_D_modal_exit').forEach((e) => {
        e.onclick = () => {
            qsAll('.q_D_radio').forEach(e => {
                if (e.checked == true) {
                    e.checked = false;
                }
            });
            qs('.input_div').innerHTML = '';
            qs('.hidden_in_info_').value = '';
            ext(modal_q_D)
        };
    })
    qs('.feed-area').appendChild(modal_q_D);
    console.log('chamou')
    console.log(id)
    modal_q_D.style.display = '';
    qs('html').style.overflow = 'hidden';
    setTimeout(() => {
        modal_q_D.style.opacity = '1';
    })
}



// gera o modal de denuncia; 
//  se ele tiver a mesma estrutura desse. ----ultra importante-----
let modal_clone = qs('.modal_area_dP');
let aux_clone;
if (modal_clone != undefined) {
    aux_clone = modal_clone.cloneNode(true);
    modal_clone.remove();
}

async function posts_modal(modal_show, id_publi, url_g, button_show) {
    console.log(id_publi);
    let modal_b = modal_show.querySelector('.dP_post');
    let opt = modal_show.querySelectorAll('.opt_dP');
    let form = new FormData();
    form.append("verify_salva", id_publi);
    let res_;
    try {
        let fetc = await fetch(url_g[1], {
            method: "POST",
            body: form
        });
        res_ = await fetc.json();
    } catch {
        res_ = false;
    }
    console.log(res_)
    if (res_) {
        opt[1].innerHTML = 'Retirar das publicações salvas';
    } else {
        opt[1].innerHTML = 'Salvar publicação';
    }
    opt[0].onclick = () => { q_D_modal_show(id_publi, url_g[0]) };

    // --------------- salva/retira das publicações salvas -------------
    let aux = res_;
    opt[1].onclick = async (e) => {
        let form = new FormData();
        if (aux) {
            form.append('x_REMOVED30', id_publi);
        } else {
            form.append('x_SALVAD30', id_publi);
        }
        let res_;
        console.log(url_g)
        try {
            let req = await fetch(url_g[1], {
                method: "POST",
                body: form
            });
            res_ = await req.json();
        } catch {
            let msm = {
                "mensage": "Não foi possivel salvar a publicação.",
                'error': true
            };
            alert_mensage(msm);
            return;
        }
        alert_mensage(res_);
        document.querySelector('.modal_exit_dP').click();
    };

    relativ_a_b(
        button_show,
        modal_show.querySelector('.dP_post'),
        modal_show.querySelector('.modal_exit_dP'),
        modal_show
    )
}

//-------------------- abre o modal para escolher o game nas publicações ----------------
let openModalGame = false;
function show_modal_games(modal_game) {
    if (openModalGame) {
        qs('.area_game').innerHTML = '';
        qs('html').style.overflow = ''
        modal_game.style.opacity = '0';
        setTimeout(() => { modal_game.style.display = 'none'; }, 150)
        return openModalGame = false;

    } else {
        qs('html').style.overflow = 'hidden'
        modal_game.querySelector('.exit--area--body_game').onclick = () => show_modal_games(modal_game);
        modal_game.querySelector('.exit--modal--game--add').onclick = () => show_modal_games(modal_game);

        modal_game.style.display = '';
        game_perfil(username, false);
        setTimeout(() => { modal_game.style.opacity = ''; }, 150)
        return openModalGame = true;
    }
}
// -------------------------------- gera o modal de denuncia do usuario -----------------
function modal_denuncia_pefil(id_) {
    let id = id_;
    qs('.button_perfil_').onclick = () => {
        console.log(id);
        let area_ = qs('.menu_perfil_');
        area_.style.display = '';
        setTimeout(() => { area_.style.opacity = ''; }, 250);
        area_.querySelector('.menu_perfil_denuncia').onclick = () => {
            area_.style.opacity = '0';
            setTimeout(() => { area_.style.display = 'none'; }, 250);
            q_D_modal_show(id, '../assets/script/php/ineteracao_perfil/denuncia_user.php');
        }
        area_.querySelector('.exit_menu_perfil').onclick = () => {
            area_.style.opacity = '0';
            setTimeout(() => { area_.style.display = 'none'; }, 250);
        }
    }
}

// --------------------------------------- convite de jogos --------------------------
let button_convidar = document.querySelector('.button_convidar');
if (button_convidar != undefined) {
    let modal_ = document.querySelector('.modal_convite_game_');
    button_convidar.addEventListener('click', async () => {
        function exit_modal_convite() {
            modal_.style.display = 'none';
            modal_.style.opacity = '0';
            modal_.querySelector('.area_users_convite').innerHTML = '';
            modal_.querySelector('.postion-no').display = '';
            document.querySelector('html').style.overflow = '';
            setTimeout(() => modal_.style.opacity = "1", 150);
        }
        let fomr = new FormData();
        fomr.append('x_USERID30', 'teste');
        let res_;
        modal_.style.display = '';
        document.querySelector('html').style.overflow = 'hidden';
        setTimeout(() => modal_.style.opacity = "1", 150);
        try {
            let req_ = await fetch('../assets/script/php/requsicoes/convite_game/convite_game_list.php', {
                method: "POST",
                body: fomr,
            });
            if (req_.status != 404) {
                res_ = await req_.text();
            } else {
                exit_modal_convite();
                return;
            }

        } catch {
            exit_modal_convite()
            let msm = {
                'mensage': "Não foi possivel achar usuários",
                'error': true
            };
            alert_mensage(msm);
            return;
        }
        modal_.querySelectorAll('.exit_modal_convite').forEach((e) => {
            e.onclick = () => {
                exit_modal_convite()
            }
        });
        modal_.querySelector('.area_users_convite').innerHTML = res_;
        modal_.querySelector('.postion-no').style.display = 'none';

        document.querySelector(".area_users_convite").querySelectorAll('.button--seguir').forEach((e) => {
            e.onclick = async (b) => {
                let form = new FormData();
                let id_user = b.target.id;
                let id_user_aux = id_user.split("_");
                let id_aux = id_user_aux[3];
                let xD;
                if (id_user_aux[2] == '29') {
                    form.append('x_CONVIDARXD_29_', id_aux);
                    xD = 'x_CONVIDARXD_29_';
                } else {
                    form.append('x_CONVIDARXD_30_', id_aux);
                    xD = 'x_CONVIDARXD_30_';
                }
                console.log(id_aux)
                let req = await fetch('../assets/script/php/requsicoes/convite_game/convite_game_list.php', {
                    method: "POST",
                    body: form,
                });
                let res = await req.json();
                console.log(res);
                alert_mensage(res);
                if (res.error != undefined && res.error == false) {
                    console.log(id_user_aux[2]);
                    if (id_user_aux[2] == '29') {
                        b.target.classList.remove('button--convidar_fals');
                        b.target.classList.remove('button--convidar');
                        b.target.classList.add('button--convidar');
                        b.target.id = 'x_CONVIDARXD_30_' + id_aux;
                    } else {
                        b.target.classList.remove('button--convidar_fals');
                        b.target.classList.remove('button--convidar');
                        b.target.classList.add('button--convidar_fals');
                        b.target.id = 'x_CONVIDARXD_29_' + id_aux;
                    }
                }
            }
        })
    }, true);
}

// -------------------------- gera convites do usuário ---------------------------
async function verify_convite() {
    let form = new FormData();
    form.append('x_VERIFYD30', '');
    let res_;
    try {
        let req = await fetch('../assets/script/php/requsicoes/convite_game/convite_game_list.php', {
            method: "POST",
            body: form
        });
        if (req.status == 200) {
            res_ = await req.text();
        } else {
            return;
        }
    } catch {
        return;
    }
    if (document.querySelector('.area_convites_games') != undefined) {
        document.querySelector('.area_convites_games').innerHTML = res_;
    }
    document.querySelectorAll('.button--aceira--convite').forEach((e) => {
        e.onclick = async (b) => {
            let ro = b.target.id.split('_');
            let id_user = ro[2];
            let form = new FormData();
            form.append('x_ACEIRARD30', id_user);
            let res_;
            try {
                let req = await fetch('../assets/script/php/requsicoes/convite_game/convite_game_list.php', {
                    method: "POST",
                    body: form
                });
                res_ = await req.json();
            } catch {
                let msm = {
                    "mensage": 'Não foi possivel aceitar o convite.',
                    "error": true
                }
                alert_mensage(msm);
            }
            alert_mensage(res_);
        }
    })
}
verify_convite();
setInterval(async () => {
    verify_convite();
}, 2000);
