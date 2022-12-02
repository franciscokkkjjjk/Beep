function close_moda_rede() {
    document.querySelector('.moda_fast').style.opacity = "0";
    document.querySelector('html').style.overflow = '';
    document.querySelector('.area_inputs input').value = '';
    setTimeout(()=>{document.querySelector('.moda_fast').style.display = 'none';}, 250);
}
document.querySelector('.button_area_add_rede').addEventListener('click', (e)=>{
    e.preventDefault();
    document.querySelector('.moda_fast').style.display = '';
    document.querySelector('html').style.overflow = 'hidden';
    setTimeout(()=>{document.querySelector('.moda_fast').style.opacity = "1";}, 250);
    document.querySelectorAll('.exit_event_rede').forEach((b)=>{
        b.onclick = close_moda_rede;
    })
    document.querySelector(".form_input").onsubmit = async (e)=>{
        e.preventDefault();
        let form = new FormData(e.target);
        let req_ = await fetch('../assets/script/php/sobre/adicionar_rede.php', {
            method: "POST",
            body: form
        });
        let res = await req_.json();
        alert_mensage(res);
        close_moda_rede();

    }   
})

document.querySelectorAll(".button_remove").forEach((e)=>{
    e.onclick = async (b)=>{
        b.preventDefault();
        let type_ = b.target.id.split('_')[2];
        console.log(type_);
        let username = b.target.id.split('_')[1];
        let form = new FormData();
        form.append('x_REMOVEXD30', username);
        form.append('x_TYPE30', type_);
        let res;
        try {
            let req_ = await fetch('../assets/script/php/sobre/adicionar_rede.php', {
                method:"POST",
                body: form
            });
            
            res = await req_.json();
        } catch {
            let msm = {
                "mensage": "Não foi possivel realizar a operação.",
                'error': true
            };
            alert_mensage(msm);
            return;
        }
        alert_mensage(res);
        document.querySelector("#"+b.target.id+"_r").remove();
    }
})