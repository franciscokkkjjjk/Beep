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
mes.forEach(() => {
    let clone = opt_d.cloneNode(true);
    clone.innerHTML = i;
    clone.setAtribu
    qs('#dia').appendChild(clone);
});
qsAll('#mes option').forEach(element => {
    this.addEventListener('click', ()=>{
        alert('teste');
    })
});
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