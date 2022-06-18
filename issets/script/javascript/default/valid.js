let pass00 = qs('#passoword--user');
let pass01 = qs('#passoword--user--confirm');
function stopForm(event) {
    event.preventDefault();
}
function validar(){
    if(pass00.value == pass01.value && !pass01.value == '' && !pass00.value == '') {
        pass00.classList.add('confirm');
        pass01.classList.add('confirm');
        pass00.classList.remove('error--login');
        pass01.classList.remove('error--login');
        qs('form').removeEventListener("submit",stopForm, true)
        qs('.mensagem--erro').innerHTML = '';
        qs('form').removeEventListener();
    } else if(!pass01.value == '' && !pass00.value == '') {
        pass00.classList.remove('confirm');
        pass01.classList.remove('confirm');
        pass00.classList.add('error--login');
        pass01.classList.add('error--login');
        qs('form').addEventListener("submit", stopForm, true);
        qs('.mensagem--erro').innerHTML = 'Senhas diferentes.';
        qs('form');
    } else {
        pass00.classList.remove('error--login');
        pass01.classList.remove('error--login');
        pass00.classList.remove('confirm');
        pass01.classList.remove('confirm');
        qs('.mensagem--erro').innerHTML = '';
        qs('form').removeEventListener("submit",stopForm, true)
    }
}
pass01.onblur = validar;
pass00.onblur = validar;