let modal_ = document.querySelector('.modal_confirm');
modal_ = modal_.cloneNode(true);
if (window.localStorage.length > 4) {
    window.localStorage.clear();
}
async function so_game() {
    let req = await fetch('../assets/script/php/requisicoes/game_solic.php');
    let res = await req.json();
    let e = 1;
    console.log(res);
    for (var i in res) {
        let aux = false;
        if (e % 2 == 0) {
            aux = true;
        }
        creat_list(res[i], 'games', null,aux);
        e++;
    }
    document.querySelector('.list_area').style.display = 'none';
    console.log(e);
}
// creat_list(lista de coisas, diretorio da imagem, url da requisicao, define dois tipos de cores);
function creat_list(list, img_dir, num_aux = null, aux) {
    let list_clone = document.querySelector('.list_area').cloneNode(true);
    if (aux) {
        list_clone.style.backgroundColor = '#292929';
    } else {
        list_clone.style.backgroundColor = '';
    }
    list_clone.querySelectorAll('.event').forEach((e) => {
        e.remove();
    });
    if (img_dir != null) {
        list_clone.querySelector('.list_img').style.backgroundImage = `url(../../assets/imgs/${img_dir}/${list.img})`
    }
    if(num_aux != null) {
        list_clone.querySelector('.num_list').innerHTML = list.num;
    } else {
        list_clone.querySelector('.num_list').innerHTML = "";
    }
    list_clone.querySelector('.list_title').innerHTML = list.title;
    list_clone.querySelector('.button_c').onclick = async (e) => {
        e.preventDefault();
        window.sessionStorage.setItem('x5edS', list.id);
        if (window.sessionStorage.x5edP != undefined) {
            window.sessionStorage.removeItem('x5edP');
        }
        window.location.href = 'visualizar_G.php';
    }
    document.querySelector('.corpo_list').append(list_clone);
}



function show_modal(mensage, url_req, value, event) {
    modal_.querySelector('.modal_mensage').textContent = mensage;
    modal_.querySelector('.confirm_modal').onclick = async (e) => {
        e.preventDefault();
        if (url_req != null) {
            let form = new FormData();
            form.append('p_adm305', value)
            let req = await fetch(url_req, {
                method: "POST",
                body: form,
            });
            let res = await req.json();
            console.log(res);
            alert_mensage(res);
            modal_.style.opacity = '';
            setTimeout(() => {
                modal_.remove();
            }, 250)
            e.onclick = '';
            if ((res.error != undefined) && (res.error == false) && (event != 'href')) {
                event.remove();
            } else if (event == 'href' && ((res.error != undefined) && (res.error == false))) {
                setTimeout(() => {
                    window.location.href = 'inicial.php';
                }, 800)
            }
        }
    }
    modal_.querySelector('.reject_modal').onclick = () => {
        modal_.style.opacity = '';
        setTimeout(() => {
            modal_.remove();
        }, 250)
    }
    modal_.querySelector('.event_modal_confirm').onclick = () => {
        modal_.style.opacity = '';
        setTimeout(() => {
            modal_.remove();
        }, 250)
    }
    modal_.style.display = '';
    setTimeout(() => {
        modal_.style.opacity = '1';
    })
    document.querySelector('.a_xd30').appendChild(modal_);
}

let open = false;
function header_modal(modal, button) {
    button.onclick = (e) => {
        e.preventDefault();
        if (open == false) {
            e.preventDefault();
            modal.style.display = '';
            setTimeout(() => {
                modal.style.opacity = '1';
                modal.style.display = '';
                qs('body').onclick = () => {
                    modal.style.opacity = '0';
                    modal.style.display = 'none';
                    open = false;
                }
            })
            open = true;
        } else {
            console.log('a')
            document.body.onclick = '';
            modal.style.opacity = '0';
            modal.style.display = 'none';
            open = false;
            open = false;

        }
    }
}

//  <div class="corpo_list">
//             <div class="list_area">
//                 <div class="area_list_info_1">
//                     <div class="list_img">
//                     </div>
//                     <div class="list_title">
//                         Red Dead Redempition
//                     </div>
//                 </div>
//                 <div class="area_list_info_2">
//                     <nav>
//                         <a href="" class="a_nav">
//                             <div class="button_a button_int">
//                                 <div class="img_"></div>
//                             </div>
//                         </a>
//                     </nav>
//                     <div class="button_b button_int">
//                         <div class="img_"></div>
//                     </div>
//                     <div class="button_c button_int">
//                         <div class="img_"></div>
//                     </div>
//                 </div>
//             </div>
//         </div> 
