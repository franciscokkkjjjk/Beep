async function game(pag) {
    let game_req = await fetch("../assets/script/php/requsicoes/jogos/game.php?pag="+pag)
    let game_res = await game_req.json();
    console.log(game_res);
    if(game_res.nada == undefined) {
        creat_game(game_res);
    } else {
        post_not(3);
    }
}
game(1);
function creat_game(json) {
    let m_game_clone;
    let m_game = document.querySelector('.area_jogo_body');
    if(m_game != undefined) {
        m_game_clone = m_game.cloneNode(true);
        m_game.remove();
    }
    for (let ax in json) {
        m_game_clone.style.display = '';
        m_game_clone.querySelector('.jogo_area_img').style.backgroundImage = `url(../assets/imgs/games/${json[ax].capa_game})`;
        m_game_clone.querySelector('.jogo_area_titulo').innerHTML = json[ax].nome_jogo;
        if(json[ax].possui) {
            m_game_clone.querySelector('.button_A_').classList.remove('icon_add');         
        }
        m_game_clone.querySelector('.button_B_').id = `g_xD30D${json[ax].id_game}`;
        m_game_clone.querySelector('.button_A_').id = `g_xD30D${json[ax].id_game}`;
        document.querySelector('.feed-body-post').append(m_game_clone);
    }
    //jogos padrao
        //adicionar o id de uma publicaçÃo no botão de add e ver
        //adicionar o evento de click para chamar o modal_ver
        //adiconar imagem 
        //adicionar um nome
    //perfil
        //verficar se o usuario possui e mudar o botão de add para um de excluir
}
function modal_ver(){
    //pega o id do botao e faz uma requisição para o jogo completo
    //cria um modal estilo facebook com as informações do jogo
}