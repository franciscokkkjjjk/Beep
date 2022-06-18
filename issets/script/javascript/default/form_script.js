let show = false
qs('.olho--senha').addEventListener('click',()=>{
    if(show){
        show = false;
        qs('.input--passoword').setAttribute('type', 'password');
        qs('.olho--senha').classList.remove('show');
    }else{
        show = true;
        qs('.olho--senha').classList.add('show');
        qs('.input--passoword').setAttribute('type', 'text');
    }
})