let modal_ = document.querySelector('.modal_confirm');
modal_ = modal_.cloneNode(true);
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
            '../assets/script/php/solicitacao_jogos/adicionar_jogos.php?id_game=',
            '../assets/script/php/solicitacao_jogos/reje_jogos.php?id_game=',
            '../assets/script/php/requisicoes/game_completo.php?id_game='
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
                show_modal("Realmente quer adicionar esse jogo aos sistema sem verificação?", url_reqs[0]+list.id);
            }
        }
        list_clone.querySelector('.button_b').onclick = async (e)=>{
            e.preventDefault();
            if(url_reqs != null) {
                let req = await fetch(url_reqs[1]+list.id);
                let res = await req.json();
                alert_mensage(res)
            }
            }
        list_clone.querySelector('.button_c').onclick = async (e)=>{
            e.preventDefault(); 
            if(url_reqs != null) {
                let req = await fetch(url_reqs[2]+list.id);
                let res = await req.json();
                alert_mensage(res)
            }
        }
    document.querySelector('.corpo_list').append(list_clone);
}
function show_modal(mensage, url_req) { 
    modal_.querySelector('.modal_mensage').innerHTML = mensage;
    modal_.querySelector('.confirm_modal').onclick = async (e)=>{
        e.preventDefault();
        if(url_req != null) {
            let req = await fetch(url_req);
            let res = await req.json();
            alert_mensage(res)
            modal_.style.opacity = '';
            setTimeout(()=>{
                modal_.remove();
            }, 250)
            e.onclick = '';
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
so_game();

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
