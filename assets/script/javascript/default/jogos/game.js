let modal_game_status = true;

async function game(pag) {
    let game_req = await fetch("../assets/script/php/requsicoes/jogos/game.php?pag=" + pag)
    let game_res = await game_req.json();
    console.log(game_res);
    if (game_res.nada == undefined) {
        creat_game(game_res);
    } else {
        post_not(3);
    }
}
async function show_game(json, button) {//mostra informações completa de um determinado jogo
    let m_ = document.querySelector('.modal_game_area');
    if (modal_game_status) {
        let show_game_req = await fetch('../assets/script/php/requsicoes/jogos/game_completo.php?id_game=' + json.id_game, {
            method: "GET"
        })
        let res_json = await show_game_req.json();
        console.log(res_json);
        if (res_json.error) {
            alert_mensage(res_json);
        } else {
            m_.style.display = '';
            setTimeout(() => {
                m_.querySelector('.modal_game').style.marginTop = '';
            }, 100);
            m_.querySelector('.modal_game_event').onclick = show_game;
            m_.querySelector('.exit_area_modal_game').onclick = show_game;
            m_.querySelector('.title_modal_game').innerHTML = res_json.nome_game;
            m_.querySelector('.aux_area').style.display = 'none';
            m_.querySelector('.capa_modal_game').style.backgroundImage = `url(../assets/imgs/games/${res_json.img_game})`;
            m_.querySelector('.capa_modal_game').style.display = '';
            m_.querySelector('.descri_modal_game').innerHTML = res_json.desc_jogo;
            m_.querySelector('.loja_game').innerHTML = res_json.loja;//esse estilo de mostrar lojas será alterado futuramente
            modal_game_status = false;
            document.querySelector('html').style.overflow = 'hidden';
        }
    } else {
        let creat_event = document.createElement('div');
        creat_event.setAttribute('class', 'event event-block');
        let creat_event01 = document.createElement('div');
        creat_event01.setAttribute('class', 'event min-event');
        let creat_event02 = document.createElement('div');
        creat_event02.setAttribute('class', 'event min-event');
        m_.querySelector('.aux_area').style.display = '';
        m_.querySelector('.title_modal_game').innerHTML = '';
        m_.querySelector('.title_modal_game').append(creat_event);
        m_.querySelector('.capa_modal_game').style.backgroundImage = '';
        m_.querySelector('.capa_modal_game').style.display = 'none';
        m_.querySelector('.descri_modal_game').innerHTML = '';
        m_.querySelector('.descri_modal_game').append(creat_event01);
        m_.querySelector('.loja_game').innerHTML = '';
        m_.querySelector('.loja_game').appendChild(creat_event02);
        m_.querySelector('.modal_game').style.marginTop = '58%';
        document.querySelector('html').style.overflow = '';

        setTimeout(() => {
            m_.style.display = 'none';
        }, 100)
        modal_game_status = true;
    }
}
async function add_game(json, button) {//adiciona um jogo da conta do usuario
    button.classList.remove('icon_add');
    button.classList.add('icon_remove');
    let requisicao_add = await fetch('../assets/script/php/requsicoes/jogos/add_game.php?id_game=' + json.id_game)
    let res_add = await requisicao_add.json();
    console.log(res_add);
    alert_mensage(res_add);
    button.onclick = () => { rm_game(json, button) };
    return true;
}
async function rm_game(json, button) {//remove um jogo da conta do usuario
    button.classList.remove('icon_remove');
    button.classList.add('icon_add');
    let requisicao_rm = await fetch('../assets/script/php/requsicoes/jogos/rm_game.php?id_game=' + json.id_game);
    let resp_rm = await requisicao_rm.json();
    console.log(resp_rm);
    alert_mensage(resp_rm);
    button.onclick = () => { add_game(json, button) };
    return true;
}

function add_game_publi() {
    
}

function creat_game(json, add = true) {
    let m_game_clone;
    let m_game = document.querySelector('.area_jogo_body');
    for (let ax in json) {
        m_game_clone = m_game.cloneNode(true);
        m_game.remove();
        m_game_clone.style.display = '';
        m_game_clone.querySelector('.jogo_area_img').style.backgroundImage = `url(../assets/imgs/games/${json[ax].capa_game})`;
        m_game_clone.querySelector('.jogo_area_titulo').innerHTML = json[ax].nome_jogo;
        let button_a = m_game_clone.querySelector('.button_A_');
        if (add) {
            if (json[ax].possui) {
                button_a.classList.remove('icon_add');
                button_a.classList.add('icon_remove');
                button_a.onclick = () => {
                    rm_game(json[ax], button_a);
                }
            } else {
                button_a.onclick = async () => {
                    add_game(json[ax], button_a);
                }
            }
        } else {
            button_a.classList.remove('icon_add');
            button_a.classList.remove('icon_remove');

            button_a.classList.add('add_game_publi');
            button_a.onclick = () => {
                
            }
        }
        m_game_clone.querySelector('.button_B_').onclick = () => {
            show_game(json[ax], m_game_clone.querySelector('.button_B_'));
        };
        m_game_clone.querySelector('.button_B_').id = `g_xD30D${json[ax].id_game}`;
        m_game_clone.querySelector('.button_A_').id = `g_xD30D${json[ax].id_game}`;
        document.querySelector('.area_game').appendChild(m_game_clone);
    }
}
// async function asw() {
//     let kh = await fetch('http://api.steampowered.com/ISteamNews/GetNewsForApp/v0002/?key=27800A97A260C821A0420E2EACE6C309&appid=440&format=json', {
//         method:'GET'
//     });
//     let gf = await kh.json();
//     console.log(gf);
// }
// asw();