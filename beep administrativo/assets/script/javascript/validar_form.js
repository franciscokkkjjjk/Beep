function valid_form(e) {
    let mensage = document.querySelector('.mensagem--erro');
    let input_all = e.querySelectorAll('.input--passoword');    
    console.log(input_all);
    input_all.forEach((a)=>{
        a.addEventListener('blur',()=>{
            let input_1 = input_all[1];
            let input_0 = input_all[0];
            if(input_1.value != input_0.value && (input_1.value != '' && input_0.value != '')){
               input_0.style.boxShadow = '0px 0px 3px 0px #cc3a3a';
               input_1.style.boxShadow = '0px 0px 3px 0px #cc3a3a';
               input_0.style.border = '1px solid #cc3a3a';
               input_1.style.border = '1px solid #cc3a3a';
               mensage.style.display = '';
               mensage.innerHTML = 'Senhas diferentes.';
               e.onsubmit = (c)=>{
                c.preventDefault(); 
               };
            } else if(input_1.value != '' && input_0.value != ''){
                input_0.style.boxShadow = '0px 0px 3px 0px #0f0';
               input_1.style.boxShadow = '0px 0px 3px 0px #0f0';
               input_0.style.border = '1px solid #0f0';
               input_1.style.border = '1px solid #0f0';
               mensage.style.display = 'none';
               mensage.innerHTML = '';
               e.onsubmit = undefined;
            }
        })
})
}

valid_form(document.querySelector('form'));