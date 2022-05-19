const qs = (e) => {
    return document.querySelector(e);
}
const qsAll = (e) => {
    return document.querySelectorAll(e);
}
menu = false;
qs('.menu--button').addEventListener('click', ()=>{
    if(!menu){
        menu = true;
        qs('.menu--header--body').style.display = 'block';
        qs('.menu--header--body').style.opacity = '1';
        qs('.seta--menu').style.transform = 'rotate(134deg)'
        qs('.seta--menu').style.marginTop = '4px';
        setTimeout(() => {
           let a = qsAll('.menu--header--opt');//style.padding = '20px 10px';
           a.forEach(element => {
             element.style.padding = '20px 70px';  
           });
        }, 50);
    } else {
        menu = false;
        let a = qsAll('.menu--header--opt');//style.padding = '20px 10px';
            qs('.seta--menu').style.transform= '';
            qs('.seta--menu').style.marginTop='';
           a.forEach(element => {
             element.style.padding = '0px 70px';  
           });
        setTimeout(() => {
            qs('.menu--header--body').style.opacity = '0';
            qs('.menu--header--body').style.display = '';
        }, 300);
    }
})