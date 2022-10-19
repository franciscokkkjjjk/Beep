let modal_ = document.querySelector('.modal_confirm');
modal_ = modal_.cloneNode(true);
if(window.localStorage.length > 4) {
    window.localStorage.clear();
}
async function so_game() {
    let req = await fetch('../assets/script/php/requisicoes/game_solic.php');
    let res = await req.json();
    let e = 1;

    for(var i in res) {
        let aux = false;
        if(e % 2 == 0){
             aux = true;
        }
        let urls = [
            '../assets/script/php/solicitacao_jogos/adicionar_jogos.php',
            '../assets/script/php/solicitacao_jogos/reje_jogos.php',
        ];
        creat_list(res[i], 'games', urls, aux); 
    e++;
    }
    document.querySelector('.list_area').style.display = 'none';
    console.log(e);
}
// creat_list(lista de coisas, diretorio da imagem, url da requisicao, define dois tipos de cores);
function creat_list(list, img_dir, url_reqs, aux) {
    let list_clone = document.querySelector('.list_area').cloneNode(true);
    if(aux) {
        list_clone.style.backgroundColor = '#292929';
    } else {
        list_clone.style.backgroundColor = '';
    }
        list_clone.querySelectorAll('.event').forEach((e) => {
            e.remove();
        });
        list_clone.querySelector('.list_img').style.backgroundImage = `url(../../assets/imgs/${img_dir}/${list.img})`
        list_clone.querySelector('.list_title').innerHTML = list.title;
        list_clone.querySelector('.button_a').onclick = async (e)=>{
            e.preventDefault();
            if(url_reqs != null) {
                show_modal("Realmente quer adicionar esse jogo ao sistema sem verificação?", url_reqs[0], list.id, list_clone);
            }
        }
        list_clone.querySelector('.button_b').onclick = async (e)=>{
            e.preventDefault();
            if(url_reqs != null) {
                show_modal("Realmente quer rejeitar esse jogo sem verificação?", url_reqs[1], list.id, list_clone);
            }
            }
        list_clone.querySelector('.button_c').onclick = async (e)=>{
            e.preventDefault(); 
            if(url_reqs != null) {
                window.localStorage.setItem('id_solici', list.id);
                window.location.href = 'visualizar.php';
            }
        }
    document.querySelector('.corpo_list').append(list_clone);
}

function show_modal(mensage, url_req, value, event) { 
    modal_.querySelector('.modal_mensage').textContent = mensage;
    modal_.querySelector('.confirm_modal').onclick = async (e)=>{
        e.preventDefault();
        if(url_req != null) {
            let form = document.createElement('form');
            const input = document.createElement('input');
            input.setAttribute('name', 'p_adm305');
            input.setAttribute('value', value);
            form.appendChild(input);
            form = new FormData(form);
            let req = await fetch(url_req, {
                method: "POST",
                body: form,
            });
            let res = await req.json();
            console.log(res);
            alert_mensage(res)
            modal_.style.opacity = '';
            setTimeout(()=>{
                modal_.remove();
            }, 250)
            e.onclick = '';
            if((res.error != undefined) && res.error == false) { 
                event.remove();
            }
        }
    }
    modal_.querySelector('.reject_modal').onclick = ()=>{
        modal_.style.opacity = '';
    setTimeout(()=>{
        modal_.remove();
    }, 250)
    }
    modal_.style.display = '';
    setTimeout(()=>{
        modal_.style.opacity = '1';
    })
    document.querySelector('.a_xd30').appendChild(modal_);
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
