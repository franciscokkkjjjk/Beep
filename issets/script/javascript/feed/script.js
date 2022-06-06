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
            qs('.event--menu-pag').style.paddingBottom = "300px";
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