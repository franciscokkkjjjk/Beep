
qsAll('.p-xD30').forEach( (e)=>{
    let teste = new FormData(e);
    e.addEventListener('click', async (a)=>{
        a.preventDefault();
        let req = await fetch('../issets/script/php/interacoes_post/curtir.php', {
            method: 'POST',
            body: teste,
        })
        res = await req.json();
        e.querySelector('button').classList.remove('img--iteracao-curtida');
        e.querySelector('button').classList.add('img--iteracao-curtida-on');
        e.querySelector('button').classList.add('img--iteracao-curtida-on')
        e.querySelector('button').classList.add('img--curtida--on');
        e.querySelector('button').classList.add('p-evt-box');
        setTimeout(()=>{
            e.querySelector('button').classList.remove('p-evt-box');
        },0260)
        console.log();
    })
})