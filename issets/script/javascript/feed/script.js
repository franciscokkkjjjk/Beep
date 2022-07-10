let menuMH = false;
qs('.button--post--form').disabled = true;
function showMH(){
    if(menuMH == false) {
        menuMH = true;
        qs('.menu--header--body').style.display = 'block';
        qs('.menu--header--body').style.opacity = '1';
        qs('.event--header').classList.add('dimensoes--seta');
        setTimeout(()=>{
            qs('.menu--header--body').style.height = '300px';
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
    return e.addEventListener('change', function () {   
        let img = e.files[0];
        console.log(img);
        let src = URL.createObjectURL(img);
        img_f.setAttribute('src', src);
        qs('.img--post').appendChild(img_f);
        qs('.button--post--form').disabled = false;
        qs('.button--post--form').style.backgroundColor = '#53ffff';
        qs('.button--post--form').style.cursor = 'pointer';

    });
}
showImg_form(qs('.input_img_event'));
