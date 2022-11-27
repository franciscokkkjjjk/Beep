let key_anterior;
qs('.input_pesquisar').addEventListener('keyup', async (e) => {
    let pesquisa = e.target.value.trim();
    let res;
    if (pesquisa == key_anterior) {
        return;
    }
    if (pesquisa != '') {
        document.querySelector('.modal_pesquisa_autocomplete').style.display = 'block';
        setTimeout(() => {
            document.querySelector('.modal_pesquisa_autocomplete').style.opacity = '1';
        }, 35)
        try {
            let form_ = new FormData();
            form_.append('x_AUTO30', pesquisa);
            let req_ = await fetch('../assets/script/php/requsicoes/pesquisar_auto.php', {
                method: 'POST',
                body: form_
            });
            res = await req_.text();
        } catch {
            let msm = {
                "mensage": "Não foi possivel realizar a pesquisa.",
                "error": true
            }
            alert_mensage(msm);
            return;
        }
        setTimeout(() => {
            document.querySelectorAll('.area_users').forEach((e) => {
                let id = e.id;
                e.onclick = () => {
                    window.location.href = "perfil_user_v.php?username=" + id;
                };
            });
            let pesquisa = document.querySelector('.pesquisar_completa').ariaValueText;
            document.querySelector('.pesquisar_completa').onclick = async (e) => {
                let req_pes = await fetch('')
            }
        })
        document.querySelector('.modal_pesquisa_autocomplete').innerHTML = res;
    } else {
        document.querySelector('.modal_pesquisa_autocomplete').style.opacity = '0';
        setTimeout(() => {
            document.querySelector('.modal_pesquisa_autocomplete').style.display = 'none';
        }, 15)
    }
    key_anterior = pesquisa;
    console.log(key_anterior);
}, true);