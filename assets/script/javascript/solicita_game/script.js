img_viw_modal('.img_cap_solicita', document.querySelector('.img_input_s'), '.remove-imagem');
input_ac(qs('.input_name_solicita'), qs('.input_name_solicita_area'));//name_loja_cap_solicita
input_ac(qs('.name_loja_event'), qs('.name_loja'));
input_ac(qs('#link_loja'), qs('.link_loja'));
//input_div_desc
input_ac(qs('.input_div_desc'), qs('.input_desc_solicita_area'));

 qs('.input_div').onclick = ()=> {
    qs('.input_div_desc').focus();
 }
 input_div_puts(qs('.input_div_desc'), qs('.hidden_iD'));
 qs('.form_event').addEventListener('submit', (e)=>{
    
    let input_h = qs('.hidden_iD').value.trim();
    let img_ = qs('.img_input_s').value;
    if(input_h == '' || img_ == '')  {
        e.preventDefault();
        let alert__ = {
            'error': true, 
            'mensage': 'Imagem ou descrição faltando'
        }
       alert_mensage(alert__)
    }
 })