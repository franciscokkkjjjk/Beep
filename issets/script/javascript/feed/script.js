qs('.button--post--form').disabled = true;
qs('.form--inpudiv--event').addEventListener('click',()=>{
    qs('.event--placeholder').style.display='none';
    qs('.inputdiv--form--post').style.display='block';
    qs('.inputdiv--form--post').focus();
    
    qs('.inputdiv--form--post').addEventListener('blur',(e)=>{
        let value = e.target.innerText.trim()
        if(value == '' && qs('.input_img_event').value == '') {
            e.target.innerText = '';
            qs('.button--post--form').disabled = true;
            qs('.button--post--form').style.backgroundColor = '';
            qs('.button--post--form').style.cursor = '';
            qs('.button--post--form').style.cursor = '';
            qs('.event--placeholder').style.display='';
            qs('.inputdiv--form--post').style.display='';
            qs('.form--event--diviput').value = qs('.inputdiv--form--post').innerText;
        } else if(value == ''){
            qs('.event--placeholder').style.display='';
            qs('.inputdiv--form--post').style.display='';
            qs('.form--event--diviput').value = qs('.inputdiv--form--post').innerText;
        } else {
            qs('.form--event--diviput').value = qs('.inputdiv--form--post').innerText;
            qs('.button--post--form').disabled = false;
            qs('.button--post--form').style.backgroundColor = '#53ffff';
            qs('.button--post--form').style.cursor = 'pointer';
        }
    },true)
},true)

function showImg_form(e){
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
        qs('.img--post').appendChild(exit);
        qs('.img--post').appendChild(img_f);
        console.log(qs('.input_img_event').value);
        exit.addEventListener('click', (e)=>{
            qs('.input_img_event').value = '';
            img_f.remove();
            exit.remove();
            if(value.target.innerText.trim() == '' && qs('.input_img_event').value == '') {
                qs('.inputdiv--form--post').target.innerText = '';
                qs('.button--post--form').disabled = true;
                qs('.button--post--form').style.backgroundColor = '';
                qs('.button--post--form').style.cursor = '';
                qs('.button--post--form').style.cursor = '';
             }
            }, true)
        
        qs('.button--post--form').disabled = false;
        qs('.button--post--form').style.backgroundColor = '#53ffff';
        qs('.button--post--form').style.cursor = 'pointer';

    });
}
showImg_form(qs('.input_img_event'));
