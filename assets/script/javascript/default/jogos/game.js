async function game() {
    let game_req = await fetch("../assets/script/php/requsicoes/jogos/game.php", {
        method: "GET",
    });
    let game_res = await game_req.json();
    console.log(game_res);
}
game();
function creat_game() {
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