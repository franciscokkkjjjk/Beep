
let edit = false;
function editForm() {
    let creat = document.createElement('div');
    let script = qs('script');
    qs('body').insertBefore(creat, script);
    alert("foi gurizada")
}
function input_ac(e, a) {
     e.addEventListener('focus', ()=>{
         a.classList.add('active--input');//
         a.classList.add('color_font_input_act');
    })
     e.addEventListener('blur', ()=>{
         a.classList.remove('active--input');
         a.classList.remove('color_font_input_act');
    })
    return;
}

function input_ac_selec(e, a) {
    e.addEventListener('focus', ()=>{
        a.classList.add('color--select');//color--select
   })
    e.addEventListener('blur', ()=>{
        a.classList.remove('color--select');
   })
   return;
}
input_ac_selec(qs('#mes'), qs('#label-mes'));
input_ac_selec(qs('#ano'), qs('#label-ano'));
input_ac_selec(qs('#dia'), qs('#label-dia'));