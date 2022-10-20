input_ac(qs('.nome_j'), qs('.n_game'));
input_ac(qs('#cass_d'), qs('.cass_d'));
input_ac(qs('.input_div_desc'), qs('.desc_area'));
input_ac(qs('#loja'), qs('.loja_area'));
input_ac(qs('#l_loja'), qs('.l_loja'));
input_div_puts(qs('.input_div_desc'), qs('.hidden_iD'));
document.querySelector('form').addEventListener('submit', (e)=>{
    if(qs('#img_edit').value == '') {
        e.preventDefault();
        mensagem_element(qs('.add_img'), "Por favor, adicione uma imagem.");
    }
    if(qs('.hidden_iD').value.trim() == '') {
        e.preventDefault();
        mensagem_element(qs('.input_div_desc'), "Por favor, informe uma descrição.");
        qs('.input_div_desc').focus();
    }
}, true)

img_viw_modal('.img_', qs('#img_edit'), '.rm_img');