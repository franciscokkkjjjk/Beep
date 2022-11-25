console.log(sessionStorage.x5edS);
if (window.sessionStorage.x5edS == "null") {
    window.sessionStorage.removeItem('x5edS');
}
if (window.sessionStorage.x5edU == "null") {
    window.sessionStorage.removeItem('x5edU');
}
if (window.sessionStorage.x5edP == "null") {
    window.sessionStorage.removeItem('x5edP');
}
const auxF = (var_, lugar) => {
    return var_.querySelector(lugar);
}
if (window.sessionStorage.x5edU != undefined) {
    async function creat_list_post_D_U() {
        let req_aux = new FormData();
        req_aux.append('x5edU', window.sessionStorage.x5edU);
        let req = await fetch('../assets/script/php/requisicoes/denuncia_user_all.php', {
            method: 'POST',
            body: req_aux
        });
        let res = await req.json();
        if (res.error) {
            window.location.href = 'dununcias.php';
        } else {
            document.querySelector('.loading').remove();
            let info_post_d = document.querySelector('.info_cont');
            console.log(info_post_d);
            let midia;
            //verficar se o post ta em quarentena ou não. Caso estive, colocar uma mensagem que ele ta em quarentena e adicionar uma classe no botão, caso contrario, deixar como esta.
            if (res.usuario_denunciado.status_ == 1) {
                document.querySelector(".quarentena").innerHTML = '(Conta suspensa)';
                document.querySelector('.buttons_sus').classList.add('buttons_sus_r');
                document.querySelector(".buttons_sus").addEventListener("click", (e) => {
                    e.preventDefault();
                    // window.location.href = "../assets/script/php/denuncias_posts/quarentena.php?id_p_r=" + res.usuario_denunciado.id_publicacao;
                }, true)
                // console.log(document.querySelector('.quarentena'))
            } else {
                document.querySelector(".buttons_sus").addEventListener("click", (e) => {
                    e.preventDefault();
                    // modal_simples('Você realmente quer fazer isso?', "../assets/script/php/denuncias_posts/quarentena.php?id_p=" + res.usuario_denunciado.id_publicacao);
                    // window.location.href = ";
                }, true)
            }
            let username_user = res.usuario_denunciado.username;
            document.querySelector(".button_C").onclick = async (e) => {
                e.preventDefault();
                let res;
                try {
                    let req = await fetch('../assets/script/php/requisicoes/posts_all_users.php?username=' + username_user);
                    res = await req.json();
                } catch {
                    let msm = {
                        "mensage": "Não foi possivel acessar as publicações desse usuário.",
                        "error": true
                    }
                    alert_mensage(msm);
                    return;
                }
                if (res.publi.nada == undefined) {
                    criarPosts(res.publi, false);
                } else {
                    let div_ =  document.createElement('div');
                    div_.setAttribute('class', 'post--menu--area');
                    div_.innerHTML = 'Esse usuário não possui publicações.';
                    div_.style.textAlign = 'center';
                    div_.style.padding = '40px 0px';
                    document.querySelector('.feed-body-post').append(div_);
                }
                document.querySelector("html").style.overflow = 'hidden';
                document.querySelector('.area_publicação').style.display = '';
                setTimeout(() => document.querySelector('.area_publicação').style.opacity = '1', 50);
                document.querySelector('.area_exit_').onclick = () => {
                    document.querySelector('.area_publicação').style.opacity = '0'
                    setTimeout(() => document.querySelector('.area_publicação').style.display = 'none', 50);
                    let aux = 0;
                    document.querySelectorAll('.post--menu--area').forEach((e) => {
                        if (aux >= 2) {
                            e.remove();
                        }
                        aux++;
                    })
                }
                document.querySelector('.area_fundo').onclick = () => {
                    document.querySelector('.area_publicação').style.opacity = '0'
                    setTimeout(() => document.querySelector('.area_publicação').style.display = 'none', 50);
                    let aux = 0;
                    document.querySelectorAll('.post--menu--area').forEach((e) => {
                        if (aux >= 2) {
                            e.remove();
                        }
                        aux++;
                    })
                }
                console.log(res)
            }
            document.querySelector(".buttons_visualizar_p").onclick = (e) => {
                e.preventDefault();
                // modal_simples('Essa publicação realmente está tudo ok? Essa ação resultará na exclusão de todas denúncias referentes a essa publicação.', "../assets/script/php/denuncias_posts/tudoOk.php?id_p=" + res.usuario_denunciado.id_publicacao);

            }
            console.log(res.usuario_denunciado.midia_user)
            if ((res.usuario_denunciado.midia_user != "") && (res.usuario_denunciado.midia_user != null)) {
                let midia = document.createElement('img');
                midia.setAttribute('class', 'img_p');
                midia.setAttribute('src', `../../assets/imgs/profile/${res.usuario_denunciado.midia_user}`);
                document.querySelector(".img_area").classList.add('img_p');
                document.querySelector(".img_area").append(midia);
            } else {
                let div_ = document.createElement('div');
                div_.textContent = "Mídia não informada";
                div_.classList.add("img_p");
                div_.style.alignItems = "center";
                document.querySelector(".img_area").append(div_);
            }
            if ((res.usuario_denunciado.midia_banner != "") && (res.usuario_denunciado.midia_banner != null)) {
                let midia = document.createElement('img');
                midia.setAttribute('src', `../../assets/imgs/profile/${res.usuario_denunciado.midia_banner}`);
                document.querySelector(".banner_").append(midia);
            } else {
                let div_ = document.createElement('div');
                div_.textContent = "Mídia não informada";
                div_.classList.add("img_p");
                div_.style.alignItems = "center";
                document.querySelector(".img_area").append(div_);
            }
            info_post_d.querySelector('.conteudo_1 .text_C').innerHTML = res.usuario_denunciado.nome;
            info_post_d.querySelector(".conteudo3 .text_C").innerHTML = res.usuario_denunciado.email;
            info_post_d.querySelector(".conteudo2 .text_C").innerHTML = res.usuario_denunciado.date_nasc;
            info_post_d.querySelector(".conteudo4 .text_C").innerHTML = res.usuario_denunciado.bio;

            let denuncias_area = document.querySelector(".motivos_info");
            denuncias_area.querySelector(".conteudo_1 .text_C").innerHTML = res.motivos.mais_selecionados;
            denuncias_area.querySelector(".conteudo2 .text_C").innerHTML = res.motivos.qt_denuncias;
            let motivos_area = document.querySelector(".motivos_area");
            if (motivos_area != undefined) {
                motivos_area.remove()
            }
            for (let aux in res.motivos.info_motivo) {
                let motivos_area_clone = motivos_area.cloneNode(true);
                motivos_area_clone.querySelector(".motivo_text00").innerHTML = res.motivos.info_motivo[aux].denunciador;
                motivos_area_clone.querySelector(".motivo_text01").innerHTML = res.motivos.info_motivo[aux].motivo;
                if (res.motivos.info_motivo[aux].motivo_text != "") {
                    motivos_area_clone.querySelector(".motivo_text02").style.display = '';
                    motivos_area_clone.querySelector(".motivo_title02").style.display = '';
                    motivos_area_clone.querySelector(".motivo_text02").innerHTML = res.motivos.info_motivo[aux].motivo_text;
                } else {
                    motivos_area_clone.querySelector(".motivo_text02").style.display = 'none';
                    motivos_area_clone.querySelector(".motivo_title02").style.display = 'none';
                }
                motivos_area_clone.querySelector(".motivo_text01").innerHTML = res.motivos.info_motivo[aux].motivo;
                document.querySelector(".m_area .C_1").append(motivos_area_clone);
            }
        }
    }
    creat_list_post_D_U();
} else {
    window.location.href = 'dununcias.php';
}


