let post_d;
let scroll_ = false;
var atual;
let load = document.querySelector('.back--event');
let quan_novos = 0;
let button = document.createElement('button');
let div = document.querySelector('.event');
async function posts() {
    let posts = await fetch('../assets/script/php/requsicoes/posts.php');
    post_d = await posts.json();
    load.style.display = 'none';
    console.log(post_d);
    if (post_d.nada == undefined) {
        criarPosts(post_d);
        curtir_post();
        desCurtir();
        viwimg();
        show_CM();
        descompartilhar();
        qs('.event-direct').onclick = compartilhar;
        post_num_curtida();
        setInterval(() => {
            post_num_curtida();
        }, 9000);
        post_num_compartilhamento();
        setInterval(async () => {
            post_num_compartilhamento();
        }, 9000);
    } else {
        post_not(0);
    }
}
function curtir_post() {
    qsAll('.p-xD30').forEach((e) => {
        let num_click = 0;
        let curtida = new FormData(e);
        e.onclick = async (a) => {
            num_click++;
            a.preventDefault();
            let moio;
            console.log(num_click);
            if (num_click <= 3) {
                moio = await fetch('../assets/script/php/interacoes_post/curtir.php', {
                    method: 'POST',
                    body: curtida,
                })
                let res = await moio.json();
                console.log(res);
                alert_mensage(res);
                let num_curtidas = e.querySelector('.area_num');
                if ((num_curtidas != undefined) && (res.curtidas != undefined)) {
                    let num = res.curtidas;
                    e.querySelector('.area_num').innerHTML = num;
                }
                e.querySelector('button').classList.remove();
                e.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                e.querySelector('button').classList.add('p-evt-box');
                setTimeout(() => {
                    e.querySelector('button').classList.remove('p-evt-box');
                }, 0260)
                e.classList.remove();
                e.setAttribute('class', 'event--curtida curtir--hover interac-button p-xD29');
                setTimeout(() => {
                    desCurtir();
                }, 001)
            } else {
                console.log('tão tentando me sabotar kkkk')
            }

        }
    })
}
async function user_(active, username = null) {
    let username_vist = window.location.href.split('=');
    let user_vist = await fetch('../assets/script/php/requsicoes/posts_users.php?username=' + username_vist[1]);
    let user_v = await user_vist.json();
    if (user_v.error == undefined) {
        qsAll('.event').forEach((e) => { e.remove() });
        qsAll('.back--event').forEach((e) => { e.remove() });
        console.log(user_v)
        if (active) {
            seguidores_user();
            user_seguidores(user_v.user);
            if (user_v.publi.nada == undefined) {
                criarPosts(user_v.publi)
                curtir_post();
                desCurtir();
                viwimg();
                show_CM();
                descompartilhar();
                qs('.event-direct').onclick = compartilhar;
                setInterval(() => {
                    post_num_curtida();
                }, 9000);
                post_num_compartilhamento();
                setInterval(async () => {
                    post_num_compartilhamento();
                }, 9000);
                // seguidores_session();
            } else {
                post_not(1);
                if (qs('.back--event') != undefined) {
                    qs('.back--event').remove();
                }
                if (qs('.event') != undefined) {
                    qsAll('.event').forEach((e) => {
                        e.remove();
                    })
                }
            }

        } else {
            seguidores_user();
            user_seguidores(user_v.user);
            game_perfil(username);
        }
    } else {
        not_requi(0);
        qs('.back--event').remove();
        qsAll('.event').forEach((e) => {
            e.remove();
        })
    }
}

