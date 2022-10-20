if (window.sessionStorage.x5edS == undefined) {
    window.location.href = 'inicial.php';
} else if (window.sessionStorage.x5edS == null) {
    window.sessionStorage.removeItem('x5edS');
    window.location.href = 'inicial.php';
} else {
    async function aux() {
        let x5 = new FormData();
        x5.append('x_25_SP', window.sessionStorage.x5edS);
        let req_ = await fetch('../assets/script/php/requisicoes/game_completo.php', {
            method: "POST",
            body: x5
        });
        let res_ = await req_.json();
        console.log(res_);
        alert_mensage(res_);
        document.querySelector('.img_').style.backgroundImage = `url(../../assets/imgs/games/${res_.midia})`
    }
    aux();
}
input_ac(qs('.nome_j'), qs('.n_game'));
input_ac(qs('#cass_d'), qs('.cass_d'));
input_ac(qs('.input_div_desc'), qs('.desc_area'));
input_ac(qs('#loja'), qs('.loja_area'));
input_ac(qs('#l_loja'), qs('.l_loja'));
input_div_puts(qs('.input_div_desc'), qs('.hidden_iD'));
document.querySelector('form').addEventListener('submit', (e) => {
    if (qs('#img_edit').value == '') {
        e.preventDefault();
        mensagem_element(qs('.add_img'), "Por favor, adicione uma imagem.");
    }
    if (qs('.hidden_iD').value.trim() == '') {
        e.preventDefault();
        mensagem_element(qs('.input_div_desc'), "Por favor, informe uma descrição.");
        qs('.input_div_desc').focus();
    }
}, true)
console.log(window.sessionStorage);
img_viw_modal('.img_', qs('#img_edit'), '.rm_img');