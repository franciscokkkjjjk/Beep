let mes = [
    'Janeiro',
    'Fevereiro',
    'Março',
    'Abril',
    'Maio',
    'Junho',
    'Julho',
    'Agosto',
    'Setembro',
    'Outubro',
    'Novembro',
    'Dezembro'
]
let opt_d = qs('.opcao--date');
let i_aux = 0;
mes.forEach(() => {
    let clone = opt_d.cloneNode(true);
    clone.innerHTML = mes[i_aux];
    clone.classList.add('event-mes');
    qs('#mes').appendChild(clone);
    i_aux++;
});
let a = qsAll('.event-mes');
let ab = a[1];
ab.addEventListener('click',()=>{
   console.log('click'); 
})
for(i=1; i < 32; i++){
    let clone = opt_d.cloneNode(true);
    clone.innerHTML = i;
    qs('#dia').appendChild(clone);
}
for(i=2022; i > 1900; i--){
    let clone = opt_d.cloneNode(true);
    clone.innerHTML = i;
    qs('#ano').appendChild(clone);
}