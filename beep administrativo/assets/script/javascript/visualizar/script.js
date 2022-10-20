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
        creat_complete(res, null)
    }
    pedrinha();
    console.log(value.getAll('teste'));
} else {
    window.location.href = 'inicial.php';
}
function creat_complete(json_list, url_req) {
    let info = window.sessionStorage.x5edS;
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
                show_modal(mensage, url_req[0], json_list.id, 'href');
            }
            qs('.button_b').onclick = async (e)=>{
                e.preventDefault();
                let mensage;
                if(window.sessionStorage.x5edS != undefined) {
                    mensage = 'Realmente quer rejeitar esse jogo sem verificação?';
                }
                show_modal(mensage, url_req[1], json_list.id, 'href');
            }
        }
                    //-------------- local destinado para o botão C -------
            if(info != undefined) {
                qs('.conteudo_1 .title_C').textContent = 'Descrição do jogo:'
            } else {
                qs('.conteudo_1 .title_C').textContent = 'Texto da publicação:'

            }
            qs('.conteudo_1 .text_C').textContent = json_list.conteudo1;
            
            if(info != undefined) {
                let link;
                qs('.conteudo2 .title_C').textContent = 'Loja do jogo';
                link = document.createElement('a');
                link.setAttribute('class', 'a_nav');
                link.setAttribute('href', json_list.link_l);
                link.textContent = json_list.loja;
                qs('.conteudo2 .text_C').appendChild(link);
            } else {
                qs('.conteudo2 .text_C').textContent = json_list.conteudo2;
            }
            if(info != undefined) {
                qs('.conteudo3 .title_C').textContent = 'Classificação indicativa:'
            } else {
                qs('.conteudo3 .title_C').textContent = 'Jogo da publicação:'
            }
            qs('.conteudo3 .text_C').textContent = json_list.conteudo3;
            if(info != undefined) {
                qs('.conteudo4 .title_C').textContent = 'Solicitou a notificação?:'
                if(json_list.conteudo4) {
                    qs('.conteudo4 .text_C').textContent = 'Sim'
                } else {
                    qs('.conteudo4 .text_C').textContent = 'Não'
                }
            } else {
                //ainda pendente
            }
            if(info != undefined) {
                qs('.conteudo4 .title_C').textContent = 'Data de solicitação:'

            } else {
                //ainda pendente
            }
            qs('.conteudo4 .text_C').textContent = json_list.conteudo5;
        qs('.loading').remove();

}