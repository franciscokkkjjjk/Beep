/*
     <div id="inputdiv"  contenteditable="true" class="inputdiv--form--post"></div>
*/ 
let modal = qs('.modal-coment');
let clone = modal.cloneNode(true);
function coment() {
    modal.remove();
    let comentar = qsAll('.comentar');
    if(comentar.length > 0) {
        console.log('ola')
        comentar.forEach((e) => {
            e.addEventListener('click', async (element)=>{
                clone.style.display = '';
                qs('.feed-area').append(clone);
                let id = e.id.replace('p_xD30_C','');
                let post = document.createElement('form');
                let input = document.createElement('input');
                post.setAttribute('method','post');
                input.setAttribute('value',id);
                input.setAttribute('name','p-xD30');
                post.appendChild(input);
                let info_requi = new FormData(post);
                let info = await fetch('../assets/script/php/requsicoes/comenta.php', {
                    method:'POST',
                    body:info_requi
                })
                let json_c = await info.json()
                console.log(json_c);
                if(json_c.user_info.username_user == username) {
                    qs('.resposat').innerHTML = 'voce mesmo';
                    qs('.resposat').setAttribute('href','perfil_user_v.php?username='+json_c.user_info.username_user);
                } else {
                    qs('.resposat').innerHTML = json_c.user_info.username_user;
                    qs('.resposat').setAttribute('href','perfil_user_v.php?username='+json_c.user_info.username_user);
                }
                qs('.button--postar-coment').addEventListener('click', ()=>{
                    window.location.href = '../assets/script/php/interacoes_post/comentar.php?id_publi'+json_c.id_publi;
                },true);
         }, true);
        });
    }
}
