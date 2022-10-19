console.log(sessionStorage.x5edS); 
if(window.sessionStorage.x5edS != undefined || window.sessionStorage.x5edP != undefined) {
    let url_s;
    let value = new FormData();
    if(window.sessionStorage.x5edS != undefined) {
        value.append('x_25_SP', window.sessionStorage.x5edS);
        url_s = '../assets/script/php/requisicoes/game_completo.php';
    } else if(window.sessionStorage.x5edP != undefined) {

    }    
    async function pedrinha() {
        let req = await fetch(url_s, {
            method:'POST',
            body:value
        });
        let res = await req.json();
        console.log(res);
        alert_mensage(res);

    }
    pedrinha();
    console.log(value.getAll('teste'));
} else {
    window.location.href = 'inicial.php';
}
function creat_complete(json_list, url_req) {
        qs('.title_solicitacao').textContent = json_list.title;
        let lMidia = qs('.img_area');
        if(json_list.midia.split('.')[1] == 'mp4') {
            let video = document.createElement('video');
            video.setAttribute('controls');
            video.setAttribute('src', `../../assets/imgs/games/${json_list.midia}`);
            lMidia.appendChild(video);
        } else {
            let img = document.createElement('img');
            img.setAttribute('src', `../../assets/imgs/games/${json_list.midia}`);
            lMidia.appendChild(img);
        }
        if(url_req != null) {
            qs('.button_a').onclick = async (e)=>{
                e.preventDefault();
                let mensage;
                if(window.sessionStorage.x5edS != undefined) {
                    mensage = 'Realmente quer adicionar esse jogo ao sistema sem verificação?';
                }
                show_modal(mensage, url_reqs[0], json_list.id, list_clone);

            }
        }
        qs('.loading').remove();

}
creat_complete()