function criarPosts(lista) {
    let url = [
        '../assets/script/php/interacoes_post/denunciar_p.php',
        '',//salvar posts
    ]
    for (var i in lista) {
        if (lista[i]['type'] == "3") {//postagem normal
            let post_body = document.querySelector('.type_1 .post--menu--area').cloneNode(true);
            post_body.id = lista[i]['id_publi'] + 'pt-xD30';
            let aux_id = lista[i]['id_publi'];
            post_body.querySelector('.elipse-img').onclick = (e) => {
                e.preventDefault();
                posts_modal(aux_clone, aux_id, url, post_body.querySelector('.elipse-img'));
            }
            coment(post_body.querySelector('.comentar'));
            post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['user_info']['img_user']);
            post_body.querySelector('.name--area a').setAttribute('href', `perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
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
            if (lista[i]['img_publi'] == "") {

            } else {
                let type_midia = lista[i]['img_publi'].split('.');
                if (type_midia[1] == 'mp4') {
                    post_body.querySelector('.post--img').remove();
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img-area').classList.add('area_midia_video');
                    let video_creat = document.createElement('video');
                    video_creat.setAttribute('src', `../assets/imgs/posts/${lista[i]['img_publi']}`);
                    video_creat.setAttribute('controls', '');
                    post_body.querySelector('.post--img-area').appendChild(video_creat);
                } else {
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img').style.display = 'block';
                    post_body.querySelector('.post--img').style.backgroundImage = `url(../assets/imgs/posts/${lista[i]['img_publi']})`;
                }
            }//p-xD30
            post_body.querySelector('.event--curtida input').value = lista[i]['id_publi'];
            post_body.querySelector('.post_compartilhadas').innerHTML = lista[i]['beepadas'];
            if (lista[i]['user_curtiu']) {
                post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['id_publi']);
                post_body.querySelector('.event--curtida').classList.add('p-xD29');
                post_body.querySelector('.event--curtida .post_curtidas').innerHTML = lista[i]['num_curtidas'];
                post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
            } else {
                post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
                post_body.querySelector('.event--curtida').classList.add('p-xD30');
                post_body.querySelector('.event--curtida .post_curtidas').innerHTML = lista[i]['num_curtidas'];
                post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['id_publi'])
            }
            if (lista[i]['user_compartilhou']) {
                post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-on');
                post_body.querySelector('.compartilhar-event-div').classList.add('descompartilhar-event');
                post_body.querySelector('.compartilhar-event').classList.add('descompartilhar');
                post_body.querySelector('.descompartilhar-event').id = lista[i]['id_publi'] + 'c-xD30';
            } else {
                post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-off')
                post_body.querySelector('.compartilhar-event-div').classList.add('compartilhar')
                post_body.querySelector('.compartilhar').id = lista[i]['id_publi'] + 'c-xD30';
            }
            post_body.querySelector('.comentar').id = 'p_xD30_C' + lista[i]['id_publi'];
            post_body.querySelector('.comentar .post_comentadas').innerHTML = lista[i]['num_comentario'];
            let aux = lista[i]['id_publi'];

            post_body.querySelector('.conteudo--all--post').href = 'postagem.php?postagem=' + lista[i]['id_publi'];
            post_body.querySelector('.event--curtida').setAttribute('id', lista[i]['id_publi']);
            document.querySelector('.feed-body-post').append(post_body);
        } else if (lista[i]['type'] == "2") {//repostagem com comentario 
            if (lista[i]['compartilhador_info']['quarentena'] == "0") { // verfica se ta em quarentena
                let post_body = document.querySelector('.type_2 .post--menu--area').cloneNode(true);
                coment(post_body.querySelector('.comentar'));
                post_body.id = lista[i]['compartilhador_info']['id_da_compartilhada'] + 'pt-xD30';
                post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['compartilhador_info']['img_user']);
                post_body.querySelector('.name--comp .perfil-link').setAttribute('href', `perfil_user_v.php?username=${lista[i]['compartilhador_info']['username_user']}`);
                post_body.querySelector('.name--name-perfil-comp_').innerHTML = lista[i]['compartilhador_info']['nome_user'];
                post_body.querySelector('.name--username-perfil-comp_').innerHTML = lista[i]['compartilhador_info']['username_user'];
                post_body.querySelector('.event--curtida-comp input').value = lista[i]['compartilhador_info']['id_da_compartilhada'];
                if (lista[i]['compartilhador_info']['text_compartilhada'] == '' || lista[i]['compartilhador_info']['text_compartilhada'] == null) {
                    post_body.querySelector('.post--text_comp').style.display = 'none';
                } else {
                    post_body.querySelector('.post--text_comp').innerHTML = lista[i]['compartilhador_info']['text_compartilhada'];
                }
                let aux_id = lista[i]['compartilhador_info']['id_da_compartilhada'];
                post_body.querySelector('.post_compartilhadas').innerHTML = lista[i]['beepadas'];
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
                        post_body.querySelector('.perfil-link-comp').setAttribute('href', `perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
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
                        video_creat.setAttribute('src', `../assets/imgs/posts/${lista[i]['compartilhador_info']['img_compartilhada']}`);
                        video_creat.setAttribute('controls', '');
                        post_body.querySelector('.post--img-area').appendChild(video_creat);
                    } else {
                        post_body.querySelector('.post--img-area').style.display = 'block';
                        post_body.querySelector('.post--img').style.backgroundImage = `url(../assets/imgs/posts/${lista[i]['compartilhador_info']['img_compartilhada']})`;
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
                            video_creat.setAttribute('src', `../assets/imgs/posts/${lista[i]['img_publi']}`);
                            video_creat.setAttribute('controls', '');
                            post_body.querySelector('.post--img-area-com').appendChild(video_creat);
                        } else {
                            post_body.querySelector('.post--img-area-com').style.display = 'block';
                            post_body.querySelector('.img--comentada').style.backgroundImage = `url(../assets/imgs/posts/${lista[i]['img_publi']})`;
                        }
                    }
                }
                if (lista[i]['user_curtiu']) {
                    post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['compartilhador_info']['id_da_compartilhada']);
                    post_body.querySelector('.event--curtida').classList.add('p-xD29');
                    post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                } else {
                    post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
                    post_body.querySelector('.event--curtida').classList.add('p-xD30');
                    post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['compartilhador_info']['id_da_compartilhada'])
                }
                post_body.querySelector('.comentar').id = 'p_xD30_C' + lista[i]['compartilhador_info']['id_da_compartilhada'];
                post_body.querySelector('.comentar .post_comentadas').innerHTML = lista[i]['num_comentario'];
                let aux_d = lista[i]['compartilhador_info']['id_da_compartilhada'];

                if (lista[i]['user_compartilhou']) {
                    post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-on');
                    post_body.querySelector('.compartilhar-event').classList.add('descompartilhar');
                    post_body.querySelector('.compartilhar-event-div').classList.add('descompartilhar-event');
                    post_body.querySelector('.descompartilhar-event').id = lista[i]['compartilhador_info']['id_da_compartilhada'] + 'c-xD30';
                } else {
                    post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-off');
                    post_body.querySelector('.compartilhar-event-div').classList.add('compartilhar');
                    post_body.querySelector('.compartilhar').id = lista[i]['compartilhador_info']['id_da_compartilhada'] + 'c-xD30';
                }
                post_body.querySelector('.event--curtida').setAttribute('id', lista[i]['compartilhador_info']['id_da_compartilhada']);
                post_body.querySelector('.conteudo--all--post').href = 'postagem.php?postagem=' + lista[i]['compartilhador_info']['id_da_compartilhada'];
                document.querySelector('.feed-body-post').append(post_body);
            }
        } else if (lista[i]['type'] == "4") {//compartilhamento direto 
            let post_body = document.querySelector('.type_1 .post--menu--area').cloneNode(true);
            post_body.id = lista[i]['compartilhador_info']['id_da_compartilhada'] + 'pt-xD30';
            coment(post_body.querySelector('.comentar'));
            post_body.querySelector('.info-compartilhador').style.display = '';
            post_body.querySelector('.user_respost').setAttribute('href', `perfil_user_v.php?username=${lista[i]['compartilhador_info']['username_user']}`);
            post_body.querySelector('.user_respost').innerHTML = `${lista[i]['compartilhador_info']['nome_user']}(${lista[i]['compartilhador_info']['username_user']})`;
            post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['user_info']['img_user']);
            post_body.querySelector('.name--area a').setAttribute('href', `perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
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
            if (lista[i]['img_publi'] == "") {

            } else {
                let type_midia = lista[i]['img_publi'].split('.');
                if (type_midia[1] == 'mp4') {
                    post_body.querySelector('.post--img').remove();
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img-area').classList.add('area_midia_video');
                    let video_creat = document.createElement('video');
                    video_creat.setAttribute('src', `../assets/imgs/posts/${lista[i]['img_publi']}`);
                    video_creat.setAttribute('controls', '');
                    post_body.querySelector('.post--img-area').appendChild(video_creat);
                } else {
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img').style.display = 'block';
                    post_body.querySelector('.post--img').style.backgroundImage = `url(../assets/imgs/posts/${lista[i]['img_publi']})`;
                }
            }//p-xD30
            let aux_id = lista[i]['id_publi'];
            post_body.querySelector('.elipse-img').onclick = (e) => {
                e.preventDefault();
                posts_modal(aux_clone, aux_id, url, post_body.querySelector('.elipse-img'));
            }
            post_body.querySelector('.event--curtida input').value = lista[i]['compartilhador_info']['id_da_compartilhada'];
            post_body.querySelector('.comentar').id = 'p_xD30_C' + lista[i]['compartilhador_info']['id_da_compartilhada'];



            post_body.querySelector('.comentar .post_comentadas').innerHTML = lista[i]['num_comentario'];




            if (lista[i]['user_curtiu']) {
                post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['compartilhador_info']['id_da_compartilhada']);
                post_body.querySelector('.event--curtida').classList.add('p-xD29');
                post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
            } else {
                post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
                post_body.querySelector('.event--curtida').classList.add('p-xD30');
                post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['compartilhador_info']['id_da_compartilhada'])
            }

            if (lista[i]['user_compartilhou']) {
                post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-on');
                post_body.querySelector('.compartilhar-event').classList.add('descompartilhar');
                post_body.querySelector('.compartilhar-event-div').classList.add('descompartilhar-event');
                post_body.querySelector('.descompartilhar-event').id = lista[i]['compartilhador_info']['id_da_compartilhada'] + 'c-xD30';
            } else {
                post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-off')
                post_body.querySelector('.compartilhar-event-div').classList.add('compartilhar')
                post_body.querySelector('.compartilhar').id = lista[i]['compartilhador_info']['id_da_compartilhada'] + 'c-xD30';
            }
            post_body.querySelector('.event--curtida').setAttribute('id', lista[i]['compartilhador_info']['id_da_compartilhada']);

            post_body.querySelector('.conteudo--all--post').href = 'postagem.php?postagem=' + lista[i]['id_publi'];
            document.querySelector('.feed-body-post').append(post_body);
        }
    }
    atual = parseInt(i) + 1;
    return;
}
function verficar_posts() {
    setInterval((e) => {
        fetch('../assets/script/php/requsicoes/posts.php')
            .then(function (resultado) {
                return resultado.json()
            })
            .then(function (json) {
                if (atual < json.length) {
                    quan_novos++;
                    atual++;
                    if (document.querySelector('html').scrollTop >= 200) {
                        scroll_ = true;
                        let alert;
                        let divAlert = document.createElement('div');
                        divAlert.setAttribute('class', 'alert--mensagem')
                        if (quan_novos > 1) {
                            alert = `você tem ${quan_novos} novos posts`;
                        } else if (quan_novos < 2) {
                            alert = `você tem ${quan_novos} novo post`;
                        } if (quan_novos > 9) {
                            alert = `você tem muitos novos posts`;
                        }
                        divAlert.innerHTML = alert;
                        document.querySelector('.feed-body-post').appendChild(divAlert);
                        divAlert.addEventListener('click', (a) => {
                            window.scrollTo({
                                top: 0,
                                behavior: 'smooth'
                            });
                            document.querySelector('.alert--mensagem').remove();
                            setTimeout(() => {
                                load.style.display = '';
                                setTimeout(() => {
                                    window.location.reload();
                                }, 100)
                            }, 1100)
                        }, true)
                    } else if (document.querySelector('html').scrollTop == 0 && scroll_) {
                        document.querySelector('.alert--mensagem').remove();
                        scroll_ = false;
                    }
                }
                return json.length;
            })
    }, 9000);

}
function user_seguidores(list_user) {
    if (list_user.banner_pefil != null && list_user.banner_pefil != "") {
        document.querySelector('.banner--perfil').setAttribute('style', "background-image:url(../assets/imgs/profile/" + list_user.banner_pefil + ");");
    }
    document.querySelector('.fot_user_visit').setAttribute('style', list_user.img_user);
    document.querySelector('.info--perfil--user--nome').innerHTML = list_user.nome_user;
    qs('.info--perfil--user--username').innerHTML = list_user.username_user;
    qs('.curtidas_user').setAttribute('href', 'curtidas_v.php?username=' + list_user.username_user);
    qs('.publicacoes_user').setAttribute('href', 'perfil_user_v.php?username=' + list_user.username_user);
    qs('.game_opt').setAttribute('href', 'perfilJogos_v.php?username=' + list_user.username_user);
    qs('.bio').innerHTML = list_user.bio;
    qs('.nome--perfil').innerHTML = list_user.nome_user;
    qs('.data_nasc').innerHTML = list_user.data_nas;
    qs('.seguidores--info').href = qs('.seguidores--info').href + list_user.user_id;
    qs('.seguidor--info ').href = qs('.seguidor--info ').href + list_user.user_id;
    let button_segu = document.createElement('button');
    qs('.input_segui_id_x30').value = list_user.user_id;
    if (list_user.seguindo == true) {
        button_segu.setAttribute('class', 'button--seguindo button-remove curso-pointer');
        qs('.form_id_x30').setAttribute('action', '../assets/script/php/unseguir.php');
        qs('.form_id_x30').appendChild(button_segu);
    } else {
        button_segu.setAttribute('class', 'button--seguir button-remove curso-pointer');
        qs('.form_id_x30').setAttribute('action', '../assets/script/php/seguir.php');
        qs('.form_id_x30').appendChild(button_segu);
    }
}
function seguidores_user() {
    let segui = window.location.href.split('=');
    setInterval(() => {
        fetch('../assets/script/php/requsicoes/posts_users.php?username=' + segui[1])
            .then(function (resultado) {
                return resultado.json()
            })
            .then(function (json) {
                qs('.num_seguindo').innerHTML = json.user.t_seguindo;
                qs('.num_seguidores').innerHTML = json.user.t_seguidores;


            })
    }, 300)
}

async function user_session() {//adaptar para parece com os da timeline
    let user_session = await fetch('../assets/script/php/requsicoes/posts_users.php?username=' + username);
    let user_s = await user_session.json();
    qs('.back--event').remove();
    console.log(user_s)
    if (user_s.publi.nada == undefined) {
        criarPosts(user_s.publi)
        curtir_post();
        desCurtir();
        viwimg();
        show_CM();
        descompartilhar();
        qs('.event-direct').onclick = compartilhar;
        post_num_curtida();
        setInterval(() => {
            post_num_curtida();
        }, 9000);
        post_num_compartilhamento();
        setInterval(async () => {
            post_num_compartilhamento();
        }, 9000);
    } else {
        post_not(1);
    }
}

function seguidores_session() {
    let url_perfil = window.location.href.split('=');
    let atual_pag = window.location.href.split('paginas/');
    setInterval(() => {
        let aux = atual_pag[1].substring(0, 10);
        if (aux != 'perfil.php') {
            aux = atual_pag[1].substring(0, 12);
            if (aux != 'curtidas.php') {
                aux = atual_pag[1].substring(0, 15);
                if (aux == 'perfilJogos.php') {
                    aux = true;
                }
            } else {
                aux = true;
            }
        } else {
            aux = true;
        }
        if (aux) {
            fetch('../assets/script/php/requsicoes/posts_users.php?username=' + username)
                .then(function (res) {
                    return res.json()
                })
                .then(function (jso) {
                    qs('.num_seguindo').innerHTML = jso.user.t_seguindo;
                    qs('.num_seguidores').innerHTML = jso.user.t_seguidores;
                })
        } else {
            fetch('../assets/script/php/requsicoes/posts_users.php?username=' + url_perfil[1])
                .then(function (res) {
                    return res.json()
                })
                .then(function (jso) {
                    qs('.num_seguindo').innerHTML = jso.user.t_seguindo;
                    qs('.num_seguidores').innerHTML = jso.user.t_seguidores;
                })
        }

    }, 300)
}
function desCurtir() {
    qsAll('.p-xD29').forEach((e) => {
        let num_clic = 0;
        let desCurtida = new FormData(e);
        e.onclick = async function (a) {
            num_clic++;
            console.log(num_clic);
            a.preventDefault();
            if (num_clic < 2) {
                let moio_ = await fetch('../assets/script/php/interacoes_post/descurtir.php', {
                    method: 'POST',
                    body: desCurtida,
                })
                let res_ = await moio_.json();
                console.log(res_);
                alert_mensage(res_);
                if ((e.querySelector('.area_num') != undefined) && (res_.curtidas != undefined)) {
                    let num = res_.curtidas;
                    e.querySelector('.area_num').innerHTML = num;
                }
                e.querySelector('button').classList.remove()
                e.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida img--iteracao-curtida-off img--curtida--off');
                e.classList.remove('p-xD29');
                e.classList.add('p-xD30');
                setTimeout(() => {
                    e.querySelector('button').classList.remove('p-evt-box');
                }, 0260)
                setTimeout(() => {
                    curtir_post();
                }, 001
                )
            } else {
                console.log('estão mesmo tentando me sabotar')
            }
        }
    })
}

async function postsCurtidos_session() {//mesma coisa da session
    let url_push = window.location.href;
    let value_url = url_push.split('=');
    let curtida_req;
    curtida_req = await fetch(`../assets/script/php/requsicoes/curtidas_posts.php?username=` + username)
    let jso_c = await curtida_req.json();
    console.log(jso_c);
    qsAll('.back--event').forEach((e) => { e.remove() });
    if (jso_c.nada == undefined) {
        jso_c.reverse();
        criarPosts(jso_c);
        curtir_post();
        desCurtir();
        viwimg();
        show_CM();
        descompartilhar();
        qs('.event-direct').onclick = compartilhar;
        post_num_curtida();
        setInterval(() => {
            post_num_curtida();
        }, 90000);

        post_num_compartilhamento();
        setInterval(async () => {
            post_num_compartilhamento();
        }, 9000);
    } else {
        post_not(1);
    }
}
let openIMG = false;
function viwimg() {
    qsAll('.post--img').forEach(e => {
        e.addEventListener('click', () => {
            let div00 = document.createElement('div');
            div00.setAttribute('class', 'img--modal');
            let event_exit = document.createElement('div');
            event_exit.setAttribute('class', 'exit_event');
            div00.appendChild(event_exit);
            let div03 = document.createElement('div');
            div03.setAttribute('class', 'menu--exit-img-area');
            div00.appendChild(div03);
            let div04 = document.createElement('div');
            div04.setAttribute('class', 'menu--exit-img');
            div03.appendChild(div04);
            let div02 = document.createElement('div');
            div02.setAttribute('class', 'local--max--img');
            div00.appendChild(div02);
            let rem = e.style.backgroundImage;
            let rem00 = rem.replace('url("', ' ');
            let rem01 = rem00.replace('")', '');
            let img = document.createElement('img');
            img.setAttribute('src', rem01);
            div02.appendChild(img);
            qs('html').style.overflow = 'hidden';
            document.body.insertBefore(div00, qs('script'));
            setTimeout(() => {
                qs('.img--modal').style.opacity = '1';
            }, 50)
            function exit_img() {
                qs('.img--modal').style.opacity = '0';
                setTimeout(() => {
                    qs('.img--modal').remove();
                }, 50)
                qs('html').style.overflow = '';
                return true;
            }
            event_exit.addEventListener('click', exit_img, true);
            div03.addEventListener('click', exit_img, true);
        });
    });
}
async function post_num_curtida() {
    let url_perfil = window.location.href.split('=');
    let url_push_v = window.location.href.split('paginas/');
    let req_;
    let json_;
    if (url_push_v[1] == 'inicial.php' || url_push_v[1] == 'curtidas.php' || url_push_v[1].split('?'[0] == 'curtidas_v.php')) {
        req_ = await fetch('../assets/script/php/requsicoes/posts.php');
        json_ = await req_.json();
        for (let s in json_) {
            let calc = parseInt(s) + parseInt(quan_novos);
            if (json_[s]['type'] == "3") {
                let curtidaArea = document.getElementById(json_[s]['id_publi']);
                if (curtidaArea != undefined) {
                    curtidaArea.querySelector('.post_curtidas').innerHTML = json_[s]['num_curtidas'];
                    if (json_[s]['user_curtiu']) {
                        curtidaArea.querySelector('button').classList.remove();
                        curtidaArea.classList.remove('p-xD30');
                        curtidaArea.classList.add('p-xD29');
                        curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                        desCurtir();
                    } else {
                        curtidaArea.querySelector('button').classList.remove();
                        curtidaArea.classList.remove('p-xD29');
                        curtidaArea.classList.add('p-xD30');
                        curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off');
                        curtir_post();
                    }
                }
            } else {
                //tava arrumando o curtidas //
                let curtidaArea = document.getElementById(json_[s]['compartilhador_info']['id_da_compartilhada']);
                if (curtidaArea != undefined) {
                    curtidaArea.querySelector('.post_curtidas').innerHTML = json_[s]['num_curtidas'];
                    if (json_[s]['user_curtiu']) {
                        curtidaArea.querySelector('button').classList.remove();
                        curtidaArea.classList.remove('p-xD30');
                        curtidaArea.classList.add('p-xD29');
                        curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                        desCurtir();
                    } else {
                        curtidaArea.querySelector('button').classList.remove();
                        curtidaArea.classList.remove('p-xD29');
                        curtidaArea.classList.add('p-xD30');
                        curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off');
                        curtir_post();
                    }
                }
            }
        }
    } else {
        if (url_push_v[1] == 'perfil.php') {
            req_ = await fetch('../assets/script/php/requsicoes/posts_users.php?username=' + username);
            json_ = await req_.json();
            if (json_.publi.nada == undefined) {
                for (let s in json_.publi) {
                    let calc = parseInt(s) + parseInt(quan_novos);
                    if (json_.publi[s]['type'] == "3") {
                        let curtidaArea = document.getElementById(json_.publi[s]['id_publi']);
                        if (curtidaArea != undefined) {
                            curtidaArea.querySelector('.post_curtidas').innerHTML = json_.publi[s]['num_curtidas'];
                            if (json_.publi[s]['user_curtiu']) {
                                curtidaArea.querySelector('button').classList.remove();
                                curtidaArea.classList.remove('p-xD30');
                                curtidaArea.classList.add('p-xD29');
                                curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                                desCurtir();
                            } else {
                                curtidaArea.querySelector('button').classList.remove();
                                curtidaArea.classList.remove('p-xD29');
                                curtidaArea.classList.add('p-xD30');
                                curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off');
                                curtir_post();
                            }
                        }
                    } else {
                        let curtidaArea = document.getElementById(json_.publi[s]['compartilhador_info']['id_da_compartilhada']);
                        if (curtidaArea != undefined) {
                            curtidaArea.querySelector('.post_curtidas').innerHTML = json_.publi[s]['num_curtidas'];
                            if (json_.publi[s]['user_curtiu']) {
                                curtidaArea.querySelector('button').classList.remove();
                                curtidaArea.classList.remove('p-xD30');
                                curtidaArea.classList.add('p-xD29');
                                curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                                desCurtir();
                            } else {
                                curtidaArea.querySelector('button').classList.remove();
                                curtidaArea.classList.remove('p-xD29');
                                curtidaArea.classList.add('p-xD30');
                                curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off');
                                curtir_post();
                            }
                        }
                    }
                }
            }
        } else {
            req_ = await fetch('../assets/script/php/requsicoes/posts_users.php?username=' + url_perfil[1]);
            json_ = await req_.json();
            if (json_.publi.nada == undefined) {
                for (let s in json_.publi) {
                    let calc = parseInt(s) + parseInt(quan_novos);
                    if (json_.publi[s]['type'] == "3") {
                        let curtidaArea = document.getElementById(json_.publi[s]['id_publi']);
                        if (curtidaArea != undefined) {
                            curtidaArea.querySelector('.post_curtidas').innerHTML = json_.publi[s]['num_curtidas'];
                            if (json_.publi[s]['user_curtiu']) {
                                curtidaArea.querySelector('button').classList.remove();
                                curtidaArea.classList.remove('p-xD30');
                                curtidaArea.classList.add('p-xD29');
                                curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                                desCurtir();
                            } else {
                                curtidaArea.querySelector('button').classList.remove();
                                curtidaArea.classList.remove('p-xD29');
                                curtidaArea.classList.add('p-xD30');
                                curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off');
                                curtir_post();
                            }
                        }
                    } else {
                        let curtidaArea = document.getElementById(json_.publi[s]['compartilhador_info']['id_da_compartilhada']);
                        if (curtidaArea != undefined) {
                            curtidaArea.querySelector('.post_curtidas').innerHTML = json_.publi[s]['num_curtidas'];
                            if (json_.publi[s]['user_curtiu']) {
                                curtidaArea.querySelector('button').classList.remove();
                                curtidaArea.classList.remove('p-xD30');
                                curtidaArea.classList.add('p-xD29');
                                curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                                desCurtir();
                            } else {
                                curtidaArea.querySelector('button').classList.remove();
                                curtidaArea.classList.remove('p-xD29');
                                curtidaArea.classList.add('p-xD30');
                                curtidaArea.querySelector('button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off');
                                curtir_post();
                            }
                        }
                    }
                }
            }
        }
    } // document.getElementById(c_jso[s]['id_publi']).innerHTML = c_jso[s]['num_curtidas'];

}

async function compartilhar() {
    let form_ = document.createElement('form');
    let input_a = document.createElement('input');
    input_a.setAttribute('name', 'direct');
    input_a.setAttribute('value', qs('.event-direct').id);
    form_.appendChild(input_a);
    let newF = new FormData(form_);

    let compartilhar = await fetch('../assets/script/php/interacoes_post/compartilhar.php', {
        method: 'POST',
        body: newF
    })
    let res = await compartilhar.json();
    let modal = qs('.modal--shared');
    modal.style.opacity = 0;
    setTimeout(() => {
        modal.style = '';
        qs('.modal-area').style.display = 'none';
        modal.style.display = 'none';
    })
    alert_mensage(res);
    console.log(res);
    post_num_compartilhamento();
}

let modal_repost_coment = document.querySelector('.modal--coment--repost--area');
let clone_MD_RC = modal_repost_coment.cloneNode(true);
modal_repost_coment.remove();
let modal_repost = false;
async function compartilhar_comentario() {//All_xD30
    //criar modal antes da requisição
    if (modal_repost == false) {
        modal_repost = true;
        qs('.feed-area').append(clone_MD_RC);
        input_div_valid();
        showImg_form(qs('#midia_compatilhamento_coment'), qs('.post_img_area'), false);//function para gerar img ou video(forma mais rapida)
        qs(".exit--area--body_coment").addEventListener('click', compartilhar_comentario, true);
        qs('.exit--modal--repost--coment').addEventListener('click', compartilhar_comentario, true);
        clone_MD_RC.style.display = '';
        document.querySelector('html').style.overflow = 'hidden';
        setTimeout(() => {
            clone_MD_RC.style.opacity = 1;
        }, 15);
        //acaba com o modal-shared aberto
        if (qs('.modal--shared') != undefined) {
            let modal = qs('.modal--shared');
            modal.style.opacity = 0;
            modal.style = '';
            qs('.modal-area').style.display = 'none';
            modal.style.display = 'none';
        }
        //requisição
        let form_aux = document.createElement('form');
        form_aux.setAttribute('method', 'POST');
        let input_aux = document.createElement('input');
        input_aux.setAttribute('name', 'All_xD30');
        input_aux.setAttribute('value', qs('.event--repost--coment').id);
        form_aux.appendChild(input_aux);
        let info_aux = new FormData(form_aux);
        let post_completo = await fetch('../assets/script/php/requsicoes/post_completo.php', {
            method: 'POST',
            body: info_aux
        });
        let resultado = await post_completo.json();
        console.log(resultado);
        if (clone_MD_RC.querySelector('.back--event') != undefined) {
            clone_MD_RC.querySelector('.back--event').remove();
        }
        clone_MD_RC.querySelector('.area--post--respostado').style = '';
        clone_MD_RC.querySelector('.area--perfil--repostado').style.display = '';
        clone_MD_RC.querySelector('.name--name-perfil-comp').innerHTML = resultado.publicacao.user_info.nome_user;
        clone_MD_RC.querySelector('.name--username-perfil-comp').innerHTML = resultado.publicacao.user_info.username_user;
        clone_MD_RC.querySelector('.img--perfil-reduz').style = resultado.publicacao.user_info.img_user;
        if (resultado.publicacao.text_post == "" || resultado.publicacao.text_post == null) {
            clone_MD_RC.querySelector('.post--text').style.display = 'none';
        } else {
            clone_MD_RC.querySelector('.post--text').style = '';
            clone_MD_RC.querySelector('.post--text').innerHTML = resultado.publicacao.text_post
        }
        if (resultado.publicacao.img_publi == "" || resultado.publicacao.img_publi == null) {
            clone_MD_RC.querySelector('.post--img-area').style.display = 'none';
        } else {
            clone_MD_RC.querySelector('.post--img-area').style = '';
            let extensao = resultado.publicacao.img_publi.split('.');
            console.log(extensao);
            if (extensao[1] == 'mp4') {
                clone_MD_RC.querySelector('.post--img').style = '';
                clone_MD_RC.querySelector('.post--img').style.display = 'none';
                let creat_video = document.createElement('video');
                creat_video.setAttribute('src', `../assets/imgs/posts/${resultado.publicacao.img_publi}`);
                creat_video.setAttribute('controls', '');
                creat_video.setAttribute('class', 'post--img post--img-area');
                clone_MD_RC.querySelector('.post--img-area').append(creat_video);
            } else {
                clone_MD_RC.querySelector('.post--img').style = '';
                clone_MD_RC.querySelector('.post--img').style.backgroundImage = `url(../assets/imgs/posts/${resultado.publicacao.img_publi})`;
            }
        }
        qs('.area--modal--coment--repost button').onclick = async () => {
            if (qs('.input_hidden_coment_compartilhada').value == '' && qs('#midia_compatilhamento_coment').value == '') {
                qs('.placeholder--editediv').click();
            } else {
                let input1 = qs('.input_hidden_coment_compartilhada').cloneNode(true);
                let input2 = qs('#midia_compatilhamento_coment').cloneNode(true);
                let input3 = document.createElement('input');
                input3.setAttribute('name', 'cI_xd30');
                input3.setAttribute('value', qs('.event--repost--coment').id);
                let formHtml = document.createElement('form');
                formHtml.setAttribute('method', 'POST');
                formHtml.appendChild(input1);
                formHtml.appendChild(input2);
                formHtml.appendChild(input3);
                console.log(formHtml);
                let form = new FormData(formHtml);
                let req_post = await fetch('../assets/script/php/interacoes_post/compartilhar_c_comentario.php', {
                    method: 'POST',
                    body: form
                })
                let res_req = await req_post.json();
                console.log(res_req);
                alert_mensage(res_req);
                // coisa especificas
                compartilhar_comentario();
            }

        }
    } else {
        //retorna para o padrao default
        modal_repost = false;
        clone_MD_RC.style.opacity = 0;
        document.querySelector('html').style.overflow = '';
        setTimeout(() => {
            clone_MD_RC.style.display = 'none';
            document.querySelector('.modal--coment--repost--area').remove();
        }, 100);

    }
}
function input_div_valid() {
    qs('.placeholder--editediv').addEventListener('click', (e) => {
        qs('.diveditable--coment--repost').innerText = '';
        qs('.diveditable--coment--repost').style.display = 'block';
        qs('.diveditable--coment--repost').focus();
        qs('.placeholder--editediv').style.display = 'none';
    }, true);
    let div_e = qs('.diveditable--coment--repost');
    div_e.addEventListener('blur', () => {
        console.log(div_e.innerText.length);
        if (div_e.innerText.trim() == "") {
            qs('.diveditable--coment--repost').style.display = 'none';
            qs('.placeholder--editediv').style.display = 'block';
            qs('.input_hidden_coment_compartilhada').value = null;
        } else {
            qs('.input_hidden_coment_compartilhada').value = div_e.innerText;
        }
    })
}

qs('.event--repost--coment').addEventListener('click', compartilhar_comentario, true);

function descompartilhar() {
    qsAll('.descompartilhar-event').forEach((e) => {
        e.onclick = async () => {
            let id_button = e.id.replace('c-xD30', '');
            let value_pomisse = new FormData();
            value_pomisse.append('c-pXD30', id_button)
            console.log(id_button)
            let promisse = await fetch('../assets/script/php/interacoes_post/descompartilhar.php', {
                method: 'POST',
                body: value_pomisse
            });
            let resposta = await promisse.json();
            console.log(resposta);
            if (document.getElementById(resposta.id_descompartilhada + 'pt-xD30') != undefined) {
                document.getElementById(resposta.id_descompartilhada + 'pt-xD30').remove();
            }
            post_num_compartilhamento();

        }
    })
}
async function post_num_compartilhamento() {

    let url_perfil = window.location.href.split('=');
    let url_push_v = window.location.href.split('paginas/');
    let a = url_push_v[1].substring(0, 11);

    if (a == 'inicial.php') {
        let prom = await fetch('../assets/script/php/requsicoes/posts.php');
        let res_pom = await prom.json();
        for (let l in res_pom) {
            if (res_pom[l]['type'] == 3) {
                let repostArea = document.getElementById(res_pom[l]['id_publi'] + 'c-xD30');
                repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom[l]['beepadas'];
                if (res_pom[l]['user_compartilhou']) {
                    repostArea.classList.remove();
                    repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button descompartilhar-event');
                    repostArea.querySelector('button').classList.remove();
                    repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-on descompartilhar');
                    descompartilhar()
                } else {
                    repostArea.classList.remove();
                    repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button compartilhar');
                    repostArea.querySelector('button').classList.remove();
                    repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-off');
                    show_CM();
                }
            } else {
                let repostArea = document.getElementById(res_pom[l]['compartilhador_info']['id_da_compartilhada'] + 'c-xD30');
                if (repostArea != undefined) {
                    repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom[l]['beepadas'];
                    if (res_pom[l]['user_compartilhou']) {
                        repostArea.classList.remove();
                        repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button descompartilhar-event');
                        repostArea.querySelector('button').classList.remove();
                        repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-on descompartilhar');
                        descompartilhar()
                    } else {
                        repostArea.classList.remove();
                        repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button compartilhar');
                        repostArea.querySelector('button').classList.remove();
                        repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-off');
                        show_CM();
                    }
                }
            }
        }
    } else {
        a = url_push_v[1].substring(0, 10);
        if (a == 'perfil.php') {
            req_ = await fetch('../assets/script/php/requsicoes/posts_users.php?username=' + username);
            res_pom = await req_.json();
            if (res_pom.publi.nada == undefined) {
                for (let l in res_pom.publi) {
                    if (res_pom.publi[l]["type"] == "3") {
                        let repostArea = document.getElementById(res_pom.publi[l]['id_publi'] + 'c-xD30');
                        repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom.publi[l]['beepadas'];
                        if (res_pom.publi[l]['user_compartilhou']) {
                            repostArea.classList.remove();
                            repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button descompartilhar-event');
                            repostArea.querySelector('button').classList.remove();
                            repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-on descompartilhar');
                            descompartilhar()
                        } else {
                            repostArea.classList.remove();
                            repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button compartilhar');
                            repostArea.querySelector('button').classList.remove();
                            repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-off');
                            show_CM();
                        }
                    } else {
                        let repostArea = document.getElementById(res_pom.publi[l]['compartilhador_info']['id_da_compartilhada'] + 'c-xD30');
                        if (repostArea != undefined) {
                            repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom.publi[l]['beepadas'];
                            if (res_pom.publi[l]['user_compartilhou']) {
                                repostArea.classList.remove();
                                repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button descompartilhar-event');
                                repostArea.querySelector('button').classList.remove();
                                repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-on descompartilhar');
                                descompartilhar()
                            } else {
                                repostArea.classList.remove();
                                repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button compartilhar');
                                repostArea.querySelector('button').classList.remove();
                                repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-off');
                                show_CM()

                            }
                        }
                    }
                }
            }
        } else if (url_push_v[1] == 'curtidas.php' || url_push_v[1].split('?')[0] == 'curtidas_v.php') {
            let req_C = await fetch('../assets/script/php/requsicoes/curtidas_posts.php');
            if (url_push_v[1].split('?')[0] == 'curtidas_v.php') {
                req_C = await fetch('../assets/script/php/requsicoes/curtidas_posts.php?username=' + url_push_v[1].split('?username=')[1]);
            }
            res_pom = await req_C.json();
            for (let l in res_pom) {
                if (res_pom[l]['type'] == 3) {
                    let repostArea = document.getElementById(res_pom[l]['id_publi'] + 'c-xD30');
                    repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom[l]['beepadas'];
                    if (res_pom[l]['user_compartilhou']) {
                        repostArea.classList.remove();
                        repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button descompartilhar-event');
                        repostArea.querySelector('button').classList.remove();
                        repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-on descompartilhar');
                        descompartilhar()
                    } else {
                        repostArea.classList.remove();
                        repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button compartilhar');
                        repostArea.querySelector('button').classList.remove();
                        repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-off');
                        show_CM()
                    }
                } else {
                    let repostArea = document.getElementById(res_pom[l]['compartilhador_info']['id_da_compartilhada'] + 'c-xD30');
                    if (repostArea != undefined) {
                        repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom[l]['beepadas'];
                        if (res_pom[l]['user_compartilhou']) {
                            repostArea.classList.remove();
                            repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button descompartilhar-event');
                            repostArea.querySelector('button').classList.remove();
                            repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-on descompartilhar');
                            descompartilhar()
                        } else {
                            repostArea.classList.remove();
                            repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button compartilhar');
                            repostArea.querySelector('button').classList.remove();
                            repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-off');
                            show_CM()
                        }
                    }
                }
            }
        } else {
            req_ = await fetch('../assets/script/php/requsicoes/posts_users.php?username=' + url_perfil[1]);
            res_pom = await req_.json();
            if (res_pom.error == undefined) {
                if (res_pom.publi.nada == undefined) {
                    for (let l in res_pom.publi) {
                        if (res_pom.publi[l]["type"] == "3") {
                            let repostArea = document.getElementById(res_pom.publi[l]['id_publi'] + 'c-xD30');
                            repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom.publi[l]['beepadas'];
                            if (res_pom.publi[l]['user_compartilhou']) {
                                repostArea.classList.remove();
                                repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button descompartilhar-event');
                                repostArea.querySelector('button').classList.remove();
                                repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-on descompartilhar');
                                descompartilhar()
                            } else {
                                repostArea.classList.remove();
                                repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button compartilhar');
                                repostArea.querySelector('button').classList.remove();
                                repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-off');
                                show_CM()
                            }
                        } else {
                            let repostArea = document.getElementById(res_pom.publi[l]['compartilhador_info']['id_da_compartilhada'] + 'c-xD30');
                            if (repostArea != undefined) {
                                repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom.publi[l]['beepadas'];
                                if (res_pom.publi[l]['user_compartilhou']) {
                                    repostArea.classList.remove();
                                    repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button descompartilhar-event');
                                    repostArea.querySelector('button').classList.remove();
                                    repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-on descompartilhar');
                                    descompartilhar();
                                } else {
                                    repostArea.classList.remove();
                                    repostArea.setAttribute('class', 'compartilhar-hover compartilhar-event-div interac-button compartilhar');
                                    repostArea.querySelector('button').classList.remove();
                                    repostArea.querySelector('button').setAttribute('class', 'compartilhar-event img--iteracao img--strong button--remove interacao--area img-compartilhar-off');
                                    show_CM();

                                }
                            }
                        }
                    }
                }
            }
        }
    }

}

async function post_all() {
    let postagem_all = window.location.href;
    let info = postagem_all.split('=');
    if (info[1] == undefined || info[1] == '') {
        window.location.href = 'inicial.php';
    } else {
        let form_aux = document.createElement('form');
        form_aux.setAttribute('method', 'POST');
        let input_aux = document.createElement('input');
        input_aux.setAttribute('name', 'All_xD30');
        input_aux.setAttribute('value', info[1]);
        form_aux.appendChild(input_aux);
        let info_aux = new FormData(form_aux);
        let post_completo = await fetch('../assets/script/php/requsicoes/post_completo.php', {
            method: 'POST',
            body: info_aux
        });
        let res_aux = await post_completo.json();
        console.log(res_aux);
        post_all_creat(res_aux);
        curtir_post();
        desCurtir();

    }
}
function post_all_creat(obj) {
    if (obj.error != true) {
        let area_post_completo = qs('.post-completo-area .post--area-header');
        area_post_completo.querySelector('.menu--pag--img--area').setAttribute('style', obj.publicacao.user_info.img_user);
        area_post_completo.querySelector('.perfil-link').setAttribute('href', 'perfil_user_v.php?username=' + obj.publicacao.user_info.username_user);
        area_post_completo.querySelector('.name--name-perfil').innerHTML = obj.publicacao.user_info.nome_user;
        area_post_completo.querySelector('.name--username-perfil').innerHTML = obj.publicacao.user_info.username_user;
        coment(area_post_completo.querySelector('.comentar'));
        if (obj.publicacao.text_post == '' || obj.publicacao.text_post == null) {
            area_post_completo.querySelector('.post--text').remove();
        } else {
            area_post_completo.querySelector('.post--text').innerHTML = obj.publicacao.text_post;
        }
        let area_img = qs('.post--area-header .p-30d_10');
        console.log(area_img);
        if (obj.publicacao.img_publi == '' || obj.publicacao.img_publi == null) {
            area_img.remove()
        } else {
            let type_midia = obj.publicacao.img_publi.split('.');
            console.log(type_midia);
            if (type_midia[1] == 'mp4') {
                area_img.querySelector('.event').remove();
                area_img.querySelector('img').remove();
                let video_creat = document.createElement('video');
                video_creat.setAttribute('src', `../assets/imgs/posts/${obj.publicacao.img_publi}`);
                video_creat.setAttribute('controls', '');
                video_creat.setAttribute('class', 'post--img post--img-area');
                area_img.appendChild(video_creat);
            } else {
                area_img.querySelector('.event').remove();
                area_img.querySelector('img').setAttribute('src', '../assets/imgs/posts/' + obj.publicacao.img_publi);
                area_img.querySelector('img').style.display = '';
            }
        }
        area_post_completo.querySelector('.num--curtidas').innerHTML = obj.publicacao.num_curtidas;
        area_post_completo.querySelector('.num--coment').innerHTML = obj.publicacao.num_comentario;
        area_post_completo.querySelector('.num--compartilha').innerHTML = obj.publicacao.beepadas;
        //-------------------------gera o jogo na tela----------------
        if (obj.publicacao.game_publi.game_id != "" || obj.publicacao.game_publi.game_id != null) {
            area_post_completo.querySelector('.game').innerHTML = obj.publicacao.game_publi.game_nome;
            let aux_game = {
                "id_game": obj.publicacao.game_publi.game_id
            }
            area_post_completo.querySelector('.game').onclick = (e) => show_game(aux_game, e);;
        }
        //-------------------gera a quem foi respondido a publicação----------
        if (obj.publicacao.type == "1" || obj.publicacao.type == "2") {
            area_post_completo.querySelector('.resposta--area-post_all').style.display = '';
            area_post_completo.querySelector('.resposta--area-post_all .resposta-link').href = `perfil_user_v.php?username=${obj.publicacao.c_comentada.user_info.username_user}`;
            area_post_completo.querySelector('.resposta--area-post_all .resposta-link').innerHTML = obj.publicacao.c_comentada.user_info.username_user;
        }
        area_post_completo.querySelector('.info--post--complete .date--complete').innerHTML = `${obj.publicacao.date_publi_ca} as ${obj.publicacao.date_publi_hr}`;
        area_post_completo.querySelector('.info--post--complete .date--post').innerHTML = obj.publicacao.date_publi;
        area_post_completo.querySelector('.event--curtida').id = obj.publicacao.id_publi;
        area_post_completo.querySelector('.event--curtida input').value = obj.publicacao.id_publi;
        if (obj.publicacao.user_curtiu) {
            area_post_completo.querySelector('.event--curtida').setAttribute('data-key', obj.publicacao.id_publi);
            area_post_completo.querySelector('.event--curtida').classList.add('p-xD29');
            area_post_completo.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
        } else {
            area_post_completo.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
            area_post_completo.querySelector('.event--curtida').classList.add('p-xD30');
            area_post_completo.querySelector('.event--curtida').setAttribute('data-key', obj.publicacao.id_publi);
        }
        area_post_completo.querySelector('.comentar').id = 'p_xD30_C' + obj.publicacao.id_publi;
        let conteudo_type_2 = area_post_completo.querySelector('.post_type2_conteudo');
        console.log(obj);
        if (obj.publicacao.type == "2") {
            conteudo_type_2.style.display = '';
            // ------------------- verfica se a publicação existe --------------
            if (obj.publicacao.c_comentada.id_publi == null) {
                conteudo_type_2.innerHTML = '';
                let mensagem = document.createElement('div');
                mensagem.setAttribute('class', 'mensagem_post_time');
                mensagem.innerHTML = 'Essa publicação não está mais disponível.'
                conteudo_type_2.append(mensagem);
            } else {
                if (obj.publicacao.c_comentada.quarentena < 1) {
                    conteudo_type_2.querySelector('.menu--pag--img--area').setAttribute('style', obj.publicacao.c_comentada.user_info.img_user);
                    conteudo_type_2.querySelector('.perfil-link').setAttribute('href', 'perfil_user_v.php?username=' + obj.publicacao.c_comentada.user_info.username_user);
                    conteudo_type_2.querySelector('.name--name-perfil').innerHTML = obj.publicacao.c_comentada.user_info.nome_user;
                    conteudo_type_2.querySelector('.name--username-perfil').innerHTML = obj.publicacao.c_comentada.user_info.username_user;
                    if (obj.publicacao.c_comentada.text_post == '' || obj.publicacao.c_comentada.text_post == null) {
                        conteudo_type_2.querySelector('.post--text').remove();
                    } else {
                        conteudo_type_2.querySelector('.post--text').innerHTML = obj.publicacao.c_comentada.text_post;
                    }
                    //nem sei para que serve lkkkkkkkkkkkkkkkkk (o pior que foi eu mesmo q fiz kkkkkkkkkkk)
                    let area_img = qs('.post--area-header .p-30d_10');
                    if (obj.publicacao.c_comentada.img_publi == '' || obj.publicacao.c_comentada.img_publi == null) {
                        area_img.remove()
                    } else {
                        let type_midia = obj.publicacao.c_comentada.img_publi.split('.');
                        console.log(type_midia);
                        if (type_midia[1] == 'mp4') {
                            area_img.querySelector('.event').remove();
                            area_img.querySelector('img').remove();
                            let video_creat = document.createElement('video');
                            video_creat.setAttribute('src', `../assets/imgs/posts/${obj.publicacao.c_comentada.img_publi}`);
                            video_creat.setAttribute('controls', '');
                            video_creat.setAttribute('class', 'post--img post--img-area');
                            area_img.appendChild(video_creat);
                        } else {
                            area_img.querySelector('.event').remove();
                            area_img.querySelector('img').setAttribute('src', '../assets/imgs/posts/' + obj.publicacao.c_comentada.img_publi);
                            area_img.querySelector('img').style.display = '';
                        }
                    }
                    conteudo_type_2.querySelector('.conteudo--all--post').href = 'postagem.php?postagem=' + obj.publicacao.c_comentada.id_publi;
                    conteudo_type_2.querySelector('.date--post').innerHTML = obj.publicacao.c_comentada.date_publi;
                } else {
                    conteudo_type_2.innerHTML = '';
                    let mensagem = document.createElement('div');
                    mensagem.setAttribute('class', 'mensagem_post_time');
                    mensagem.innerHTML = 'Essa publicação foi suspensa.'
                    conteudo_type_2.append(mensagem);
                }
            }
        } else {
            if (conteudo_type_2 != undefined) {
                conteudo_type_2.remove()
            }
        }
        let conteudo_type_1 = qs('.post--area--raiz');
        if (obj.publicacao.type == "1") {

            conteudo_type_1.style.display = '';
            //----------------------verfica se ela a publicação comentada existe--------------

            if (obj.publicacao.c_comentada.id_publi == null) {
                document.querySelector(".post--area--raiz").innerHTML = '';
                let mensagem = document.createElement('div');
                mensagem.setAttribute('class', 'mensagem_post_time');
                mensagem.innerHTML = 'Essa publicação não existe mais.';
                document.querySelector(".post--area--raiz").append(mensagem);
            } else {
                if (obj.publicacao.c_comentada.quarentena == 0) {
                    conteudo_type_1.querySelector('.menu--pag--img--area').setAttribute('style', obj.publicacao.c_comentada.user_info.img_user);
                    conteudo_type_1.querySelector('.perfil-link').setAttribute('href', 'perfil_user_v.php?username=' + obj.publicacao.c_comentada.user_info.username_user);
                    conteudo_type_1.querySelector('.name--name-perfil').innerHTML = obj.publicacao.c_comentada.user_info.nome_user;
                    conteudo_type_1.querySelector('.name--username-perfil').innerHTML = obj.publicacao.c_comentada.user_info.username_user;
                    if (obj.publicacao.c_comentada.text_post == '' || obj.publicacao.c_comentada.text_post == null) {
                        conteudo_type_1.querySelector('.post--text').remove();
                    } else {
                        conteudo_type_1.querySelector('.post--text').innerHTML = obj.publicacao.c_comentada.text_post;
                    }
                    let area_img = qs('.post--area--raiz .p-30d_10');
                    if (obj.publicacao.c_comentada.img_publi == '' || obj.publicacao.c_comentada.img_publi == null) {
                        area_img.remove()
                    } else {
                        let type_midia = obj.publicacao.c_comentada.img_publi.split('.');
                        console.log(type_midia);
                        if (type_midia[1] == 'mp4') {
                            area_img.querySelector('.event').remove();
                            area_img.querySelector('img').remove();
                            let video_creat = document.createElement('video');
                            video_creat.setAttribute('src', `../assets/imgs/posts/${obj.publicacao.c_comentada.img_publi}`);
                            video_creat.setAttribute('controls', '');
                            video_creat.setAttribute('class', 'post--img post--img-area');
                            area_img.appendChild(video_creat);
                        } else {
                            area_img.querySelector('.event').remove();
                            area_img.querySelector('img').setAttribute('src', '../assets/imgs/posts/' + obj.publicacao.c_comentada.img_publi);
                            area_img.querySelector('img').style.display = '';
                        }
                    }
                    conteudo_type_1.querySelector('.conteudo--all--post').href = 'postagem.php?postagem=' + obj.publicacao.c_comentada.id_publi;
                    conteudo_type_1.querySelector('.date--post').innerHTML = obj.publicacao.c_comentada.date_publi;
                } else {
                    document.querySelector(".post--area--raiz").innerHTML = '';
                    let mensagem = document.createElement('div');
                    mensagem.setAttribute('class', 'mensagem_post_time');
                    mensagem.innerHTML = 'Essa publicação foi suspensa.';
                    document.querySelector(".post--area--raiz").append(mensagem);
                }
            }
        } else {
            if (conteudo_type_1 != undefined) {
                conteudo_type_1.remove();
            }
        }
        //gera a area de comentarios
        if (obj.comentarios != undefined) {
            for (let bobSponja in obj.comentarios) {
                let areaPalhacada = qs('.coment--area').cloneNode(true);
                areaPalhacada.style = '';
                areaPalhacada.querySelector('.post--area--perfil-coment .menu--pag--img--area').setAttribute('style', obj.comentarios[bobSponja].user_info.img_user);
                let load = areaPalhacada.querySelector('.post--area--perfil-coment .menu--pag--img--area').querySelector('.back--event');
                if (load != undefined) {
                    load.remove()
                }
                areaPalhacada.querySelector('.perfil-link').setAttribute('href', `perfil_user_v.php?username=${obj.comentarios[bobSponja].user_info.username_user}`);
                areaPalhacada.querySelector('.name--perfil--coment').innerHTML = obj.comentarios[bobSponja].user_info.nome_user;
                areaPalhacada.querySelector('.username--perfil--coment').innerHTML = `(${obj.comentarios[bobSponja].user_info.username_user})`;
                areaPalhacada.querySelector('.date--post').innerHTML = obj.comentarios[bobSponja].date_publi;
                if (obj.comentarios[bobSponja].img_publi == "" || obj.comentarios[bobSponja].img_publi == undefined || obj.comentarios[bobSponja].img_publi == null) {
                    areaPalhacada.querySelector('.post--img-area').remove();
                } else {
                    let type_midia = obj.comentarios[bobSponja].img_publi.split('.');
                    if (type_midia[1] == 'mp4') {
                        areaPalhacada.querySelector('.post--img').remove();
                        areaPalhacada.querySelector('.post--img-area').style.display = '';
                        areaPalhacada.querySelector('.post--img-area').classList.add('area_midia_video');
                        let video_creat = document.createElement('video');
                        video_creat.setAttribute('src', `../assets/imgs/posts/${obj.comentarios[bobSponja].img_publi}`);
                        video_creat.setAttribute('controls', '');
                        areaPalhacada.querySelector('.post--img-area').appendChild(video_creat);
                    } else {
                        areaPalhacada.querySelector('.post--img-area').style.display = '';
                        areaPalhacada.querySelector('.post--img').style.backgroundImage = `url(../assets/imgs/posts/${obj.comentarios[bobSponja].img_publi})`;
                    }
                }
                if (obj.comentarios[bobSponja].text_post == undefined || obj.comentarios[bobSponja].text_post == null || obj.comentarios[bobSponja].text_post == '') {
                    areaPalhacada.querySelector('.coment--conteudo--text').remove();
                } else {
                    areaPalhacada.querySelector('.post--text').innerHTML = obj.comentarios[bobSponja].text_post;
                }
                coment(areaPalhacada.querySelector('.comentar'));
                areaPalhacada.querySelector('.event--curtida').id = obj.comentarios[bobSponja].id_publi;
                areaPalhacada.querySelector('.event--curtida input').value = obj.comentarios[bobSponja].id_publi;
                if (obj.comentarios[bobSponja].user_curtiu) {
                    areaPalhacada.querySelector('.event--curtida').classList.add('p-xD29');
                    areaPalhacada.querySelector('.event--curtida button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                } else {
                    areaPalhacada.querySelector('.event--curtida').classList.add('p-xD30');
                    areaPalhacada.querySelector('.event--curtida button').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off');
                }
                areaPalhacada.querySelector('.post_curtidas').innerHTML = obj.comentarios[bobSponja].num_curtidas;
                areaPalhacada.querySelector('.comentar').id = 'p_xD30_C' + obj.comentarios[bobSponja].id_publi;
                areaPalhacada.querySelector('.conteudo--all--post').href = 'postagem.php?postagem=' + obj.comentarios[bobSponja].id_publi;
                qs('.post-comentario--area').append(areaPalhacada);
            }
            qs('.coment--area').remove();

        } else {
            post_not('coment');
            qs('.post-comentario--area .coment--area').remove();
        }
    } else {
        let mensagem = document.createElement('div');
        //feed-body-post
        mensagem.setAttribute('class', 'mensagem_post');
        mensagem.textContent = obj.mensage;
        qs(".feed-body-post").innerHTML = "";
        qs('.feed-body-post').append(mensagem);
    }
}
async function user__curtidas() {
    let username_vist = window.location.href.split('=');
    let user_vist = await fetch('../assets/script/php/requsicoes/posts_users.php?username=' + username_vist[1]);
    let user_v = await user_vist.json();
    console.log(user_v);
    if (user_v.error == undefined) {
        let user_vist_post = await fetch('../assets/script/php/requsicoes/curtidas_posts.php?username=' + username_vist[1]);
        let res_vist_post = await user_vist_post.json();
        console.log(res_vist_post)
        qsAll('.event').forEach((e) => { e.remove() });
        qsAll('.back--event').forEach((e) => { e.remove() });
        console.log(user_v)
        user_seguidores(user_v.user);
        seguidores_user();
        if (res_vist_post.nada == undefined) {
            res_vist_post.reverse();
            criarPosts(res_vist_post);
            curtir_post();
            desCurtir();
            viwimg();
            show_CM();
            descompartilhar();
            qs('.event-direct').onclick = compartilhar;
            setInterval(() => {
                post_num_curtida();
            }, 9000);
            post_num_compartilhamento();
            setInterval(async () => {
                post_num_compartilhamento();
            }, 9000);
        } else {
            post_not(2);
        }
    } else {
        not_requi(0);
        qs('.back--event').remove();
        qsAll('.event').forEach((e) => {
            e.remove();
        })
    }
}
async function game_perfil(user, add = true) {
    let req_game = await fetch('../assets/script/php/requsicoes/jogos/users_game.php?username=' + user, {
        method: 'GET',
    });
    let res_game = await req_game.json();
    if (qs('.back--event') != undefined) {
        qs('.back--event').remove();
    }
    if (res_game.nada == undefined) {
        if (add) {
            creat_game(res_game);
        } else {
            creat_game(res_game, add);
        }
    } else {
        post_not(4);
    }
    console.log(res_game);
}
function num_coment_dinamic() {
    let anterior;
    let inter = setInterval(async () => {
        let coment_req = await fetch('../assets/script/php/requsicoes/posts.php');
        let res_coment = await coment_req.json();
        if (res_coment.error == undefined) {
            for (let a in res_coment) {
                if (res_coment[a]["type"] == 3) {
                    let aux = qs('#p_xD30_C' + res_coment[a]['id_publi']);
                    if (aux != undefined) {
                        aux.querySelector('.area_num').innerHTML = res_coment[a]['num_comentario'];
                    }
                } else {
                    let aux_ = res_coment[a]['compartilhador_info']['id_da_compartilhada'];
                    let aux = document.getElementById('p_xD30_C' + aux_);
                    if (aux != undefined) {
                        aux.querySelector('.area_num').innerHTML = res_coment[a]['num_comentario'];
                    }
                }
            }
        } else {
            clearInterval(inter);
        }
    }, 9000)
}
num_coment_dinamic()
function not_requi(a) {
    if (a == 0) {
        qs('.info--perfil').innerHTML = '<p class=\'nada\'>Esse usuário não existe.</p>';
    }
}
