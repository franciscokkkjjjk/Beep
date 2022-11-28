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
            let req_ = await fetch('../assets/script/php/requsicoes/pesquisas/pesquisar_auto.php', {
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
            let pesquisaCompleta = document.querySelector('.pesquisar_completa').ariaValueText;
            document.querySelector('.pesquisar_completa').onclick = async (e) => {
                let pesquisaCompleta = e.target.ariaValueText;
                let pesquisa_form = new FormData();
                pesquisa_form.append('x_POST30', pesquisaCompleta);
                let res_pes;
                try {
                    let req_pes = await fetch('../assets/script/php/requsicoes/pesquisas/pesquisar_auto.php', {
                        method: "POST",
                        body: pesquisa_form,
                    });
                    res_pes = await req_pes.json();
                } catch {
                    post_not(5);
                    return;
                }
                if (res_pes.nada == undefined) {
                    criarPosts(res_pes);
                    curtir_post();
                    desCurtir();
                    viwimg();
                    show_CM();
                    descompartilhar();
                    qs('.event-direct').onclick = compartilhar;
                    post_num_curtida();
                    setInterval(() => {
                        post_num_curtida();
                    }, 9000);
                    post_num_compartilhamento();
                    setInterval(async () => {
                        post_num_compartilhamento();
                    }, 9000);
                } else {
                    post_not(5);
                }
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
}, true);