function criarPosts(lista, coment_ = true) {
    let url = [
        '../assets/script/php/interacoes_post/denunciar_p.php',
        '',//salvar posts
    ]
    console.log('entrou');
    console.log(lista)
    for (var i in lista) {
        if (lista[i]['type'] == "3") {//postagem normal
            let post_body = document.querySelector('.type_1 .post--menu--area').cloneNode(true);
            if (post_body.querySelector('.interacao--post--area') != undefined) {
                post_body.querySelector('.interacao--post--area').remove();
            }
            post_body.id = lista[i]['id_publi'] + 'pt-xD30';
            let aux_id = lista[i]['id_publi'];
            post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['user_info']['img_user']);
            post_body.querySelector('.name--area a').setAttribute('href', `../../paginas/perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
            post_body.querySelector('.name--name-perfil').innerHTML = lista[i]['user_info']['nome_user'];
            post_body.querySelector('.name--username-perfil').innerHTML = lista[i]['user_info']['username_user'];
            post_body.querySelector('.date--post').innerHTML = lista[i]['date_publi'];
            //gera os jogos nas publicações
            if (lista[i]['game_publi']['game_id'] != null) {
                post_body.querySelector('.game--post').innerHTML = lista[i]['game_publi']['game_nome'];
                let aux_game = {
                    'id_game': lista[i]['game_publi']['game_id']
                }
                post_body.querySelector('.game--post').onclick = (e) => show_game(aux_game, e);
            }

            if (lista[i]['text_post'] == '' || lista[i]['text_post'] == null) {
                post_body.querySelector('.post--text').style.display = 'none';
            } else {
                post_body.querySelector('.post--text').innerHTML = lista[i]['text_post'];
            }
            if (lista[i]['img_publi'] == "" || lista[i]['img_publi'] == null) {

            } else {
                let type_midia = lista[i]['img_publi'].split('.');
                if (type_midia[1] == 'mp4') {
                    post_body.querySelector('.post--img').remove();
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img-area').classList.add('area_midia_video');
                    let video_creat = document.createElement('video');
                    video_creat.setAttribute('src', `../../assets/imgs/posts/${lista[i]['img_publi']}`);
                    video_creat.setAttribute('controls', '');
                    post_body.querySelector('.post--img-area').appendChild(video_creat);
                } else {
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img').style.display = 'block';
                    post_body.querySelector('.post--img').style.backgroundImage = `url(../../assets/imgs/posts/${lista[i]['img_publi']})`;
                }
            }//p-xD30

            let aux = lista[i]['id_publi'];

            if (post_body.querySelector('.conteudo--all--post') != undefined) {
                post_body.querySelector('.conteudo--all--post').remove();
            } console.log(post_body);
            document.querySelector('.feed-body-post').append(post_body);

        } else if (lista[i]['type'] == "2") {//repostagem com comentario 
            if (lista[i]['compartilhador_info']['quarentena'] == "0") { // verfica se ta em quarentena
                let post_body = document.querySelector('.type_2 .post--menu--area').cloneNode(true);
                if (post_body.querySelector('.interacao--post--area') != undefined) {
                    post_body.querySelector('.interacao--post--area').remove();
                }
                post_body.id = lista[i]['compartilhador_info']['id_da_compartilhada'] + 'pt-xD30';
                post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['compartilhador_info']['img_user']);
                post_body.querySelector('.name--comp .perfil-link').setAttribute('href', `../../paginas/perfil_user_v.php?username=${lista[i]['compartilhador_info']['username_user']}`);
                post_body.querySelector('.name--name-perfil-comp_').innerHTML = lista[i]['compartilhador_info']['nome_user'];
                post_body.querySelector('.name--username-perfil-comp_').innerHTML = lista[i]['compartilhador_info']['username_user'];
                if (lista[i]['compartilhador_info']['text_compartilhada'] == '' || lista[i]['compartilhador_info']['text_compartilhada'] == null) {
                    post_body.querySelector('.post--text_comp').style.display = 'none';
                } else {
                    post_body.querySelector('.post--text_comp').innerHTML = lista[i]['compartilhador_info']['text_compartilhada'];
                }
                let aux_id = lista[i]['compartilhador_info']['id_da_compartilhada'];
                post_body.querySelector('.elipse-img').onclick = (e) => {
                    e.preventDefault();
                    posts_modal(aux_clone, aux_id, url, post_body.querySelector('.elipse-img'));
                }
                //-------------pega o jogo da publicação-----------
                if (lista[i]['game_publi']['game_id'] != null) {
                    post_body.querySelector('.game--post').innerHTML = lista[i]['game_publi']['game_nome'];
                    post_body.querySelector('.game--post-comp').innerHTML = lista[i]['game_publi']['game_nome'];
                    let aux_game = {
                        'id_game': lista[i]['game_publi']['game_id']
                    }
                    post_body.querySelector('.game--post').onclick = (e) => show_game(aux_game, e);
                    post_body.querySelector('.game--post-comp').onclick = (e) => show_game(aux_game, e);;
                }
                let aux = lista[i]['id_publi'];
                // -----------------------verifica se ta em quarentena ou excluida---------
                if (aux != null) {
                    if (lista[i]['quarentena'] == 0) {
                        post_body.querySelector('.area--post-com .elipse-img').onclick = (e) => {
                            e.preventDefault();
                            posts_modal(aux_clone, aux, url, post_body.querySelector('.area--post-com .elipse-img'));
                        }
                        post_body.querySelector('.date--post-comp_').innerHTML = lista[i]['compartilhador_info']['date_publi_compartilhada'];
                        post_body.querySelector('.img--perfil-comp').setAttribute('style', lista[i]['user_info']['img_user']);
                        post_body.querySelector('.perfil-link-comp').setAttribute('href', `../../paginas/perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
                        post_body.querySelector('.name--name-perfil-comp').innerHTML = lista[i]['user_info']['nome_user'];
                        post_body.querySelector('.name--username-perfil-comp').innerHTML = lista[i]['user_info']['username_user'];
                        post_body.querySelector('.date--post-comp').innerHTML = lista[i]['date_publi'];

                        if (lista[i]['text_post'] == "" || lista[i]['text_post'] == null) {
                            post_body.querySelector('.post--text--comp_2').style.display = 'none';

                        } else {
                            post_body.querySelector('.post--text--comp_2').innerHTML = lista[i]['text_post'];
                        }
                    } else {
                        post_body.querySelector(".post--comp").innerHTML = '';
                        let mensagem = document.createElement('div');
                        mensagem.setAttribute('class', 'mensagem_post_time');
                        mensagem.innerHTML = 'Essa publicação foi suspensa.';
                        post_body.querySelector(".post--comp").append(mensagem);
                    }
                } else {
                    post_body.querySelector(".post--comp").innerHTML = '';
                    let mensagem = document.createElement('div');
                    mensagem.setAttribute('class', 'mensagem_post_time');
                    mensagem.innerHTML = 'Essa publicação não está mais disponível.';
                    post_body.querySelector(".post--comp").append(mensagem);
                }
                if (lista[i]['compartilhador_info']['img_compartilhada'] == '' || lista[i]['compartilhador_info']['img_compartilhada'] == null) { } else {
                    let type_midia = lista[i]['compartilhador_info']['img_compartilhada'].split('.');
                    console.log(type_midia);
                    if (type_midia[1] == 'mp4') {
                        console.log('video')
                        post_body.querySelector('.post--img').remove();
                        post_body.querySelector('.post--img-area').style.display = '';
                        post_body.querySelector('.post--img-area').classList.add('area_midia_video');
                        let video_creat = document.createElement('video');
                        video_creat.setAttribute('src', `../../assets/imgs/posts/${lista[i]['compartilhador_info']['img_compartilhada']}`);
                        video_creat.setAttribute('controls', '');
                        post_body.querySelector('.post--img-area').appendChild(video_creat);
                    } else {
                        post_body.querySelector('.post--img-area').style.display = 'block';
                        post_body.querySelector('.post--img').style.backgroundImage = `url(../../assets/imgs/posts/${lista[i]['compartilhador_info']['img_compartilhada']})`;
                    }
                }
                //-----------------------------interagida----------------
                if (lista[i]['quarentena'] == 0) {
                    if (lista[i]['img_publi'] == '' || lista[i]['img_publi'] == null) { } else {
                        let type_midia = lista[i]['img_publi'].split('.');
                        console.log(type_midia);
                        if (type_midia[1] == 'mp4') {
                            console.log('video')
                            post_body.querySelector('.img--comentada').remove();
                            post_body.querySelector('.post--img-area-com').style.display = '';
                            post_body.querySelector('.post--img-area-com').classList.add('area_midia_video');
                            let video_creat = document.createElement('video');
                            video_creat.setAttribute('src', `../../assets/imgs/posts/${lista[i]['img_publi']}`);
                            video_creat.setAttribute('controls', '');
                            post_body.querySelector('.post--img-area-com').appendChild(video_creat);
                        } else {
                            post_body.querySelector('.post--img-area-com').style.display = 'block';
                            post_body.querySelector('.img--comentada').style.backgroundImage = `url(../../assets/imgs/posts/${lista[i]['img_publi']})`;
                        }
                    }
                }

                let aux_d = lista[i]['compartilhador_info']['id_da_compartilhada'];

                if (post_body.querySelector('.conteudo--all--post') != undefined) {
                    post_body.querySelector('.conteudo--all--post').remove();
                }
                console.log(post_body);

                document.querySelector('.feed-body-post').append(post_body);
            }
        } else if (lista[i]['type'] == "4") {//compartilhamento direto 
            let post_body = document.querySelector('.type_1 .post--menu--area').cloneNode(true);
            if (post_body.querySelector('.interacao--post--area') != undefined) {
                post_body.querySelector('.interacao--post--area').remove();
            }
            post_body.id = lista[i]['compartilhador_info']['id_da_compartilhada'] + 'pt-xD30';
            post_body.querySelector('.info-compartilhador').style.display = '';
            post_body.querySelector('.user_respost').setAttribute('href', `../../paginas/perfil_user_v.php?username=${lista[i]['compartilhador_info']['username_user']}`);
            post_body.querySelector('.user_respost').innerHTML = `${lista[i]['compartilhador_info']['nome_user']}(${lista[i]['compartilhador_info']['username_user']})`;
            post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['user_info']['img_user']);
            post_body.querySelector('.name--area a').setAttribute('href', `../../paginas/perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
            post_body.querySelector('.name--name-perfil').innerHTML = lista[i]['user_info']['nome_user'];
            post_body.querySelector('.name--username-perfil').innerHTML = lista[i]['user_info']['username_user'];
            post_body.querySelector('.date--post').innerHTML = lista[i]['date_publi'];
            post_body.querySelector('.post_compartilhadas').innerHTML = lista[i]['beepadas'];
            if (lista[i]['text_post'] == '' || lista[i]['text_post'] == null) {
                post_body.querySelector('.post--text').style.display = 'none';
            } else {
                post_body.querySelector('.post--text').innerHTML = lista[i]['text_post'];
            }
            //gera os jogos nas publicações
            if (lista[i]['game_publi']['game_id'] != null) {
                post_body.querySelector('.game--post').innerHTML = lista[i]['game_publi']['game_nome'];
                let aux_game = {
                    'id_game': lista[i]['game_publi']['game_id']
                }
                post_body.querySelector('.game--post').onclick = (e) => show_game(aux_game, e);
            }
            if (lista[i]['img_publi'] == "" || lista[i]['img_publi'] == null) {

            } else {
                let type_midia = lista[i]['img_publi'].split('.');
                if (type_midia[1] == 'mp4') {
                    post_body.querySelector('.post--img').remove();
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img-area').classList.add('area_midia_video');
                    let video_creat = document.createElement('video');
                    video_creat.setAttribute('src', `../../assets/imgs/posts/${lista[i]['img_publi']}`);
                    video_creat.setAttribute('controls', '');
                    post_body.querySelector('.post--img-area').appendChild(video_creat);
                } else {
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img').style.display = 'block';
                    post_body.querySelector('.post--img').style.backgroundImage = `url(../../assets/imgs/posts/${lista[i]['img_publi']})`;
                }
            }//p-xD30
            let aux_id = lista[i]['id_publi'];
            post_body.querySelector('.elipse-img').onclick = (e) => {
                e.preventDefault();
                posts_modal(aux_clone, aux_id, url, post_body.querySelector('.elipse-img'));
            }
            if (post_body.querySelector('.interacao--post--area') != undefined) {
                post_body.querySelector('.interacao--post--area').remove();
            }
            if (post_body.querySelector('.conteudo--all--post') != undefined) {
                post_body.querySelector('.conteudo--all--post').remove();
            }
            console.log(post_body);

            document.querySelector('.feed-body-post').append(post_body);
        } else if (lista[i]['type'] == "1" && coment_) {

            //gera comentario
        }
    }
    atual = parseInt(i) + 1;
    return;
}