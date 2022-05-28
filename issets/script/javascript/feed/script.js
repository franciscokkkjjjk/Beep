let menu ={
    'status':false,
    'event01':'menu--pag--event01',
    'event02': '',
}

console.log(menu['event01'])
if(menu['status'] == false) {
    qs('.'+menu['event01']).addEventListener('click', ()=>{
        
        console.log('teste');

        menu['status'] = true;
        qs('.event--menu-pag').style.display = 'block';
        setTimeout(()=>{//background-color: #4e4e4e;
            qs('.event--menu-pag').style.backgroundColor = '#4e4e4e';
            qs('.event--menu-pag').style.opacity = 1;
            qs('.event--menu-pag').style.paddingBottom = "267px";
            qs('.menu--pag--button div').classList.add('dimensoes--seta');
            qs('.'+menu['event01']).classList.remove(menu['event01']);
        },30)
    });
} else {
    qs('')
}