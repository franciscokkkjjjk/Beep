let post_d;
let scroll_ = false;
var atual;
let load = document.querySelector('.back--event');
let quan_novos = 0;
let button = document.createElement('button');
let div = document.querySelector('.event');
async function posts() {
    let posts = await fetch('../issets/script/php/requsicoes/posts.php');
    post_d =  await posts.json();
    load.style.display = 'none';
    console.log(post_d);
    if(post_d.nada == undefined) {
        criarPosts(post_d);
        curtir_post();
        desCurtir();
        viwimg();
        show_CM();
        descompartilhar();
        qs('.event-direct').onclick = compartilhar;
        setInterval( ()=>{
            post_num_curtida();
        }, 500);
        post_num_compartilhamento();
    } else {
        post_not(true);
    }
    }
    function curtir_post() {
        qsAll('.p-xD30').forEach( (e)=>{
            let curtida = new FormData(e);
            e.onclick =  async (a)=>{
                a.preventDefault();
                let moio = await fetch('../issets/script/php/interacoes_post/curtir.php', {
                    method: 'POST',
                    body: curtida,
                })
                let res = await moio.json();
                let num_curtidas = e.querySelector('.area_num').innerHTML;
                let convet = parseInt(num_curtidas)+1;
                e.querySelector('.area_num').innerHTML = convet;
                e.querySelector('button').classList.remove('img--iteracao-curtida');
                e.querySelector('button').classList.add('img--iteracao-curtida-on');
                e.querySelector('button').classList.add('img--iteracao-curtida-on')
                e.querySelector('button').classList.add('img--curtida--on');
                e.querySelector('button').classList.add('p-evt-box');
                setTimeout(()=>{
                    e.querySelector('button').classList.remove('p-evt-box');
                },0260)
                e.classList.remove('p-xD30');
                e.classList.add('p-xD29');
                desCurtir();
                
            }
        })
    }
    async function user_() {
        let username_vist = window.location.href.split('=');
        let user_vist = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+username_vist[1]);
        let user_v = await user_vist.json();
        qsAll('.event').forEach((e)=>{e.remove()});
        qsAll('.back--event').forEach((e)=>{e.remove()});
        console.log(user_v)
            user_seguidores(user_v.user);
        if(user_v.publi.nada == undefined) {
            criarPosts(user_v.publi)
            curtir_post();
            desCurtir();
            viwimg();
            show_CM();
            descompartilhar();
            qs('.event-direct').onclick = compartilhar;
            setInterval( ()=>{
                post_num_curtida();
            }, 500);
            post_num_compartilhamento();
            seguidores_session();
        } else {
            post_not(false);
        }
    }

    function criarPosts(lista) {
        for(var i in lista) {
            if(lista[i]['type'] == "3"){//postagem normal
                let post_body = document.querySelector('.type_1 .post--menu--area').cloneNode(true);
                post_body.id = lista[i]['id_publi']+'pt-xD30';
                post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['user_info']['img_user']);
                post_body.querySelector('.name--area a').setAttribute('href', `perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
                post_body.querySelector('.name--name-perfil').innerHTML = lista[i]['user_info']['nome_user'];
                post_body.querySelector('.name--username-perfil').innerHTML = lista[i]['user_info']['username_user'];
                post_body.querySelector('.date--post').innerHTML = lista[i]['date_publi'];
                if(lista[i]['text_post'] == '' || lista[i]['text_post'] == null) {
                    post_body.querySelector('.post--text').style.display = 'none';
                } else {
                    post_body.querySelector('.post--text').innerHTML = lista[i]['text_post'];
                }
                if(lista[i]['img_publi'] == ""){
                    
                }else {
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img').style.display = 'block';
                    post_body.querySelector('.post--img').style.backgroundImage = `url(../issets/imgs/posts/${lista[i]['img_publi']})`;
                }//p-xD30
                post_body.querySelector('.event--curtida input').value = lista[i]['id_publi'];
                post_body.querySelector('.post_compartilhadas').innerHTML = lista[i]['beepadas'];
                if(lista[i]['user_curtiu']){
                    post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['id_publi']);
                    post_body.querySelector('.event--curtida').classList.add('p-xD29');
                    post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                } else{
                    post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
                    post_body.querySelector('.event--curtida').classList.add('p-xD30');
                    post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['id_publi'])

                }
                if(lista[i]['user_compartilhou']) {
                    post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-on');
                    post_body.querySelector('.compartilhar-event-div').classList.add('descompartilhar-event');
                    post_body.querySelector('.compartilhar-event').classList.add('descompartilhar');
                    post_body.querySelector('.descompartilhar-event').id = lista[i]['id_publi']+'c-xD30';
                } else {
                    post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-off')
                    post_body.querySelector('.compartilhar-event-div').classList.add('compartilhar')
                    post_body.querySelector('.compartilhar').id = lista[i]['id_publi']+'c-xD30';
                }
                
                post_body.querySelector('.conteudo--all--post').href = 'postagem.php?postagem='+lista[i]['id_publi'];   
                post_body.querySelector('.event--curtida').setAttribute('id', lista[i]['id_publi']);
                document.querySelector('.feed-body-post').append(post_body);
            } else if (lista[i]['type'] == "2") {//repostagem com comentario 
                let post_body = document.querySelector('.type_2 .post--menu--area').cloneNode(true);
                post_body.id = lista[i]['compartilhador_info']['id_da_compartilhada']+'pt-xD30';
                post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['compartilhador_info']['img_user']);
                post_body.querySelector('.name--comp .perfil-link').setAttribute('href', `perfil_user_v.php?username=${lista[i]['compartilhador_info']['username_user']}`);
                post_body.querySelector('.name--name-perfil-comp_').innerHTML = lista[i]['compartilhador_info']['nome_user'];
                post_body.querySelector('.name--username-perfil-comp_').innerHTML = lista[i]['compartilhador_info']['username_user'];
                post_body.querySelector('.event--curtida-comp input').value = lista[i]['compartilhador_info']['id_da_compartilhada'];
                if(lista[i]['compartilhador_info']['text_compartilhada'] == '' || lista[i]['compartilhador_info']['text_compartilhada'] == null){
                    post_body.querySelector('.post--text_comp').style.display = 'none';
                } else {
                    post_body.querySelector('.post--text_comp').innerHTML = lista[i]['compartilhador_info']['text_compartilhada'];
                }
                post_body.querySelector('.post_compartilhadas').innerHTML = lista[i]['beepadas'];
                post_body.querySelector('.date--post-comp_').innerHTML = lista[i]['compartilhador_info']['date_publi_compartilhada'];
                post_body.querySelector('.img--perfil-comp').setAttribute('style', lista[i]['user_info']['img_user']);
                post_body.querySelector('.perfil-link-comp').setAttribute('href', `perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
                post_body.querySelector('.name--name-perfil-comp').innerHTML = lista[i]['user_info']['nome_user'];
                post_body.querySelector('.name--username-perfil-comp').innerHTML = lista[i]['user_info']['username_user'];
                post_body.querySelector('.date--post-comp').innerHTML = lista[i]['date_publi'];
                if(lista[i]['text_post'] == "" || lista[i]['text_post'] == null){
                    post_body.querySelector('.post--text--comp_2').style.display = 'none';
               
                } else {
                    post_body.querySelector('.post--text--comp_2').innerHTML = lista[i]['text_post'];
                }
                if(lista[i]['img_publi'] == '' || lista[i]['img_publi'] == null) {} else {
                    post_body.querySelector('.post--img-area-com').style.display= 'block';
                    post_body.querySelector('.post--img').style.backgroundImage = `url(../issets/imgs/posts/${lista[i]['img_publi']})`;
                }
                if(lista[i]['user_curtiu']){
                    post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['compartilhador_info']['id_da_compartilhada']);
                    post_body.querySelector('.event--curtida').classList.add('p-xD29');
                    post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                } else{
                    post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
                    post_body.querySelector('.event--curtida').classList.add('p-xD30');
                    post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['compartilhador_info']['id_da_compartilhada'])
                }
                if(lista[i]['user_compartilhou']) {
                    post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-on');
                    post_body.querySelector('.compartilhar-event').classList.add('descompartilhar');
                    post_body.querySelector('.compartilhar-event-div').classList.add('descompartilhar-event');
                    post_body.querySelector('.descompartilhar-event').id = lista[i]['compartilhador_info']['id_da_compartilhada']+'c-xD30';
                } else {
                    post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-off');
                    post_body.querySelector('.compartilhar-event-div').classList.add('compartilhar');
                    post_body.querySelector('.compartilhar').id = lista[i]['compartilhador_info']['id_da_compartilhada']+'c-xD30';
                }
                post_body.querySelector('.event--curtida').setAttribute('id', lista[i]['compartilhador_info']['id_da_compartilhada']);
                document.querySelector('.feed-body-post').append(post_body);

            } else if (lista[i]['type'] == "4") {//compartilhamneto direto 
                let post_body = document.querySelector('.type_1 .post--menu--area').cloneNode(true);
                post_body.id = lista[i]['compartilhador_info']['id_da_compartilhada']+'pt-xD30';
                
                post_body.querySelector('.info-compartilhador').style.display = '';
                post_body.querySelector('.user_respost').setAttribute('href', `perfil_user_v.php?username=${lista[i]['compartilhador_info']['username_user']}`);
                post_body.querySelector('.user_respost').innerHTML = `${lista[i]['compartilhador_info']['nome_user']}(${lista[i]['compartilhador_info']['username_user']})`;
                post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['user_info']['img_user']);
                post_body.querySelector('.name--area a').setAttribute('href', `perfil_user_v.php?username=${lista[i]['user_info']['username_user']}`)
                post_body.querySelector('.name--name-perfil').innerHTML = lista[i]['user_info']['nome_user'];
                post_body.querySelector('.name--username-perfil').innerHTML = lista[i]['user_info']['username_user'];
                post_body.querySelector('.date--post').innerHTML = lista[i]['date_publi'];
                post_body.querySelector('.post_compartilhadas').innerHTML = lista[i]['beepadas'];
                if(lista[i]['text_post'] == '' || lista[i]['text_post'] == null) {
                    post_body.querySelector('.post--text').style.display = 'none';
                } else {
                    post_body.querySelector('.post--text').innerHTML = lista[i]['text_post'];
                }
                if(lista[i]['img_publi'] == ""){
                    
                }else {
                    post_body.querySelector('.post--img-area').style.display = '';
                    post_body.querySelector('.post--img').style.display = 'block';
                    post_body.querySelector('.post--img').style.backgroundImage = `url(../issets/imgs/posts/${lista[i]['img_publi']})`;
                }//p-xD30
                post_body.querySelector('.event--curtida input').value = lista[i]['compartilhador_info']['id_da_compartilhada'];
                if(lista[i]['user_curtiu']){
                    post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['compartilhador_info']['id_da_compartilhada']);
                    post_body.querySelector('.event--curtida').classList.add('p-xD29');
                    post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
                } else{
                    post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
                    post_body.querySelector('.event--curtida').classList.add('p-xD30');
                    post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['compartilhador_info']['id_da_compartilhada'])

                }
                if(lista[i]['user_compartilhou']) {
                    post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-on');
                    post_body.querySelector('.compartilhar-event').classList.add('descompartilhar');
                    post_body.querySelector('.compartilhar-event-div').classList.add('descompartilhar-event');
                    post_body.querySelector('.descompartilhar-event').id = lista[i]['compartilhador_info']['id_da_compartilhada']+'c-xD30';
                } else {
                    post_body.querySelector('.compartilhar-event').classList.add('img-compartilhar-off')
                    post_body.querySelector('.compartilhar-event-div').classList.add('compartilhar')
                    post_body.querySelector('.compartilhar').id = lista[i]['compartilhador_info']['id_da_compartilhada']+'c-xD30';
                }
                post_body.querySelector('.event--curtida').setAttribute('id', lista[i]['compartilhador_info']['id_da_compartilhada']);
                
                post_body.querySelector('.conteudo--all--post').href = 'postagem.php?postagem='+lista[i]['compartilhador_info']['id_da_compartilhada'];   
                document.querySelector('.feed-body-post').append(post_body);
            }
        }
        atual = parseInt(i) + 1;
        return;
    }
    function verficar_posts() {
        setInterval((e)=>{
            fetch('../issets/script/php/requsicoes/posts.php')
                .then(function (resultado){
                    return resultado.json()
                })
                .then(function (json) {
                    if(atual < json.length) {
                        quan_novos++;
                        atual++;
                        if(document.querySelector('html').scrollTop >= 200) {
                        scroll_ = true;
                        let alert;
                        let divAlert = document.createElement('div');
                        divAlert.setAttribute('class', 'alert--mensagem')
                        if(quan_novos > 1) {
                           alert = `você tem ${quan_novos} novos posts`;
                        } else if (quan_novos < 2)  {
                           alert = `você tem ${quan_novos} novo post`;
                        } if(quan_novos > 9) {
                            alert = `você tem muitos novos posts`;
                        }
                        divAlert.innerHTML = alert;
                        document.querySelector('.feed-body-post').appendChild(divAlert);
                        divAlert.addEventListener('click', (a)=>{ 
                            window.scrollTo({
                                top:0,
                                behavior:'smooth'
                            });
                            document.querySelector('.alert--mensagem').remove();
                            setTimeout(()=>{
                                load.style.display = '';
                                setTimeout(()=>{
                                    window.location.reload();
                                },100)
                            }, 1100)
                        }, true)
                    } else if (document.querySelector('html').scrollTop == 0 && scroll_) {
                        document.querySelector('.alert--mensagem').remove();
                        scroll_ = false;
                    }
                    } 
                    return json.length;
                })
        } ,1000);
        
    }
    function user_seguidores(list_user) {
        if(list_user.banner_pefil != null && list_user.banner_pefil != "") {
            document.querySelector('.banner--perfil').setAttribute('style', "background-image:url(../issets/imgs/profile/"+list_user.banner_pefil+");");
        } 
        document.querySelector('.fot_user_visit').setAttribute('style', list_user.img_user);
        document.querySelector('.info--perfil--user--nome').innerHTML = list_user.nome_user;
        qs('.info--perfil--user--username').innerHTML = list_user.username_user;
        qs('.bio').innerHTML = list_user.bio;
        qs('.nome--perfil').innerHTML = list_user.nome_user;
        qs('.data_nasc').innerHTML = list_user.data_nas;
        qs('.seguidores--info').href= qs('.seguidores--info').href+list_user.user_id;
        qs('.seguidor--info ').href= qs('.seguidor--info ').href+list_user.user_id;
        let button_segu = document.createElement('button');
        qs('.input_segui_id_x30').value = list_user.user_id;
        if(list_user.seguindo == true) {
            button_segu.setAttribute('class', 'button--seguindo button-remove curso-pointer');
            qs('.form_id_x30').setAttribute('action', '../issets/script/php/unseguir.php');
            qs('.form_id_x30').appendChild(button_segu);
        } else {
            button_segu.setAttribute('class', 'button--seguir button-remove curso-pointer');
            qs('.form_id_x30').setAttribute('action', '../issets/script/php/seguir.php');
            qs('.form_id_x30').appendChild(button_segu);
        }
    }
    function seguidores_user() {
        let segui = window.location.href.split('=');
        setInterval(()=>{
        fetch('../issets/script/php/requsicoes/posts_users.php?username='+segui[1])
            .then(function (resultado){
                return resultado.json()
            })
            .then(function (json){
                qs('.num_seguindo').innerHTML = json.t_seguindo;
                qs('.num_seguidores').innerHTML = json.t_seguidores;
            })
        },300)
    }

    async function user_session() {//adaptar para parece com os da timeline
        let user_session = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+username);
        let user_s = await user_session.json();
        qs('.back--event').remove();
        console.log(user_s)
        if(user_s.publi.nada == undefined) {
        criarPosts(user_s.publi)
        curtir_post();
        desCurtir();
        viwimg();
        show_CM();
        descompartilhar();
        qs('.event-direct').onclick = compartilhar;
        setInterval( ()=>{
            post_num_curtida();
        }, 500);
        post_num_compartilhamento();
        } else {
            post_not(false);
        }
    }

    function seguidores_session() {
        let url_perfil = window.location.href.split('=');
        let atual_pag = window.location.href.split('paginas/');
        setInterval(()=>{
            if(atual_pag[1] == 'perfil.php') {
                fetch('../issets/script/php/requsicoes/posts_users.php?username='+username)
                    .then(function (res){
                        return res.json()
                    })
                    .then(function (jso){
                        qs('.num_seguindo').innerHTML = jso.user.t_seguindo;
                        qs('.num_seguidores').innerHTML = jso.user.t_seguidores;
                    })
            } else {
                fetch('../issets/script/php/requsicoes/posts_users.php?username='+url_perfil[1])
                    .then(function (res){
                        return res.json()
                    })
                    .then(function (jso){
                        qs('.num_seguindo').innerHTML = jso.user.t_seguindo;
                        qs('.num_seguidores').innerHTML = jso.user.t_seguidores;
                    })
            }
            
        },300)
    }
    function desCurtir(a) {
        qsAll('.p-xD29').forEach( (e)=>{
            let desCurtida = new FormData(e);
            e.onclick =  async function(a) {
                a.preventDefault();
                let moio_ = await fetch('../issets/script/php/interacoes_post/descurtir.php', {
                    method: 'POST',
                    body: desCurtida,
                })
                let res_ = await moio_.json();
                let num_curtidas = e.querySelector('.area_num').innerHTML;
                let convet = parseInt(num_curtidas)-1;
                e.querySelector('.area_num').innerHTML = convet;
                e.querySelector('button').classList.add('img--iteracao-curtida');
                e.querySelector('button').classList.add('img--iteracao-curtida-off');
                e.querySelector('button').classList.add('img--iteracao-curtida-off')
                e.querySelector('button').classList.add('img--curtida--off');
                e.querySelector('button').classList.add('p-evt-box');
                e.querySelector('button').classList.remove('img--iteracao-curtida-on');
                e.querySelector('button').classList.remove('img--iteracao-curtida-on')
                e.querySelector('button').classList.remove('img--curtida--on');
                e.classList.add('p-xD30');
                e.classList.remove('p-xD29');
                curtir_post();
                setTimeout(()=>{
                    e.querySelector('button').classList.remove('p-evt-box');
                },0260)

            }
        })
    }

    async function postsCurtidos_session() {//mesma coisa da session
        let url_push = window.location.href;
        let value_url = url_push.split('=');
        let curtida_req;
        if(value_url.length == 2){
            curtida_req = await fetch(`../issets/script/php/requsicoes/curtidas_posts.php?username=${value_url[1]}`);
        } else {
            curtida_req = await fetch(`../issets/script/php/requsicoes/curtidas_posts.php?username=`+username )
        }
        let jso_c = await curtida_req.json();
        jso_c.reverse(); 
        qsAll('.back--event').forEach((e)=>{e.remove()});
        if(jso_c.publi.nada == undefined) {
        criarPosts(jso_c);
        curtir_post();
        desCurtir();
        viwimg();
     } else {
        post_not(false);
     }
    }
    let openIMG = false;
    function viwimg() {
        qsAll('.post--img').forEach(e => {
            e.addEventListener('click', ()=>{
                let div00= document.createElement('div');
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
                let rem01 = rem00.replace('")','');
                let img = document.createElement('img');
                img.setAttribute('src',rem01);
                div02.appendChild(img);
                qs('html').style.overflow = 'hidden';
                document.body.insertBefore(div00,qs('script'));
                setTimeout(()=>{
                    qs('.img--modal').style.opacity = '1';
                }, 50)
                function exit_img() {
                    qs('.img--modal').style.opacity = '0';
                    setTimeout(()=>{
                        qs('.img--modal').remove();
                    }, 50)
                    qs('html').style.overflow = '';
                    return true;
                }
                event_exit.addEventListener('click', exit_img,true);
                div03.addEventListener('click', exit_img,true);
            });
        });
        }
        async function post_num_curtida() {
            let url_perfil = window.location.href.split('=');
            let url_push_v = window.location.href.split('paginas/');
            let req_;
            let json_
            if(url_push_v[1] == 'inicial.php') {    
                 req_ = await fetch('../issets/script/php/requsicoes/posts.php');
                 json_ = await req_.json();
                 for(let s in json_) {
                    let calc = parseInt(s) + parseInt(quan_novos);
                    if(json_[s]['type'] == "3"){
                        let curtidaArea = document.getElementById(json_[s]['id_publi']);
                        if(curtidaArea != undefined) {
                            curtidaArea.querySelector('.post_curtidas').innerHTML = json_[s]['num_curtidas'];
                        if(json_[s]['user_curtiu']) {
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
                        let curtidaArea = document.getElementById(json_[s]['compartilhador_info']['id_da_compartilhada']);
                        if(curtidaArea != undefined) {
                        curtidaArea.querySelector('.post_curtidas').innerHTML = json_[s]['num_curtidas'];
                        if(json_[s]['user_curtiu']) {
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
                if(url_push_v[1] == 'perfil.php') {
                    req_ = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+username);
                    json_ = await req_.json(); 
                    if(json_.publi.nada == undefined){
                    for(let s in json_.publi) {
                        let calc = parseInt(s) + parseInt(quan_novos);
                        if(json_.publi[s]['type'] == "3"){
                            let curtidaArea = document.getElementById(json_.publi[s]['id_publi']);
                            if(curtidaArea != undefined) {
                                curtidaArea.querySelector('.post_curtidas').innerHTML = json_.publi[s]['num_curtidas'];
                            if(json_.publi[s]['user_curtiu']) {
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
                            if(curtidaArea != undefined) {
                            curtidaArea.querySelector('.post_curtidas').innerHTML =json_.publi[s]['num_curtidas'];
                            if(json_.publi[s]['user_curtiu']) {
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
                    req_ = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+url_perfil[1]);
                    json_ = await req_.json(); 
                    if(json_.publi.nada == undefined) {
                        for(let s in json_.publi) {
                            let calc = parseInt(s) + parseInt(quan_novos);
                            if(json_.publi[s]['type'] == "3"){
                                let curtidaArea = document.getElementById(json_.publi[s]['id_publi']);
                                if(curtidaArea != undefined) {
                                    curtidaArea.querySelector('.post_curtidas').innerHTML = json_.publi[s]['num_curtidas'];
                                if(json_.publi[s]['user_curtiu']) {
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
                                if(curtidaArea != undefined) {
                                curtidaArea.querySelector('.post_curtidas').innerHTML =json_.publi[s]['num_curtidas'];
                                if(json_.publi[s]['user_curtiu']) {
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
    
    let compartilhar = await fetch('../issets/script/php/interacoes_post/compartilhar.php', {
        method: 'POST',
        body: newF
    })
    let res = await compartilhar.json();
    let modal = qs('.modal--shared');
    modal.style.opacity = 0;
        setTimeout(()=>{
            modal.style = '';
           qs('.modal-area').style.display = 'none';
           modal.style.display = 'none';
        })
    console.log(res);
 }
function descompartilhar() {
    qsAll('.descompartilhar-event').forEach((e)=>{
        e.onclick = async () => {
            let form_ = document.createElement('form');
            let input_a = document.createElement('input');
            input_a.setAttribute('name', 'c-pXD30');
            let id_button = e.id.replace('c-xD30', '');
            input_a.setAttribute('value', id_button);
            form_.appendChild(input_a);
            let value_pomisse = new FormData(form_);
            let promisse = await fetch('../issets/script/php/interacoes_post/descompartilhar.php', {
                method: 'POST',
                body: value_pomisse
            });
            let resposta = await promisse.json();
            console.log(resposta);
            document.getElementById(resposta.id_descompartilhada+'pt-xD30').remove();

        }
})
}
function post_num_compartilhamento() {
    setInterval( async ()=>{
    let url_perfil = window.location.href.split('=');
    let url_push_v = window.location.href.split('paginas/');
        
    if(url_push_v[1] == 'inicial.php') {    
        let prom = await fetch('../issets/script/php/requsicoes/posts.php');
        let res_pom = await prom.json();
         for(let l in res_pom) {

            if(res_pom[l]['type'] == 3){
                let repostArea = document.getElementById(res_pom[l]['id_publi']+'c-xD30');
                repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom[l]['beepadas'];
                if(res_pom[l]['user_compartilhou']) {
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
                }
            } else {
                let repostArea = document.getElementById(res_pom[l]['compartilhador_info']['id_da_compartilhada']+'c-xD30');
                if(repostArea != undefined) {
                repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom[l]['beepadas'];
                if(res_pom[l]['user_compartilhou']) {
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

                }
            }
            }
        }
    } else {
        if(url_push_v[1] == 'perfil.php') {
            req_ = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+username);
            res_pom = await req_.json(); 
            if(res_pom.publi.nada == undefined) {
            for(let l in res_pom.publi) {
                if(res_pom.publi[l]["type"] == "3"){
                    let repostArea = document.getElementById(res_pom.publi[l]['id_publi']+'c-xD30');
                    repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom.publi[l]['beepadas'];
                    if(res_pom.publi[l]['user_compartilhou']) {
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
                    }
                } else {
                    let repostArea = document.getElementById(res_pom.publi[l]['compartilhador_info']['id_da_compartilhada']+'c-xD30');
                    if(repostArea != undefined) {
                    repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom.publi[l]['beepadas'];
                    if(res_pom.publi[l]['user_compartilhou']) {
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
    
                    }
                }
                }
            }
         }
        } else {
            req_ = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+url_perfil[1]);
            res_pom = await req_.json(); 
            if(res_pom.publi.nada == undefined) {
                for(let l in res_pom.publi) {
                    if(res_pom.publi[l]["type"] == "3"){
                        let repostArea = document.getElementById(res_pom.publi[l]['id_publi']+'c-xD30');
                        repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom.publi[l]['beepadas'];
                        if(res_pom.publi[l]['user_compartilhou']) {
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
                        }
                    } else {
                        let repostArea = document.getElementById(res_pom.publi[l]['compartilhador_info']['id_da_compartilhada']+'c-xD30');
                        if(repostArea != undefined) {
                        repostArea.querySelector('.post_compartilhadas').innerHTML = res_pom.publi[l]['beepadas'];
                        if(res_pom.publi[l]['user_compartilhou']) {
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
        
                        }
                    }
                    }
                }
            } else {
                
            }
        }
    }
    }, 500);
 }
 function post_not(timeline) {
    let nada = document.createElement('div');
    nada.classList.add('nada');
    if(timeline) {
        nada.innerHTML = 'Por enquanto não há nada por aqui. :(';
    } if(timeline == 'coment') {
        nada.innerHTML = 'Seja o primeiro a interagir com esse usuário!';
    } if(timeline == false) {
        nada.innerHTML = 'Esse usuário não fez nenhuma publicação. :(';
    }
    document.querySelector('.feed-body-post').appendChild(nada);
 }

async function post_all() {
    let postagem_all = window.location.href;
    let info = postagem_all.split('=');
    if(info[1] == undefined || info[1] == ''){
        window.location.href = 'inicial.php';
    } else {
        let form_aux = document.createElement('form');
        form_aux.setAttribute('method', 'POST');
        let input_aux = document.createElement('input');
        input_aux.setAttribute('name', 'All_xD30');
        input_aux.setAttribute('value', info[1]);
        form_aux.appendChild(input_aux);
        let info_aux = new FormData(form_aux);
        let post_completo = await fetch('../issets/script/php/requsicoes/post_completo.php', {
            method: 'POST',
            body: info_aux
        });
        let res_aux = await post_completo.json();
        post_all_creat(res_aux);
        curtir_post();
        desCurtir();
        console.log(res_aux);
    }
 }
 function post_all_creat(obj) {
    let area_post_completo = qs('.post-completo-area');
    area_post_completo.querySelector('.menu--pag--img--area').setAttribute('style', obj.publicacao.user_info.img_user);
    area_post_completo.querySelector('.perfil-link').setAttribute('href', 'perfil_user_v.php?username='+ obj.publicacao.user_info.username_user);
    area_post_completo.querySelector('.name--name-perfil').innerHTML = obj.publicacao.user_info.nome_user;
    area_post_completo.querySelector('.name--username-perfil').innerHTML = obj.publicacao.user_info.username_user;
    if(obj.text_post != '' || obj.text_post != null) {
        area_post_completo.querySelector('.post--text').innerHTML = obj.publicacao.text_post;
    }
    let area_img = qs('.p-30d_10');
    if(obj.publicacao.img_publi == '' || obj.publicacao.img_publi == null) {
        area_img.remove()
    } else {
        area_img.querySelector('.event').remove();
        area_img.querySelector('img').setAttribute('src', '../issets/imgs/posts/'+obj.publicacao.img_publi);
        area_img.querySelector('img').style.display = '';
    }
    area_post_completo.querySelector('.num--curtidas').innerHTML = obj.publicacao.num_curtidas;
    area_post_completo.querySelector('.num--coment').innerHTML = obj.publicacao.num_comentario;
    area_post_completo.querySelector('.num--compartilha').innerHTML = obj.publicacao.beepadas;
    if(obj.publicacao.game == undefined || obj.publicacao.game == "" || obj.publicacao.game == null) {
        area_post_completo.querySelector('.game').remove();
    } else {
        area_post_completo.querySelector('.game').innerHTML =  obj.publicacao.game;
    }
    area_post_completo.querySelector('.date--complete').innerHTML = `${obj.publicacao.date_publi_ca} as ${obj.publicacao.date_publi_hr}`;
    area_post_completo.querySelector('.date--post').innerHTML = obj.publicacao.date_publi;
    area_post_completo.querySelector('.event--curtida').id = obj.publicacao.id_publi;
    area_post_completo.querySelector('.event--curtida input').value = obj.publicacao.id_publi;
    if(obj.publicacao.user_curtiu){
        area_post_completo.querySelector('.event--curtida').setAttribute('data-key', obj.publicacao.id_publi);
        area_post_completo.querySelector('.event--curtida').classList.add('p-xD29');
        area_post_completo.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
    } else{
        area_post_completo.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
        area_post_completo.querySelector('.event--curtida').classList.add('p-xD30');
        area_post_completo.querySelector('.event--curtida').setAttribute('data-key', obj.publicacao.id_publi);
    } 
    if(obj.comentarios != undefined) {
        for(let bobSponja in obj.comentarios) {
            let areaPalhacada = qs('.coment--area').cloneNode(true);
            areaPalhacada.style ='';
            areaPalhacada.querySelector('.post--area--perfil-coment .menu--pag--img--area').setAttribute('style', obj.comentarios[bobSponja].user_info.img_user);
            let load = areaPalhacada.querySelector('.post--area--perfil-coment .menu--pag--img--area').querySelector('.back--event');
            if(load != undefined) {
             load.remove()
            }
            areaPalhacada.querySelector('.perfil-link').setAttribute('href', `perfil_user_v.php?username=${obj.comentarios[bobSponja].user_info.username_user}`);
            areaPalhacada.querySelector('.name--perfil--coment').innerHTML = obj.comentarios[bobSponja].user_info.nome_user;
            areaPalhacada.querySelector('.username--perfil--coment').innerHTML = `(${obj.comentarios[bobSponja].user_info.username_user})`;
            console.log(obj.comentarios[bobSponja]);
            console.log(areaPalhacada)
            console.log(qs('.post-comentario--area'))
            qs('.post-comentario--area').append(areaPalhacada);    
            
        }
        qs('.coment--area').remove();
        
    } else {
        post_not('coment');
        qs('.post-comentario--area .coment--area').remove();
    }
}
 