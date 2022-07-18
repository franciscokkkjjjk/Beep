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
    criarPosts(post_d);
    curtir_post();
    }
    function curtir_post() {
        qsAll('.p-xD30').forEach( (e)=>{
            let teste = new FormData(e);
            e.addEventListener('click', async (a)=>{
                a.preventDefault();
                let req = await fetch('../issets/script/php/interacoes_post/curtir.php', {
                    method: 'POST',
                    body: teste,
                })
                res = await req.json();
                e.querySelector('button').classList.remove('img--iteracao-curtida');
                e.querySelector('button').classList.add('img--iteracao-curtida-on');
                e.querySelector('button').classList.add('img--iteracao-curtida-on')
                e.querySelector('button').classList.add('img--curtida--on');
                e.querySelector('button').classList.add('p-evt-box');
                setTimeout(()=>{
                    e.querySelector('button').classList.remove('p-evt-box');
                },0260)

            })
        })
    }
    async function user_() {
        let username_vist = window.location.href.split('=');
        let user_vist = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+username_vist[1]);
        let user_v = await user_vist.json();
        qs('.back--event').remove();
        qsAll('.event').forEach((e)=>{e.remove()});
        user_seguidores(user_v);
        user_creat(user_v.publicacoes, user_v);
        curtir_post();
        seguidores_user()
    }

    function criarPosts(lista) {
        for(var i in lista) {
            let post_body = document.querySelector('.post--menu--area').cloneNode(true);
            post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['img_user']);
            post_body.querySelector('.name--area a').setAttribute('href', `perfil_user_v.php?username=${lista[i]['username_user']}`)
            post_body.querySelector('.name--name-perfil').innerHTML = lista[i]['nome_user'];
            post_body.querySelector('.name--username-perfil').innerHTML = lista[i]['username_user'];
            post_body.querySelector('.date--post').innerHTML = lista[i]['date_publi'];
            post_body.querySelector('.post--text').innerHTML = lista[i]['text_post'];
            if(lista[i]['img_publi'] == ""){}else {
                post_body.querySelector('.post--img').style.display = '';
                post_body.querySelector('.post--img').style.backgroundImage = `url(../issets/imgs/posts/${lista[i]['img_publi']})`;
            }
            post_body.querySelector('.p-xD30').setAttribute('data-key', lista[i]['id_publi'])
            post_body.querySelector('.p-xD30 input').value = lista[i]['id_publi'];
            document.querySelector('.feed-body-post').append(post_body);
           
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
    function user_creat(json_list, json_list_user) {
        for(let i in json_list) {
            let post_body = document.querySelector('.post--menu--area').cloneNode(true);
            post_body.querySelector('.menu--pag--img--area').setAttribute('style', json_list_user.img_user);
            post_body.querySelector('.name--area a').setAttribute('href', `perfil_user_v.php?username=${json_list_user.username_user}`)
            post_body.querySelector('.name--name-perfil').innerHTML = json_list_user.nome_user;
            post_body.querySelector('.name--username-perfil').innerHTML = json_list_user.username_user;
            post_body.querySelector('.date--post').innerHTML = json_list[i]['date_publi'];
            post_body.querySelector('.post--text').innerHTML = json_list[i]['text_post'];
            if(json_list[i]['img_publi'] == ""){}else {
                post_body.querySelector('.post--img').style.display = '';
                post_body.querySelector('.post--img').style.backgroundImage = `url(../issets/imgs/posts/${json_list[i]['img_publi']})`;
            }
            post_body.querySelector('.p-xD30').setAttribute('data-key', json_list[i]['id_publi'])
            post_body.querySelector('.p-xD30 input').value = json_list[i]['id_publi'];
            document.querySelector('.feed-body-post').append(post_body);
        }
    }
    function user_seguidores(list_user) {
        document.querySelector('.banner--perfil').setAttribute('style', list_user.banner_pefil);
        document.querySelector('.fot_user_visit').setAttribute('style', list_user.img_user);
        document.querySelector('.info--perfil--user--nome').innerHTML = list_user.nome_user;
        qs('.info--perfil--user--username').innerHTML = list_user.username_user;
        qs('.bio').innerHTML = list_user.bio;
        qs('.nome--perfil').innerHTML = list_user.nome_user;
        qs('.data_nasc').innerHTML = list_user.data_nas;
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

    async function user_session() {
        let user_session = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+username);
        let user_s = await user_session.json();
        qs('.back--event').remove();
        qsAll('.event').forEach((e)=>{e.remove()});
        user_creat(user_s.publicacoes, user_s);
        curtir_post();
        seguidores_session()
    }

    function seguidores_session() {
        setInterval(()=>{
        fetch('../issets/script/php/requsicoes/posts_users.php?username='+username)
            .then(function (res){
                return res.json()
            })
            .then(function (jso){
                qs('.num_seguindo').innerHTML = jso.t_seguindo;
                qs('.num_seguidores').innerHTML = jso.t_seguidores;
            })
        },300)
    }
