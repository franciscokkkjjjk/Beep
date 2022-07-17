let post_d;
let div = document.createElement('div');
async function posts() {
    let posts = await fetch('../issets/script/php/requsicoes/posts.php',
        div.setAttribute('class', 'event'),
        document.querySelector('.feed-body-post').append(div),
    );
    post_d =  await posts.json()
    console.log(post_d);
    div.remove(div);
     post_d.map((item, index)=>{
        let post_body = document.querySelector('.post--menu--area').cloneNode(true);
        post_body.querySelector('.menu--pag--img--area').setAttribute('style', item.img_user);
        post_body.querySelector('.name--area a').setAttribute('href', `perfil_user_v.php?username=${item.username_user}`)
        post_body.querySelector('.name--name-perfil').innerHTML = item.nome_user;
        post_body.querySelector('.name--username-perfil').innerHTML = item.username_user;
        post_body.querySelector('.date--post').innerHTML = item.date_publi;
        post_body.querySelector('.post--text').innerHTML = item.text_post;
        if(item.img_publi == ""){}else {
            post_body.querySelector('.post--img').style.display = '';
            post_body.querySelector('.post--img').style.backgroundImage = `url(../issets/imgs/posts/${item.img_publi})`;
        }
        post_body.querySelector('.p-xD30').setAttribute('data-key', item.id_publi)
        post_body.querySelector('.p-xD30 input').value = item.id_publi;
        document.querySelector('.feed-body-post').append(post_body);
        console.log(post_body);
    })
    }
    posts();
