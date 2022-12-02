let menuMH = false;
function showMH(){
    if(menuMH == false) {
        menuMH = true;
        qs('.menu--header--body').style.display = 'block';
        qs('.menu--header--body').style.opacity = '1';
        qs('.event--header').classList.add('dimensoes--seta');
        setTimeout(()=>{
            qs('.menu--header--body').style.height = 1*45+'px';
        },50)
        setTimeout(()=>{
            qs('body').addEventListener('click', showMH, false);
        },50)
    } else {
        menuMH = false;
        qs('body').removeEventListener('click', showMH, false);
        qs('.menu--header--body').style.height = '0px';
        qs('.event--header').classList.remove('dimensoes--seta');
        setTimeout(()=>{
            qs('.menu--header--body').style.display = '';
            qs('.menu--header--body').style.opacity = '';
        },50)
    }
}
qs('.button--header').addEventListener('click',showMH,true);
function pegar_lemento(id) {
    let but = document.getElementById(id);
    let cor = but.getBoundingClientRect();
    
    return cor
}

var mOpen = false;
function show_CM() {
    if(mOpen == false) {
    qsAll('.compartilhar').forEach((e) => {
        e.onclick = (a)=>{
            let id = e.id;
            let modal = qs('.modal--shared');
            qs('.modal-area').style.display = 'block';
            modal.style.display = 'block';
            setTimeout(()=>{
                modal.style.opacity = 1;
            })
            modal.querySelector('.event-direct').id = id.replace('c-xD30', '');
            modal.querySelector('.event--repost--coment').id = id.replace('c-xD30', '');
            let cordenadasInput = pegar_lemento(id);
            console.log(pegar_lemento(id));
             if(cordenadasInput.top >= window.innerHeight*0.85) {
                let calc = cordenadasInput.top+scrollY-72;//cima
                qs('.modal--shared').style.top = calc+'px';//32
            } else {//baixc
                console.log('entrou');
                qs('.modal--shared').style.top = cordenadasInput.top+scrollY+32+'px';//216
            }
            qs('.modal--shared').style.left = cordenadasInput.right-216+'px';
            let id_dE = id.replace('c-xD30', '');
            if(qs('.modal--shared input') != undefined) { 
                qs('.modal--shared input').value = id_dE;
            }
       }   
    });
    qs('.modal--event').addEventListener('click', ()=>{
        let modal = qs('.modal--shared');
        modal.style.opacity = 0;
        setTimeout(()=>{
            modal.style = '';
           qs('.modal-area').style.display = 'none';
           modal.style.display = 'none';
        })
    },true)
}
}
