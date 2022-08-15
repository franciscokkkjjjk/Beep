const qs = (e) => {
    return document.querySelector(e);
}
const qsAll = (e) => {
    return document.querySelectorAll(e);
}
function showImg_form(e, a, c){
    let inpu = e;
    let img_f = document.createElement('img');
    let exit = document.createElement('div');
    exit.setAttribute('class', 'exit--previu');
    let exit_img = document.createElement('div');
    exit_img.setAttribute('class', 'menu--exit-img');
    exit.appendChild(exit_img);
    return e.addEventListener('change', function () {   
        let img = e.files[0];
        console.log(img);
        let src = URL.createObjectURL(img);
        img_f.setAttribute('src', src);
        a.appendChild(exit);
        a.appendChild(img_f);
        console.log(e.value);
        qs('.button--post--form').disabled = false;
        qs('.button--post--form').style.backgroundColor = '#53ffff';
        qs('.button--post--form').style.cursor = 'pointer';
        exit.addEventListener('click', (e = e)=>{
            inpu.value = '';
            img_f.remove();
            exit.remove();
            if(c) {
                let value = qs('.inputdiv--form--post');
                if(value != undefined) {
                    console.log('entrou');
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
    });
}