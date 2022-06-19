let menu ={
    'status':false,
    'event01':'menu--pag--event01',
    'locationEvent01':'menu--pag',
    'event02': 'menu--pag--button',
}
qs('.'+menu['event01']).addEventListener('click', ()=>{
if(menu['status'] == false) {

        menu['status'] = true;

        qs('.event--menu-pag').style.opacity = 1;
        qs('.event--menu-pag').style.display = 'block';

        setTimeout(()=>{

            qs('.event--menu-pag').style.backgroundColor = '#4e4e4e';
            qs('.event--menu-pag').style.paddingBottom = "400px";
            qs('.eventscript--seta').classList.add('dimensoes--seta');

        },30)
} else {

        menu['status'] = false;

        qs('.event--menu-pag').style.backgroundColor = '#4e4e4e';
        qs('.event--menu-pag').style.paddingBottom = "";
        qs('.eventscript--seta').classList.remove('dimensoes--seta');

        setTimeout(()=>{

            qs('.event--menu-pag').style.opacity = 0;
            qs('.event--menu-pag').style.display = 'none';
            qs('.'+menu['locationEvent01']).classList.add(menu['event01']);
            
        }, 100)
}
}); 
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
