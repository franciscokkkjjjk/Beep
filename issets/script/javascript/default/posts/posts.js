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
    desCurtir();
    viwimg();
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
        console.log(user_v);
        qsAll('.event').forEach((e)=>{e.remove()});
        qsAll('.back--event').forEach((e)=>{e.remove()});
        user_seguidores(user_v);
        user_creat(user_v.publicacoes, user_v);
        curtir_post();
        desCurtir();
        seguidores_user();
        viwimg();
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
            if(lista[i]['img_publi'] == ""){
                
            }else {
                post_body.querySelector('.post--img-area').style.display = '';
                post_body.querySelector('.post--img').style.display = 'block';
                post_body.querySelector('.post--img').style.backgroundImage = `url(../issets/imgs/posts/${lista[i]['img_publi']})`;
            }//p-xD30
            post_body.querySelector('.event--curtida input').value = lista[i]['id_publi'];
            if(lista[i]['user_curtiu']){
                post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['id_publi']);
                post_body.querySelector('.event--curtida').classList.add('p-xD29');
                post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
            } else{
                post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
                post_body.querySelector('.event--curtida').classList.add('p-xD30');
                post_body.querySelector('.event--curtida').setAttribute('data-key', lista[i]['id_publi'])

            }
            post_body.querySelector('.post_curtidas').setAttribute('id', lista[i]['id_publi']);
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
            if(json_list[i]['img_publi'] == ""){
                
            }else {
                post_body.querySelector('.post--img-area').style.display = '';
                post_body.querySelector('.post--img').style.display = 'block';
                post_body.querySelector('.post--img').style.backgroundImage = `url(../issets/imgs/posts/${json_list[i]['img_publi']})`;
            }
            post_body.querySelector('.event--curtida input').value = json_list[i]['id_publi'];
            if(json_list[i]['user_curtiu']){
                post_body.querySelector('.event--curtida').setAttribute('data-key', json_list[i]['id_publi']);
                post_body.querySelector('.event--curtida').classList.add('p-xD29');
                post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao p-evt-box-off img--iteracao-curtida-on img--curtida--on');
            } else{
                post_body.querySelector('.curtir').setAttribute('class', 'curtir interacao--area button--remove img--iteracao img--iteracao-curtida p-evt-box-off')
                post_body.querySelector('.event--curtida').classList.add('p-xD30');
                post_body.querySelector('.event--curtida').setAttribute('data-key', json_list[i]['id_publi'])
            }
            post_body.querySelector('.post_curtidas').setAttribute('id', json_list[i]['id_publi']);
            qs('.feed-body-post').append(post_body);
        }
        console.log(json_list);
    }
    function user_seguidores(list_user) {
        document.querySelector('.banner--perfil').setAttribute('style', list_user.banner_pefil);
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

    async function user_session() {
        let user_session = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+username);
        let user_s = await user_session.json();
        qs('.back--event').remove();
        user_creat(user_s.publicacoes, user_s);
        curtir_post();
        desCurtir();
        seguidores_session();
        viwimg();
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

    async function postsCurtidos_session() {
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
        console.log(jso_c);
        criarPosts(jso_c);
        curtir_post();
        desCurtir();
        viwimg();
    }

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
                
                qs('.exit_event').addEventListener('click',exit_img,true);
                qs('.menu--exit-img-area').addEventListener('click',exit_img,true);
            });
        });
        }
         function post_num_curtida() {
            setInterval(async ()=>{
            let url_perfil = window.location.href.split('=');
            let url_push_v = window.location.href.split('paginas/');
            let req_;
            let json_
            if(url_push_v[1] == 'inicial.php') {    
                 req_ = await fetch('../issets/script/php/requsicoes/posts.php');
                 json_ = await req_.json(); 
                 for(let s in json_) {
                    document.getElementById(json_[s]['id_publi']).innerHTML = json_[s]['num_curtidas'];
                }
            } else {
                if(url_push_v[1] == 'perfil.php') {
                    req_ = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+username);
                    json_ = await req_.json(); 
                    for(let s in json_.publicacoes) {
                        document.getElementById(json_[s]['id_publi']).innerHTML = json_[s]['num_curtidas'];
                    }
                } else {
                    req_ = await fetch('../issets/script/php/requsicoes/posts_users.php?username='+url_perfil[1]);
                    json_ = await req_.json(); 
                    for(let s in json_.publicacoes) {
                        document.getElementById(json_[s]['id_publi']).innerHTML = json_[s]['num_curtidas'];
                    }
                }
            }
            
            
            }, 500);
         }
                   // document.getElementById(c_jso[s]['id_publi']).innerHTML = c_jso[s]['num_curtidas'];

