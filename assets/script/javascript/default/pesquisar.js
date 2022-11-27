qs('.input_pesquisar').addEventListener('keydown', async (e) => {
    let pesquisa = e.target.value.trim();
    let res;
    if (pesquisa != '') {
        document.querySelector('.modal_pesquisa_autocomplete').style.display = 'block';
        setTimeout(() => {
            document.querySelector('.modal_pesquisa_autocomplete').style.opacity = '1';
        }, 35)
        try {
            let form_ = new FormData();
            form_.append('x_AUTO30', pesquisa);
            let req_ = await fetch('../assets/script/php/requsicoes/pesquisar_.php', {
                method: 'POST',
                body: form_
            });
            res = await req_.text();
            console.log(res)
        } catch {
            let msm = {
                "mensage": "Não foi possivel realizar a pesquisa.",
                "error": true
            }
            alert_mensage(msm);
            return;
        }
        document.querySelector('.modal_pesquisa_autocomplete').innerHTML = res;
    } else {
        document.querySelector('.modal_pesquisa_autocomplete').style.opacity = '0';
        setTimeout(() => {
            document.querySelector('.modal_pesquisa_autocomplete').style.display = 'block';

        }, 35)
    }
}, true);