/*
     <div id="inputdiv"  contenteditable="true" class="inputdiv--form--post"></div>
*/
let modal = qs('.modal-coment-coment');
let clone = modal.cloneNode(true);
function coment(button_) {
    let creat_div = document.createElement('div');
    if (modal != undefined) {
        modal.remove();
    }
    button_.onclick = async (element) => {
        element.preventDefault();
        creat_div.id = 'inputdiv';
        creat_div.contentEditable = 'true';
        creat_div.classList.add('inputdiv--form--post-coment');
        qs('html').style.overflow = 'hidden';
        clone.style.display = '';
        setTimeout(() => {
            clone.style.opacity = '';
        }, 15)
        qs('.feed-area').append(clone);
        let id = button_.id.replace('p_xD30_C', '');
        let info_requi = new FormData();
        info_requi.append('p-xD30', id);
        let info = await fetch('../assets/script/php/requsicoes/comenta.php', {
            method: 'POST',
            body: info_requi
        })
        let json_c = await info.json()
        console.log(json_c);
        showImg_form(qs('.input_coment_event_img'), qs('.img--coment'), false);
        function valid_div(cond) {
            if (cond == 1) {
                let img_value = qs('.input_coment_event_img').value;
                let value_inpud = document.getElementById('inputdiv');
                let avalue_inpud = null;
                if (value_inpud != undefined) {
                    avalue_inpud = value_inpud.innerText.trim();
                }
                if ((avalue_inpud == '' || avalue_inpud == null) && (img_value == '' || img_value == null)) {
                    return false;
                } else {
                    return true;
                }
            } else if (cond == 0) {
                let value_inpud = document.getElementById('inputdiv');
                let avalue_inpud = null;
                if (value_inpud != undefined) {
                    avalue_inpud = value_inpud.innerText.trim();
                }
                if (avalue_inpud == '' || avalue_inpud == null) {
                    return true;
                } else {
                    return false;
                }
            }
        }
        if (json_c.user_info.username_user == username) {
            qs('.resposat').innerHTML = 'você mesmo';
            qs('.resposat').setAttribute('href', 'perfil_user_v.php?username=' + json_c.user_info.username_user);
        } else {
            qs('.resposat').innerHTML = json_c.user_info.username_user;
            qs('.resposat').setAttribute('href', 'perfil_user_v.php?username=' + json_c.user_info.username_user);
        }
        qs('.button--postar-coment').onclick =  async (elementB) => {
            if (valid_div(1)) {
                let form_info_coment = document.createElement('form');
                let input_info_coment = document.querySelector('.input_div_info').cloneNode(true);
                let img_value_c = qs('.input_coment_event_img').cloneNode(true);
                let value_inpud_c = document.getElementById('inputdiv');
                let avalue_inpud_c = null;
                if (value_inpud_c != undefined) {
                    avalue_inpud_c = value_inpud_c.innerText;
                }
                input_info_coment.value = avalue_inpud_c;
                form_info_coment.appendChild(img_value_c);
                form_info_coment.appendChild(input_info_coment);
                console.log(input_info_coment.value);
                let body_req = new FormData(form_info_coment);
                body_req.append('p-xD30', id);
                console.log(form_info_coment);
                qs('.button-exit').click();
                let req_coment = await fetch('../assets/script/php/interacoes_post/comentar_post.php', {
                    method: 'POST',
                    body: body_req,
                });
                let apend_req = await req_coment.json();
                alert_mensage(apend_req);

            } else {
                qs('.area--inputdiv').click();
            }
        }
        qs('.area--inputdiv').onclick =  (e) => {
            e.preventDefault();
            qs('.area--inputdiv').style.display = 'none';
            if (qs('.inputdiv--form--post-coment') == undefined) {
                qs('.area-input-div').appendChild(creat_div);
            }
            qs('.inputdiv--form--post-coment').focus();
            qs('.inputdiv--form--post-coment').onblur =  () => {
                if (valid_div(0)) {
                    if (qs('.inputdiv--form--post-coment') != undefined) {
                        qs('.inputdiv--form--post-coment').remove();
                    }
                    qs('.area--inputdiv').style.display = 'block'
                }
            }
        }
        function close_modal() {
            qs('.modal-coment').style.opacity = '0';
            setTimeout(() => {
                if (qs('.modal-coment') != undefined) {
                    if (qs('.inputdiv--form--post-coment') != undefined) {
                        qs('.inputdiv--form--post-coment').innerText = '';
                        qs('.input_div_info').value = '';
                    }
                    qs('.input_coment_event_img').value = '';
                    qs('.img--coment').innerHTML = '';
                    qs('.modal-coment').remove();
                }
            }, 80)
            qs('html').removeAttribute('style');
        }
        qs('.button-exit').onclick = close_modal;
        setTimeout(() => {
            qs('.modal-event-coment').onclick = close_modal;
        }, 45)
    };
}
