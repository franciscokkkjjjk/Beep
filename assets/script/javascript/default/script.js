const qs = (e) => {
    return document.querySelector(e);
}
const qsAll = (e) => {
    return document.querySelectorAll(e);
}
function showImg_form(e, a, c){
    let inpu = e;
    let exit = document.createElement('div');
    exit.setAttribute('class', 'exit--previu');
    let exit_img = document.createElement('div');
    exit_img.setAttribute('class', 'menu--exit-img');
    exit.appendChild(exit_img);
    return e.addEventListener('change', function () {   
        let midia;
        let img = e.files[0];
        console.log(img);
        let seguir;
        console.log(img.type);
        if(img.type == 'image/jpeg' || img.type == 'image/gif' || img.type == 'image/png' || img.type == 'image/jfif') {
            console.log('é uma img');
            seguir = true
            midia = document.createElement('img');
        } else if(img.type == 'video/mp4') {
            console.log('isso é um video');
            midia = document.createElement('video');
            midia.setAttribute('controls', '');
            seguir = true;
        } else {
            seguir = false;
        }
        if(seguir) {
            let src = URL.createObjectURL(img);
            midia.setAttribute('src', src);
            a.appendChild(exit);
            a.appendChild(midia);
            console.log(e.value);
            qs('.button--post--form').disabled = false;
            qs('.button--post--form').style.backgroundColor = '#53ffff';
            qs('.button--post--form').style.cursor = 'pointer';
            exit.addEventListener('click', (e = e)=>{
                inpu.value = '';
                midia.remove();
                exit.remove();
                if(c) {
                    let value = qs('.inputdiv--form--post');
                    if(value != undefined) {
                        if(value.innerText.trim() == '' && inpu.value == '') {
                            qs('.inputdiv--form--post').innerText = '';
                            qs('.button--post--form').disabled = true;
                            qs('.button--post--form').style.backgroundColor = '';
                            qs('.button--post--form').style.cursor = '';
                            qs('.button--post--form').style.cursor = '';
                        }
                    } else {
                        if(qs('.input_img_event').value == '') {
                            qs('.button--post--form').disabled = true;
                            qs('.button--post--form').style.backgroundColor = '';
                            qs('.button--post--form').style.cursor = '';
                            qs('.button--post--form').style.cursor = '';
                        }
                    }

                }
                }, true)
        } else {
            let alerta = {
                mensage: 'A Beep aceita apenas formato gif, mp4, png, jpeg, jpg e jfif.',
                error: true
            }
            if(document.getElementById('img--post-coment') != undefined) {
                document.getElementById('img--post-coment').value = '';
            }
            document.getElementById('img--post').value = '';
            alert_mensage(alerta);
        }
    });
    
}