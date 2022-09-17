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
game(1);
async function rm_game(json, button) {
    button.classList.remove('icon_remove');
    button.classList.add('icon_add');
    let requisicao_rm = await fetch('../assets/script/php/requsicoes/jogos/rm_game.php?id_game=' + json.id_game);
    let resp_rm = await requisicao_rm.json();
    console.log(resp_rm);
    alert_mensage(resp_rm);
    button.onclick = ()=>{add_game(json, button)};
    return true;
}
async function add_game(json, button) {
    button.classList.remove('icon_add');
    button.classList.add('icon_remove');
    let requisicao_add = await fetch('../assets/script/php/requsicoes/jogos/add_game.php?id_game=' + json.id_game)
    let res_add = await requisicao_add.json();
    console.log(res_add);
    alert_mensage(res_add);
    button.onclick = ()=>{rm_game(json, button)};
    return true;
}

function creat_game(json) {
    let m_game_clone;
    let m_game = document.querySelector('.area_jogo_body');
    for (let ax in json) {
        m_game_clone = m_game.cloneNode(true);
        m_game.remove();
        m_game_clone.style.display = '';
        m_game_clone.querySelector('.jogo_area_img').style.backgroundImage = `url(../assets/imgs/games/${json[ax].capa_game})`;
        m_game_clone.querySelector('.jogo_area_titulo').innerHTML = json[ax].nome_jogo;
        let button_a = m_game_clone.querySelector('.button_A_');
        if (json[ax].possui) {
            button_a.classList.remove('icon_add');
            button_a.classList.add('icon_remove');
            button_a.onclick = ()=>{
                rm_game(json[ax], button_a);
            }
        } else {
            button_a.onclick = async ()=>{
                add_game(json[ax], button_a);
            }
        }
        m_game_clone.querySelector('.button_B_').id = `g_xD30D${json[ax].id_game}`;
        m_game_clone.querySelector('.button_A_').id = `g_xD30D${json[ax].id_game}`;
        document.querySelector('.feed-body-post').appendChild(m_game_clone);
    }
    //jogos padrao
    //adicionar o id de uma publicaçÃo no botão de add e ver
    //adicionar o evento de click para chamar o modal_ver
    //adiconar imagem 
    //adicionar um nome
    //perfil
    //verficar se o usuario possui e mudar o botão de add para um de excluir
}
function modal_ver() {
    //pega o id do botao e faz uma requisição para o jogo completo
    //cria um modal estilo facebook com as informações do jogo
}