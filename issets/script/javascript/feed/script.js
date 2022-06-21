let menuMH = false;
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
