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
                qs('html').style.overflow = 'hidden';
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
                showImg_form(qs('.input_coment_event_img'), qs('.img--coment'), false);
                function valid_div(cond) {
                    if(cond == 1) {
                    let img_value = qs('.input_coment_event_img').value;
                    let value_inpud = document.getElementById('inputdiv');
                    let avalue_inpud = null;
                    if(value_inpud != undefined ){
                        avalue_inpud = value_inpud.innerText.trim(); 
                    }   
                    if((avalue_inpud == '' || avalue_inpud == null) && (img_value == ''|| img_value == null)) {
                        return false;
                    } else {
                        return true;
                    }                           
                } else if(cond == 0) {
                    let value_inpud = document.getElementById('inputdiv');
                    let avalue_inpud = null;
                    if(value_inpud != undefined ){
                        avalue_inpud = value_inpud.innerText.trim(); 
                    }   
                    if(avalue_inpud == '' || avalue_inpud == null) {
                        return true;
                    } else {
                        return false;
                    }  
                }
                }
                if(json_c.user_info.username_user == username) {
                    qs('.resposat').innerHTML = 'voce mesmo';
                    qs('.resposat').setAttribute('href','perfil_user_v.php?username='+json_c.user_info.username_user);
                } else {
                    qs('.resposat').innerHTML = json_c.user_info.username_user;
                    qs('.resposat').setAttribute('href','perfil_user_v.php?username='+json_c.user_info.username_user);
                }
                qs('.button--postar-coment').addEventListener('click', ()=>{
                    if(valid_div(1)) {
                        window.location.href = '../assets/script/php/interacoes_post/comentar.php?id_publi'+json_c.id_publi;
                    }
                },true);
                qs('.area--inputdiv').addEventListener('click',(e)=>{
                        qs('.area--inputdiv').style.display = 'none';
                        let creat_div = document.createElement('div');
                        creat_div.id = 'inputdiv';
                        creat_div.contentEditable = 'true';
                        creat_div.classList.add('inputdiv--form--post-coment');
                        qs('.area-input-div').appendChild(creat_div);
                        qs('.inputdiv--form--post-coment').focus(); 
                        qs('.inputdiv--form--post-coment').addEventListener('blur',()=>{  
                            if(valid_div(0)) {
                                qs('.inputdiv--form--post-coment').remove()
                                qs('.area--inputdiv').style.display = 'block'
                            }
                        },true)      
                })
         }, true);
        });
    }
}
