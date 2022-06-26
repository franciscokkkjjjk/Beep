
let opt_d = qs('.opcao--date');
let i_aux = 0;
mes.forEach(() => {
    let clone = opt_d.cloneNode(true);
    clone.innerHTML = mes[i_aux];
    clone.classList.add('event-mes');
    qs('#mes').appendChild(clone);
    i_aux++;
});
let mes_op = qs('#mes');
mes_op.addEventListener('blur',()=>{
    let value_mes = mes_op.value;
        if(value_mes == mes[0] || value_mes == mes[2] || value_mes == mes[4] || value_mes == mes[6]|| value_mes == mes[7]|| value_mes == mes[9] || value_mes == mes[11]){
            let event_dia = qsAll('.event-dia');
            event_dia.forEach((e)=>{
                e.remove();
            })
            let event_ano = qsAll('.event-ano');
            event_ano.forEach((e)=>{
                e.remove();
            })
            for(i=1; i < 32; i++){
                let clone = opt_d.cloneNode(true);
                clone.innerHTML = i;
                clone.classList.add('event-dia');
                qs('#dia').appendChild(clone);
            }
            for(i=2022; i > 1900; i--){
                let clone = opt_d.cloneNode(true);
                clone.innerHTML = i;
                clone.classList.add('event-ano');
                qs('#ano').appendChild(clone);
            }
        } else if (value_mes == mes[1]) {
            let event_dia = qsAll('.event-dia');
            event_dia.forEach((e)=>{
                e.remove();
            })
            let event_ano = qsAll('.event-ano');
            event_ano.forEach((e)=>{
                e.remove();
            })
            for(i=1; i < 30; i++){
                let clone = opt_d.cloneNode(true);
                clone.innerHTML = i;
                clone.classList.add('event-dia');
                qs('#dia').appendChild(clone);
            }
            for(i=2020; i > 1900; i = i-4){
                let clone = opt_d.cloneNode(true);
                clone.innerHTML = i;
                clone.classList.add('event-ano');
                qs('#ano').appendChild(clone);
            }
        } else {
            let event_dia = qsAll('.event-dia');
            event_dia.forEach((e)=>{
                e.remove();
            })
            let event_ano = qsAll('.event-ano');
            event_ano.forEach((e)=>{
                e.remove();
            })
            for(i=1; i < 31; i++){
                let clone = opt_d.cloneNode(true);
                clone.innerHTML = i;
                clone.classList.add('event-dia');
                qs('#dia').appendChild(clone);
            }
            for(i=2022; i > 1900; i--){
                let clone = opt_d.cloneNode(true);
                clone.innerHTML = i;
                clone.classList.add('event-ano');
                qs('#ano').appendChild(clone);
            }
        }
}, true)
for(i=1; i < 32; i++){
    let clone = opt_d.cloneNode(true);
    clone.innerHTML = i;
    clone.classList.add('event-dia');
    qs('#dia').appendChild(clone);
}
for(i=2022; i > 1900; i--){
    let clone = opt_d.cloneNode(true);
    clone.innerHTML = i;
    clone.classList.add('event-ano');
    qs('#ano').appendChild(clone);
}