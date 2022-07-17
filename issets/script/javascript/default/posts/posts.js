let post_d;
let scroll_ = false;
var atual;
let quan_novos = 0;
let button = document.createElement('button');
let div = document.querySelector('.event');
async function posts() {
    let posts = await fetch('../issets/script/php/requsicoes/posts.php',
    );
    post_d =  await posts.json();
    console.log(post_d);
    div.style.display = 'none';
    criarPosts(post_d);
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
            console.log();
        })
    })
    }
    function criarPosts(lista) {
        for(var i in lista) {
            let post_body = document.querySelector('.post--menu--area').cloneNode(true);
            post_body.querySelector('.menu--pag--img--area').setAttribute('style', lista[i]['img_user']);
            post_body.querySelector('.name--area a').setAttribute('href', `perfil_user_v.php?username=${post_d[i]['username_user']}`)
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
    posts();
    console.log(atual);
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
                        console.log(quan_novos);
                        if(document.querySelector('html').scrollTop >= 200) {
                        scroll_ = true;
                        let alert;
                        let divAlert = document.createElement('div');
                        divAlert.setAttribute('class', 'alert--mensagem')
                        if(quan_novos > 1) {
                           alert = `você tem ${quan_novos} novos posts`;
                        } else {
                           alert = `você tem ${quan_novos} novo post`;
                        }
                        divAlert.innerHTML = alert;
                        document.querySelector('.feed-body-post').appendChild(divAlert);
                    } else if (document.querySelector('html').scrollTop == 0 && scroll_) {
                        divAlert.remove();
                    }
                    } else if (document.querySelector('html').scrollTop == 0 && scroll_) {
                        document.querySelector('.alert--mensagem').remove();
                    } console.log(scroll_);
                    return json.length;
                })
        } ,1000);
        
    }
    verficar_posts();